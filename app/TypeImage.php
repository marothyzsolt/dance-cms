<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeImage extends Model
{
    protected $fillable = ['image_id'];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function page()
    {
        return $this->morphOne(Page::class, 'pageable');
    }
}
