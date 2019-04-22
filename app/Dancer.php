<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dancer extends Model
{
    protected $fillable = ['num','name','dancer_category_id'];

    public function getTitleAttribute()
    {
        return "{$this->num} | {$this->name}";
    }
}
