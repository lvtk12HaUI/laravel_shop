<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandProduct extends Model
{
    protected $table = "tbl_brand_product";
    protected $primaryKey = "brand_id";
    public $timestamps = false;
    protected $fillable = [
        'brand_name', 'brand_desc', 'brand_status'
    ];
    public function products(){
        return $this->hasMany('App\Models\Product','brand_id');
    } 
}
