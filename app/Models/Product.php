<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "tbl_product";
    protected $primaryKey = "product_id";
    public $timestamps = false;
    protected $fillable = [
        'product_name', 'product_price', 'product_image','category_id', 'brand_id','product_desc', 'product_content', 'product_status'
    ];
    public function category(){
        return $this->belongsTo('App\Models\CategoryProduct', 'category_id');
    }

    public function brand(){
        return $this->belongsTo('App\Models\BrandProduct', 'brand_id');
    }
}
