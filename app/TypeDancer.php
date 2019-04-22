<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeDancer extends Model
{
    protected $fillable = ['dancer1_id','dancer2_id'];

    public function dancer1()
    {
        return $this->belongsTo(Dancer::class);
    }
    public function dancer2()
    {
        return $this->belongsTo(Dancer::class);
    }

}
