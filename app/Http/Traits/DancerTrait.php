<?php
/**
 * Created by PhpStorm.
 * User: zsolt
 * Date: 2019. 04. 21.
 * Time: 11:51
 */

namespace App\Http\Traits;


use App\TypeDancer;
use Illuminate\Http\Request;

trait DancerTrait
{
    public final function saveDancer(TypeDancer $dancer,Request $request)
    {
        TypeDancer::updateOrCreate(['id' => $dancer->id],$request->except('_token'));
    }
    public final function deleteDancer(TypeDancer $dancer)
    {
        $dancer->delete();
    }
}