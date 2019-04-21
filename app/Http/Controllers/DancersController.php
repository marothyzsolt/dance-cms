<?php
/**
 * Created by PhpStorm.
 * User: zsolt
 * Date: 2019. 04. 21.
 * Time: 11:33
 */

namespace App\Http\Controllers;

use App\Http\Traits\DancerTrait;
use App\TypeDancer;
use Illuminate\Http\Request;

class DancersController extends Controller
{
    use DancerTrait;
    public function index() {
        return view('admin.dancers')
            ->with(['dancers' => TypeDancer::all()]);
    }
    public function edit(TypeDancer $dancer) {
        return view('admin.dancers_edit')
            ->with(['dancer' => $dancer]);
    }
    public function save(TypeDancer $dancer,Request $request) {
        $this->saveDancer($dancer,$request);
        return redirect()->back()->withSuccess('Sikeres mentés!');
    }
    public function delete(TypeDancer $dancer) {
        $this->deleteDancer($dancer);
        return redirect()->back()->withSuccess('Sikeres törlés!');
    }
    public function upload(Request $request) {
        dd($request);
    }
}