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
}
