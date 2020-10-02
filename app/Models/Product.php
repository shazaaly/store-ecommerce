<?php

namespace App\models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use Translatable;
    use softDeletes;

    protected $with = ['translations'];  //to return trans with queries//
    protected $fillable = [
        'id',
        'slug',
        'price',
        'special_price',
        'special_price_type',
        'special_price_start',
        'special_price_end',
        'selling_price',
        'sku',
        'manage_stock',
        'qty',
        'in_stock',
        'viewed',
        'is_active',
        'brand_id',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'in_stock' => 'boolean',
        'manage_stock' => 'boolean',

    ];


    public $translatedAttributes = ['name', 'description', 'short_description'];

    public  function scopeActive($query){
        return $query->where('is_active' , 1);
    }

    public function getActive()
    {
        return $this->is_active == 0 ? 'غير مفعل' : 'مفعل';
    }

    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/images/brands/' . $val) : "";
    }

    protected $dates = [
        'deleted_at',
        'special_price_start',
        'start_date',
        'end_date',
        'special_price_end'
    ];

//    relations with categories, brands and tags//

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');

    }

    public function brands()
    {
        return $this->belongsTo(Brand::class,'brand_id')->withDefault();


    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');


    }

}
