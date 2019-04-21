<?php

namespace App\Http\Controllers;

use App\TypeEffect;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index')
            ->with(['effects' => TypeEffect::all()]);
    }
}
