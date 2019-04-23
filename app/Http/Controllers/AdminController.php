<?php

namespace App\Http\Controllers;

use App\DancerCategory;
use App\ImageType;
use App\Page;
use App\TypeEffect;

class AdminController extends Controller
{
    public function index() {
        $effects = TypeEffect::all();
        $imageTypes = ImageType::all();
        $categories = DancerCategory::all();
        $effectList = Page::where('pageable_type', TypeEffect::class)->get('id')->pluck('id');
        return view('admin.index', compact('effects', 'categories', 'effectList', 'imageTypes'));
    }
}
