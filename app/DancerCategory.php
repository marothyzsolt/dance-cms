<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DancerCategory extends Model
{
    public function dancers()
    {
        return $this->hasMany(Dancer::class);
    }

}
