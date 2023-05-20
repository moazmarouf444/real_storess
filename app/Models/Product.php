<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Product extends BaseModel
{
    const IMAGEPATH = 'products' ; 

    use HasTranslations; 
    protected $fillable = ['title','description' ,'price'];
    public $translatable = ['title','description'];

}
