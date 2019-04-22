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

    public static function createEffect(TypeEffect $typeEffect)
    {
        return self::create(
            [
                'pageable_id' => $typeEffect->id,
                'pageable_type' => TypeEffect::class,
            ]
        );
    }

    public static function createDancer(TypeDancer $typeDancer)
    {
        return self::create(
            [
                'pageable_id' => $typeDancer->id,
                'pageable_type' => TypeDancer::class,
            ]
        );
    }
}
