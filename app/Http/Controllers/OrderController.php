<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;


class OrderController extends Controller
{

    public function fetchOrder(Request $request) {
 
        $order = Order::where('user_id', auth()->id())->get();
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        return response()->json(["message" => "Succesfully Fetched",  "order_items" => $orderItems, "order" => $order ]);
        
    } 

    public function fetchAllOrders()
    {
        $orders = Order::with('orderItems.product')
            ->where('user_id', auth()->id())
            ->get();
    
        return response()->json([
            "message" => "Successfully Fetched",
            "orders" => $orders
        ]);
    }
    public function createOrder(Request $request){

        $order = Order::create([
            'user_id' => auth()->id(),
            'address_id' => $request->address_id,
            'total_amount' => $request->total,
            'status' => $request->status,
            'payment_method' => $request->payment_method,

        ]);

        foreach($request->items as $item){       

            $product = Product::where('id',$item['product_id'])->first();

            if($product){
                $product->stock -= $item['quantity'];
                $product->save();
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'size' => $item['size'],
                'price' => $item['price'],
            ]);   
            Cart::where('user_id', auth()->id())->where('product_id', $item['product_id'])->where('size', $item['size'])->delete();

        }
        return response()->json(['message' => 'Order Created Succesfully', "previousOrderID" => $order->id]);
    }
}