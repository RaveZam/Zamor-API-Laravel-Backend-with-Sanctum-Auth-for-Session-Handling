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

        return response()->json(['message' => 'Product created'], 201);
    }

    public function updateProduct(Request $request, $id)
    {
        $validatedProduct = $request->validate([
            'productName' => "sometimes|required|string",
            'brandName' => "sometimes|required|string",
            "productThumbnail" => "sometimes|required|string",
            "productPrice" => "sometimes|required|numeric",
            "slug" => "sometimes|required|string",
            "stock" => "sometimes|required|numeric",
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedProduct);

        return response()->json(['message' => 'Product updated', 'product' => $product], 200);
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted'], 200);
    }

    public function fetchAllProducts(){

        $products = Product::all();

        return response()->json( $products ,200);
    }
}