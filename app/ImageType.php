<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageType extends Model
{
    protected $table = 'image_types';
    protected $fillable = ['name'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

}
