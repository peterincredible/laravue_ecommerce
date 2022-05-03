<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function Images(){
        return $this->hasMany(ProductImage::class);
    }

    public function scopeSearchByCategory($query,$category_id){
        return $query->where('category_id',$category_id);
    }
}
