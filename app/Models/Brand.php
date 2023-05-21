<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Brand extends BaseModel
{
    const IMAGEPATH = 'brands' ; 

    use HasTranslations;
    protected $guarded =[];

    public $translatable = ['name'];

    protected $casts = [
        'active'      => 'boolean',
    ];
    public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }
    public function getActive(){
        return  $this -> active  == 0 ?  awtTrans('غير مفعل ')   :  awtTrans(' مفعل ')  ;
    }
}
