<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use Translatable;

    protected $table = 'categories';
    protected $with = ['translations'];
    protected $translatedAttributes = ['name'];

    protected $fillable = ['slug', 'is_active', 'parent_id'];
    protected $casts = [
        'is_active' => 'boolean',
    ];
//    /*to hide it from selection unless called in controller/*
    protected $hidden=['translations'];

    public function scopeParent($query){
        return $query->whereNull('parent_id');
    }

    public function scopeChild($query){
        return $query->whereNotNull('parent_id');
    }


    public  function getActive(){
       return $this->is_active ==0 ? 'غير مفعل':'مفعل';

    }

    public function mainCategory(){
        return $this->belongsTo(self::class, 'parent_id');
    }






    }
