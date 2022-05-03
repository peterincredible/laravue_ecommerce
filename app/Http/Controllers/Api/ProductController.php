<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function __construct()
    {
      $this->middleware('auth:sanctum')->only(['store','update','destroy']);
      $this->middleware('admin')->only(['store','update','destroy']);
    }
    public function index()
    {
        $products = Product::with('Images')->get();
        return response()->json(compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $rules=[
             'product_name'=>'required|min:3|max:25',
             'product_description'=>'required|min:5',
             'product_price'=>'required',
             'product_category'=>'required',
             'images.*'=>'required|image|mimes:jpg,png,jpeg'
         ];
         $message=[
             'required'=>'the :attribut field is required',
             'images.*.required'=>'the :attribute can\t be empty',
             'images.*.mimes'=>'the :attribute is not allowed'
         ];
         $validator = Validator::make($request->all(),$rules,$message);

         if($validator->fails()){
             return response()->json($validator->errors())->setStatusCode(400);
         }
          $validated = $validator->validated();
         $new_product = new Product();
         $new_product->product_name = $validated['product_name'];
         $new_product->product_price = $validated['product_price'];
         $new_product->product_description = $validated['product_description'];
         $new_product->category_id = $validated['product_category'];
         $new_product->save();
         $path = "products/{$new_product->id}";
         $images = $validated['images'];
         $img = [];
         foreach($images as $image){
            //  $jj = Storage::url(Storage::putFile($path,$image));//to get the url
                 $name= Str::uuid().'.'.$image->getClientOriginalExtension();
                 $ext = $image->getClientOriginalExtension();
                 $type = $image->getClientMimeType();
                 $size = $image->getSize();
                 $url = Storage::url(Storage::putFileAs($path,$image,$name));//Storage::putFile($path,$image);//to get the path eg storage/product/id/imagename.extension i hope u remember
                 $image = new ProductImage();
                 $image->url = $url;
                 $image->ext = $ext;
                 $image->name = $name;
                 $image->type = $type;
                 $image->size = $size;
                 $img[]=$image;
            //  $url = Storage
            
            //  $img_url[]=compact('url','name')
         }
        //  return response()->json(['message'=>'successfully added a new product']);
        $new_product->Images()->saveMany($img);
        return response()->json(['message'=>'wow sweet it worked']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('Images')->find($id);
        if(!$product){
            return response()->json(['message'=>'sorry cant find product'])->setStatusCode(400);
        }
        return response()->json(compact('product'));
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
        //
       $rules=[
            'product_name'=>'required|min:3|max:25',
            'product_description'=>'required|min:5',
            'product_price'=>'required',
            'product_category'=>'required',
            'images.*'=>'image|mimes:jpg,png,jpeg'
        ];
        $message=[
            'required'=>'the :attribute field is required',
            'images.*.required'=>'the :attribute can\t be empty',
            'images.*.mimes'=>'the :attribute is not allowed'
        ];
        $validator = Validator::make($request->all(),$rules,$message);

        if($validator->fails()){
            return response()->json($validator->errors())->setStatusCode(400);
        }
         $validated = $validator->validated();
        $edit_product = Product::find($id);
        $edit_product->product_name = $validated['product_name'];
        $edit_product->product_price = $validated['product_price'];
        $edit_product->product_description = $validated['product_description'];
        $edit_product->category_id = $validated['product_category'];
        $edit_product->save();
        $path = "products/{$edit_product->id}";
         if(isset($validated['images'])){
            $images = $validated['images'];
            $img = [];
            foreach($images as $image){
               //  $jj = Storage::url(Storage::putFile($path,$image));//to get the url
                    $name= Str::uuid().'.'.$image->getClientOriginalExtension();
                    $ext = $image->getClientOriginalExtension();
                    $type = $image->getClientMimeType();
                    $size = $image->getSize();
                    $url = Storage::url(Storage::putFileAs($path,$image,$name));//Storage::putFile($path,$image);//to get the path eg storage/product/id/imagename.extension i hope u remember
                    $image = new ProductImage();
                    $image->url = $url;
                    $image->ext = $ext;
                    $image->name = $name;
                    $image->type = $type;
                    $image->size = $size;
                    $img[]=$image;
                    
            }
            $edit_product->Images()->saveMany($img);
         }
       //  return response()->json(['message'=>'successfully added a new product']);
   
       return response()->json(['message'=>'wow sweet it worked']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json(['message'=>"product sucessfully deleted"]);
    }
}
