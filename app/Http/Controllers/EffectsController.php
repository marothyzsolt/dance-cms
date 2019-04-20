<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EffectsController extends Controller
{
    public function index() {
        return view('admin.effects');
    }
    public function upload(Request $request) {
        die(1234);
    }
}
