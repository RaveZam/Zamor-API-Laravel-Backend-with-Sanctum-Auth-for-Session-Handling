<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;


class OrderController extends Controller
{
    
    public function createOrder(Request $request){

        $order = Order::create([
            'user_id' => auth()->id(),
            'address_id' => $request->address_id,
            'total_amount' => $request->total,
            'status' => $request->status

        ]);

        foreach($request->items as $item){      

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

        }

        return response()->json(['message' => 'Order Created Succesfully']);

    }


}