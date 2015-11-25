<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['model_id', 'name', 'subtitle', "origin_price", "demestic_price", "retail_price", "wholesale_price", "count", "thumbnail", "detail_image", "category_id", "brand_id", "description"];
}
