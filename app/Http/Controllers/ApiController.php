<?php

namespace App\Http\Controllers;

use App\Models\Product as Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function show(){
        $data['product'] = Product::select("*")->where("status","active")->get();
        return view('home',$data);
    }

    public function searchProduct(Request $request){
        $searchBarValue = $request->input('searchbar');

        \Log::info("Search Value: " . $searchBarValue);
    }
}
