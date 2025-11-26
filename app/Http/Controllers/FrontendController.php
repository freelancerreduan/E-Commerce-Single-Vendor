<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index(){
        $product_details = Product::all();
        $latest_products = Product::latest()->take(3)->get();
        $categories = Category::all();
        return view('frontend.master',[
            'product_details' => $product_details,
            'latest_products' => $latest_products,
            'categories' => $categories,
        ]);
    }
   
    // product Details
    function  single_product($id){
        $product_details = Product::find($id);
        return view('frontend.product.product_datails',[
            'product_details' => $product_details,
        ]);
        // return $product_details->all();
    }


}
