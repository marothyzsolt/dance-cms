<?php
/**
 * Created by PhpStorm.
 * User: zsolt
 * Date: 2019. 04. 21.
 * Time: 11:33
 */

namespace App\Http\Controllers;

use App\Dancer;
use App\DancerCategory;
use App\Http\Requests\DancerSaveRequest;
use App\Http\Traits\DancerTrait;
use App\TypeDancer;
use Illuminate\Http\Request;

class DancerController extends Controller
{
    use DancerTrait;
    public function index() {
        return view('admin.dancers')
            ->with(['categories' => DancerCategory::all()]);
    }
    public function edit(Dancer $dancer) {
        $categories = DancerCategory::all();
        return view('admin.dancers_edit', compact('dancer', 'categories'));
    }
    public function save(Dancer $dancer, DancerSaveRequest $request) {
        $this->saveDancer($dancer,$request);
        return redirect()->route('cms.dancers.index')->withSuccess('Sikeres mentés!');
    }
    public function delete(Dancer $dancer) {
        $this->deleteDancer($dancer);
        return redirect()->back()->withSuccess('Sikeres törlés!');
    }
}
