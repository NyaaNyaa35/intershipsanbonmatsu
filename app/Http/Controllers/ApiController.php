<?php

namespace App\Http\Controllers;

use App\Models\Product as Product;
use App\Models\Cart as Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function show(){
        $data['product'] = Product::select("*")->where("status","Active")->get();
        return view('home',$data);
    }

    public function showSelectedProduct($category, $name){
        $data['product'] = Product::select("*")
            ->where("product_name",$name)
            ->where("category",$category)
            ->where("status","Active")
            ->first();
        $data['product']->quantity = 0;
        $data['related_product'] = Product::select("*")
            ->where("status","Active")
            ->inRandomOrder()
            ->limit(4)
            ->get();
        return view('product',$data);
    }

    public function insertCart(Request $request){
        $quantity = $request->input('quantity');
        $productName = $request->input('productName');
        $product = Product::select("*")->where("product_name",$productName)->where("status","Active")->first();

        if(!$product){
            return json_encode(["status"=>0,"message"=>"Product Not Found"]);
        }

        $cart = Cart::where("product_name", $product->product_name)->first();

        if(!$cart){
            $cart = new Cart();
            $cart->product_name = $product->product_name;
            $cart->quantity = $quantity;
        } else {
            $postQuantity = $cart->quantity + $quantity;
            if ($postQuantity > $product->stock) {
                //If the quantity that inserted more than available stock, the quantity will be set to stock
                $cart->quantity = $product->stock;
            } else {
                $cart->quantity = $postQuantity;
            }
        }

        if($cart->save()){
            return redirect('/cart');
        } else {
            return json_encode(["status"=>0,"message"=>"failed to add product to cart"]);
        }

    }

    public function deleteCart($productName){
        $product = Product::select("*")->where("product_name",$productName)->where("status","Active")->first();

        if(!$product){
            return json_encode(["status"=>0,"message"=>"Product Not Found"]);
        }

        $cart = Cart::where("product_name", $product->product_name)->first();

        if(!$cart){
            return json_encode(["status"=>0,"message"=>"Product in Cart Not Found"]);
        }

        if($cart->delete()){
            return redirect('/cart');
        } else {
            return json_encode(["status"=>0,"message"=>"failed to delete product in cart"]);
        }
    }

    public function showCart(){
        $data['cart'] = Cart::select('cart.*', 'product.*')
        ->join('product', 'cart.product_name', '=', 'product.product_name')
        ->get();

        return view('cart',$data);
    }

    public function searchProduct(Request $request){
        $searchBarValue = $request->input('search');
        $arrayStr = explode(" ",$searchBarValue);
        // return json_encode(["message"=>$arrayStr]);

        \Log::info("Search Value: " . $arrayStr);
    }
}
