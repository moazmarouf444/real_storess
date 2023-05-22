<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Product extends BaseModel
{
    const IMAGEPATH = 'products' ; 
    protected $guarded = [];
    use HasTranslations; 
    public $translatable = ['name','description'];
    protected $casts = [
        'is_active'      => 'boolean',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function getActive(){
        return  $this -> is_active  == 0 ?  awtTrans('غير مفعل ')   :  awtTrans(' مفعل ')  ;
    }

    public function photos() {
        return $this->morphMany(Photo::class, 'photoable');
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($product) { // before delete() method call this
            $product->photo()->delete();
        });
    }

}
