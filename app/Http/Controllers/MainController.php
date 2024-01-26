<?php

namespace App\Http\Controllers;

use App\Models\Cart as Cart;
use App\Models\Category as Category;
use App\Models\Product as Product;
use App\Models\Sales as Sales;
use App\Models\SalesDetail as SalesDetail;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function show(){
        $data['product'] = Product::select("*")->where("status","Active")->get();
        $data['cart'] = Cart::select("*")->get();
        $data['cartCounter'] = $data['cart']->unique('product_name')->count();
        $data['category'] = Category::select("*")->get();
        return view('home',$data);
    }

    public function showSelectedProduct($category, $name){
        $data['product'] = Product::select("*")
            ->where("product_name",$name)
            ->where("category",$category)
            ->where("status","Active")
            ->first();
        $data['cart'] = Cart::select("*")->get();
        $data['category'] = Category::select("*")->get();
        $data['cartCounter'] = $data['cart']->unique('product_name')->count();
        $data['product']->quantity = 0;
        $data['related_product'] = Product::select("*")
            ->where("status", "Active")
            ->where(function ($query) use ($category, $name, $data) {
                $query->where("category", 'LIKE', '%' . $category . '%')
                    ->orWhere("product_name", 'LIKE', '%' . $name . '%')
                    ->orWhere("description", 'LIKE', '%' . $data['product']->description . '%')
                    ->orWhere("ingredients", 'LIKE', '%' . $data['product']->ingredients . '%');
            })
            ->where("product_name", '!=', $data['product']->product_name)
            ->orderByRaw("CASE WHEN category = ? THEN 0 ELSE 1 END", [$category])
            ->limit(4)
            ->get();
        return view('product',$data);
    }

    public function showCart(){
        $data['cart'] = Cart::select('cart.*', 'product.*')
        ->join('product', 'cart.product_name', '=', 'product.product_name')
        ->get();
        $data['cartCounter'] = $data['cart']->unique('product_name')->count();

        return view('cart',$data);
    }

    public function insertCart(Request $request){
        $quantity = $request->input('quantity');
        $productName = $request->input('productName');
        $product = Product::select("*")->where("product_name",$productName)->where("status","Active")->first();

        if(!$product){
            return json_encode(["status"=>0,"message"=>"Product Not Found"]);
        }

        $cart = Cart::where("product_name", $product->product_name)->first();

        $stateFull = 0;

        if(!$cart){
            $cart = new Cart();
            $cart->product_name = $product->product_name;
            $cart->quantity = $quantity;
        } else {
            $postQuantity = $cart->quantity + $quantity;
            if ($postQuantity > $product->stock) {
                $cart->quantity = $product->stock;
                $stateFull = 1;
            } else {
                $cart->quantity = $postQuantity;
            }
        }

        if($cart->save() && $stateFull){
            return json_encode(["status"=>1,"message"=>"This item have reached stock limit at your cart!"]);
        } else if($cart->save() && !$stateFull){
            return json_encode(["status"=>1,"message"=>"Item(s) added to cart"]);
        } else {
            return json_encode(["status"=>0,"message"=>"failed to add product to cart"]);
        }

    }

    public function deleteCart($productName){
        $product = Product::select("*")->where("product_name",$productName)->where("status","Active")->first();

        if(!$product){
            $data['message'] = "Product Not Found";
            return view("message/failed",$data);
        }

        $cart = Cart::where("product_name", $product->product_name)->first();

        if(!$cart){
            $data['message'] = "Product in Cart Not Found";
            return view("message/failed",$data);
        }

        if($cart->delete()){
            return json_encode(["status"=>1,"message"=>"Item(s) deleted from cart"]);
        } else {
            return json_encode(["status"=>1,"message"=>"Failed to delete product in cart"]);
        }
    }
    public function deleteCheckout($productName){
        $product = Product::select("*")->where("product_name",$productName)->where("status","Active")->first();

        if(!$product){
            $data['message'] = "Product Not Found";
            return view("message/failed",$data);
        }

        $cart = Cart::select("*")->where("product_name", $product->product_name)->first();

        if(!$cart){
            $data['message'] = "Product in Cart Not Found";
            return view("message/failed",$data);
        }

        if($cart->delete()){
            return redirect('/cart/checkout');
        } else {
            $data['message'] = "failed to delete product in cart";
            return view("message/failed",$data);
        }
    }

    public function showCheckout(Request $request){
        $data['cart'] = json_decode($request->input('selectedProduct'), true);
        $data['total'] = $request->input('total');
        $cartTemp = Cart::select('cart.*', 'product.*')
        ->join('product', 'cart.product_name', '=', 'product.product_name')
        ->get();
        $data['cartCounter'] = $cartTemp->unique('product_name')->count();
        return view('checkout',$data);
    }

    public function showSuccess(){
        $cartTemp = Cart::select('cart.*', 'product.*')
        ->join('product', 'cart.product_name', '=', 'product.product_name')
        ->get();
        $data['cartCounter'] = $cartTemp->unique('product_name')->count();
        return view("/message/success",$data);
    }

    public function insertCheckout(Request $request){
        $cartTemp = Cart::select('cart.*', 'product.*')
        ->join('product', 'cart.product_name', '=', 'product.product_name')
        ->get();
        $data['cartCounter'] = $cartTemp->unique('product_name')->count();

        $inputData = json_decode($request->input('productCheckout'), true);

        if(!$inputData){
            $data['message'] = "No data inserted";
            return view("message/failed",$data);
        }
        $products = $inputData['products'];
        $totalPrice = $inputData['total'];
        $shippingCost = $inputData['shippingCost'];

        $sales = new Sales;
        $sales->sales_date = now();
        $sales->total_cost = $totalPrice;
        $sales->shipping_cost = $shippingCost;
        $sales->pending = 1; // Still on progress

        if($sales->save()){
            $salesDetail = new SalesDetail;

            foreach ($products as $item){
                $salesDetail->sales_id = $sales->id;
                $salesDetail->product_name = $item['product_name'];
                $salesDetail->quantity = $item['quantity'];
                $salesDetail->itemPrice = $item['price'];
                $salesDetail->totalPrice = $item['price'] * $item['quantity'];
                $salesDetail->save();

                $cart = Cart::firstWhere('product_name',$item['product_name']);
                $cart->delete();
            }

            return view("/message/success",$data);
        } else {
            $data['message'] = "No data inserted";
            return view("/message/failed",$data);
        }

    }
    public function searchProduct(Request $request){
        $categoryName = $request->input('category_name');
        $minStock = $request->input('input-stock');
        $keyword = $request->input('keyword');

        $products = Product::query();

        if ($categoryName) {
            $products->where('category', $categoryName);
        }

        if ($minStock) {
            $products->where('stock', '>=', $minStock);
        }

        if ($keyword) {
            $products->where(function ($query) use ($keyword) {
                $query->whereRaw('LOWER(product_name) like ?', ["%".strtolower($keyword)."%"])
                    ->orWhereRaw('LOWER(ingredients) like ?', ["%".strtolower($keyword)."%"])
                    ->orWhereRaw('LOWER(description) like ?', ["%".strtolower($keyword)."%"])
                    ->orWhereRaw('LOWER(category) like ?', ["%".strtolower($keyword)."%"]);
            });
        }

        $data['product'] = $products->where("status","Active")->get();
        $data['cart'] = Cart::select("*")->get();
        $data['cartCounter'] = $data['cart']->unique('product_name')->count();
        $data['category'] = Category::select("*")->get();

        return view('home', $data);
    }

    public function seeFeaturedProduct(){

        $data['product'] = Product::select("*")
            ->where("status","Active")
            ->where("featured",1)
            ->orderBy("sold_quantity","ASC")
            ->orderBy("stock","DESC")
            ->get();
        $data['cart'] = Cart::select("*")->get();
        $data['cartCounter'] = $data['cart']->unique('product_name')->count();
        $data['category'] = Category::select("*")->get();

        return view('home', $data);
    }
}
