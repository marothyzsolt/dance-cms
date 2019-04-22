<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = ['name','path','image_type_id'];

    /*protected $casts = [
        'path' => 'array'
    ];*/

}
