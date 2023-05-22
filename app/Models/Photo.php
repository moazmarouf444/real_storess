<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    use HasFactory,UploadTrait;
    protected $fillable = [
        'photoable_type',
        'photoable_id',
        'image',
    ];

    public function getImageAttribute() {
        if ($this->attributes['image']) {
            $image = $this->getImage($this->attributes['image'], 'photos');
        } else {
            $image = $this->defaultImage('photos');
        }
        return $image;
    }

    public function setImageAttribute($value) {
        if (null != $value && is_file($value)) {
            isset($this->attributes['image']) ? $this->deleteFile($this->attributes['image'], 'photos') : '';
            $this->attributes['image'] = $this->uploadAllTyps($value, 'photos');
        }
    }

    public function photoable(){
        return $this->morphTo();
    }
}
