<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Cart;

class OrderController extends Controller
{
    
    public function make(){
        $user_id = request()->user()->id;
        $user_cart = request()->user()->Carts;
        $user_cart->load('Product');
            //temporary holder of the cart id to be deleted after order have been created
        $cart_to_delete=[];
            //ref id after payment
        $ref_id=request()->input('ref_id');
        $phone_no= request()->input('phone_no');
        $state= request()->input('state');
        $local_govt= request()->input('local_govt');
        $town= request()->input('town');
        $street= request()->input('street');
            //get the date of order creation
        $date_now = Carbon::now()->toDateString();
    
            //temp Order holder array
        $temp_order = [];
        foreach($user_cart as $cart){
            $order = new Order();
            $order->product_id = $cart->product_id;
            $order->quantity = $cart->quantity;
            $order->price = $cart->product->product_price;
            $order->date = $date_now;
            $order->ref = $ref_id;
            $order->phone_no = $phone_no;
            $order->state = $state;
            $order->local_govt = $local_govt;
            $order->town = $town;
            $order->street = $street;
            $temp_order[]=$order;
            $cart_to_delete[]=$cart->id;
        }
        $user = request()->user();
            //save all the orders with the user_id once
        $user->Orders()->saveMany($temp_order);
            //delete all the cart after orders have been created delete all of them once
    
        Cart::destroy($cart_to_delete);
        $user->Orders;
        $orders = $user->Orders;
        $orders->load('User');
        
        return response()->json(compact('orders'));
    }
    public function dashboard(){
        $user = request()->user();
        $user->Orders()->orderBy('created_at',"DESC")->get();
        $orders = $user->Orders;
        $orders->load(['Product.Images','User']);
        return response()->json(compact('orders'));
    }
    public function AdminallOrders(){
        $orders=Order::with(['Product.Images','User'])->orderBy('created_at',"DESC")->paginate(3);
        return response()->json(compact('orders'));
    }
    public function del($order_id){
        $order = Order::find($order_id);
        $order->delete();
        return response()->json('ok');
    }

    public function userOrders(){
        $orders = request()->user()->Orders()->with(['Product.Images','User'])->paginate(3);
        return response()->json(compact('orders'));
    }
}
