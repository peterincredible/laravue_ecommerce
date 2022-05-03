<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/signup',[UserController::class,'signup']);
Route::post('/signin',[UserController::class,'signin']);

Route::get('/logout',[UserController::class,'logout'])->middleware('auth:sanctum');
Route::put('/accountsettings',[UserController::class,'AccountSettings'])->middleware('auth:sanctum');

Route::apiResource('category',CategoryController::class);

Route::get('/product/admin',function(){
    $products = Product::with('Images')->paginate(2);
    return response()->json(compact('products'));
    // return response()->json($searchtext);
})->middleware(['auth:sanctum','admin']);

Route::apiResource('product',ProductController::class);

Route::get('/product/search/category/{category_id}',function($category_id){
    $product = Product::with('Images')->searchByCategory($category_id)->get();
    return response()->json(compact('product'));
});

Route::get('/product/search/orderby/{order}',function($order){
    // $product = Product::with('Images')->searchByCategory($category_id)->get();
    $product = Product::with('Images')->orderBy('product_price',$order)->get();
    return response()->json(compact('product'));
});

Route::get('/product/search/price/{min}/{max}',function($min,$max){
    // $product = Product::with('Images')->searchByCategory($category_id)->get();
    $product = Product::with('Images')->whereBetween('product_price',[$min,$max])->get();
    return response()->json(compact('product'));
});

Route::get('/product/search/above/{priceabove}',function($priceabove){
    $product = Product::with('Images')->where('product_price','>',$priceabove)->get();
    return response()->json(compact('product'));
});

Route::get('/product/search/text/{searchtext}',function($searchtext){
    $product = Product::with('Images')->where('product_name','like',"%{$searchtext}%")->get();
    return response()->json(compact('product'));
    // return response()->json($searchtext);
});

Route::apiResource('cart',CartController::class);
Route::delete('/product/image/delete/{id}',[ImageController::class,'deleteImage'])->middleware(['auth:sanctum','admin']);

Route::post('/order/make',[OrderController::class,'make'])->middleware('auth:sanctum');

Route::get('/orders/dashboard',[OrderController::class,'dashboard'])->middleware('auth:sanctum');
Route::get('/admin/orders',[OrderController::class,'AdminallOrders'])->middleware(['auth:sanctum','admin']);
Route::get('/user/orders',[OrderController::class,'userOrders'])->middleware('auth:sanctum');
Route::delete("/order/del/{order_id}",[OrderController::class,'del'])->middleware('auth:sanctum');