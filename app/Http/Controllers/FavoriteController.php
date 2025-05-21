<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FavoriteItem;

class FavoriteController extends Controller
{
    public function addToFavorite(Request $request){
     
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $itemExist = FavoriteItem::where('user_id', auth()->id())->where('product_id', $request->product_id)->first();

        if($itemExist){
            return response()->json(['message' => 'Product already in favorites'], 400);
        }

        FavoriteItem::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
        ]);

        return response()->json(['message' => 'Product added to favorites'], 200);
    }

    public function removeFromFavorite(Request $request){
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        FavoriteItem::where('user_id', auth()->id())->where('product_id', $request->product_id)->delete();

        return response()->json(['message' => 'Product removed from favorites'], 200);
    }

    public function getFavoriteItems(){
        $favoriteItems = FavoriteItem::where('user_id', auth()->id())
            ->with('product') 
            ->get();
    
        return response()->json($favoriteItems, 200);
    }
}
