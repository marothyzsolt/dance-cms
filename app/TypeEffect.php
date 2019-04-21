<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeEffect extends Model
{
    protected $fillable = ['name'];

    public function getPathAttribute()
    {
        return url("storage/effects/".$this->id."/");
    }

    public function getUrlAttribute()
    {
        return $this->path."/".$this->name;
    }

    public function getThumbnailAttribute()
    {
        return $this->path."/image.jpg";
    }

    public function page()
    {
        return $this->morphOne(Page::class, 'pageable');
    }
}
