<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    //

    public function deleteImage($id){
        $image = ProductImage::find($id);
        $image->delete();
        return response()->json(['message'=>"ok"]);
    }
}
