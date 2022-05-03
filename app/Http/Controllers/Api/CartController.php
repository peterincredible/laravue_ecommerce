<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = $request->user()->id;
        $product_id = $request->input('product_id');
        $available = Cart::where(compact('user_id','product_id'))->exists();
        $cart= null;
        if(!$available){
            $cart = new Cart();
            $cart->quantity = 1;
            $cart->user_id = $user_id;
            $cart->product_id = $product_id;
            $cart->save();
            $cart = $cart->load('Product.Images');

            return response()->json(['message'=>'added new','cart'=>$cart]);
        }
        return response()->json(['message'=>'exists already']);
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cart =Cart::find($id);
        $cart->quantity=$request->input('quantity');
        $cart->save();
        return response()->json($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return response()->json('yes still trying to delete');
    }
}
