<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Country extends BaseModel
{
    use HasTranslations; 
    
    protected $fillable = ['name','key'];
    
    public $translatable = ['name'];

    public function cities()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }
}
