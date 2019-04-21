<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['pageable_type', 'pageable_id'];

    public function pageable()
    {
        return $this->morphTo();
    }
}
