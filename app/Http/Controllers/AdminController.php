<?php

namespace App\Http\Controllers;

use App\DancerCategory;
use App\Page;
use App\TypeEffect;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $effects = TypeEffect::all();
        $categories = DancerCategory::all();
        $effectList = Page::where('pageable_type', TypeEffect::class)->get('id')->pluck('id');
        return view('admin.index', compact('effects', 'categories', 'effectList'));
    }
}
