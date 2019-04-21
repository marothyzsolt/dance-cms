<?php

namespace App\Http\Controllers;

use App\Page;
use App\Setting;
use App\TypeEffect;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function select(Request $request) {
        $response = "1";
        $page = Page::find($request->get('id'));
        \Setting::set('page', $page->id);
        \Setting::save();

        return response()->json($response);
    }
}
