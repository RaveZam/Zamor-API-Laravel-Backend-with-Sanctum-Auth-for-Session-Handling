<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Redis;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        return response()->json($cartItems, 200);
    }

    public function store(Request $request)   
    {
      $request -> validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
      ]);


      $cartItem = Cart::where('user_id', auth()->id())->where('product_id', $request->product_id)->first(); 

      if($cartItem){
        $cartItem->quantity += $request->quantity;
        $cartItem->save();
        return response()->json($cartItem, 200);
      }else{
        $cartItem = Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);
        return response()->json($cartItem, 200
    );

      }
    }

    public function deleteItem(Request $request){


        $cartItem = Cart::where('id', $request->id)->where('user_id',auth()->id())->first();

        if($cartItem) {
            $cartItem->delete();
            return response()->json(["message" => "Succesfully Deleted Item"]);
        }

        if(!$cartItem){
            return response()->json(["message" => "Item Not Found"]);

        }
    
    }

    
}