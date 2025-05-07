<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    //

    public function addProduct(Request $request){

        $validatedProduct = $request->validate([
            'productName' => "required|string",
            'brandName' => "required|string",
            "productThumbnail" => "required|string",
            "productPrice" => "numeric|required",
            "slug" => "required|string"
        ]);

        Product::create($validatedProduct);
    }


    public function fetchAllProducts(){

        $products = Product::all();

        return response()->json( $products ,200);
    }
}