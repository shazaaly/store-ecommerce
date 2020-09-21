<?php

namespace App\models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    use Translatable;

    protected $with=['translations'];  //to return trans with queries//
    protected $fillable=['is_active', 'photo'];
    protected $casts = [
        'is_active'=>'boolean'
    ];
    public $translatedAttributes=['name'];

    public function getActive(){
        return $this->is_active == 0 ? 'غير مفعل':'مفعل';
    }

    public function getPhotoAttribute($val){
        return ($val !== null)? asset('assets/images/brands/'.$val): "";
    }

}
