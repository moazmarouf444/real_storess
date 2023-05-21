<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class DeliveryArea extends BaseModel
{

    use HasTranslations; 
    protected $fillable = ['name','price'];
    public $translatable = ['name'];

}
