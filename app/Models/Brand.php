<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Brand extends BaseModel
{
    const IMAGEPATH = 'brands' ; 

    use HasTranslations; 
    protected $fillable = ['title','description' ,'image'];
    public $translatable = ['title','description'];

}
