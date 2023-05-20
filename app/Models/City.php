<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class City extends BaseModel
{
    use HasTranslations; 
    
    protected $fillable = ['name','country_id'];
    
    public $translatable = ['name'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    
}
