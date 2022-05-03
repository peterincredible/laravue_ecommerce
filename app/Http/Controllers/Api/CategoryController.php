<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */

     public function __construct(){
        $this->middleware(['auth:sanctum','admin'])->only(['store','show','update','destroy']);
     }
    
    public function index()
    {
        $cat = Category::all();
        $cat = CategoryResource::collection($cat);
        return response()->json(['categories'=>$cat]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
           $cat_name = request()->input('cat');
           if(empty($cat_name)){
            return response()->json(['message'=>'cat input can\'t be empty'])->setStatusCode(400);
           }
           $cat = new Category();
           $cat->category = $cat_name;
           $cat->save();
           return response()->json(['message'=>'successfully new Category']);
        }catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json(['message'=>$message])->setStatusCode(400);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $category = new CategoryResource(Category::find($id));
            return response()->json(compact('category'));
      }catch(\Exception $e){
          $message = $e->getMessage();
          return response()->json(compact('message'));
      }
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
        try{
            $cat_name = $request->input('cat');
            if(empty($cat_name)){
             return response()->json(['message'=>'cat input can\'t be empty'])->setStatusCode(400);
            }
            $cat = Category::find($id);
            $cat->category = $cat_name;
            $cat->save();
            return response()->json(['message'=>'successfully saved Category']);
         }catch(\Exception $e){
             $message = $e->getMessage();
             return response()->json(['message'=>$message])->setStatusCode(400);
         }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
              $category = Category::find($id);
              $category->delete();
              return response()->json(['message'=>"category successfully deleted"]);
        }catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json(compact('message'));
        }
        
    }
}
