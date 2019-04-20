<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoolController extends Controller
{
    public function index() {
        $e = "";
        die();
        while(true)
        {
            if($this->hasUpdate())
            {

            }
            usleep(1000*1000);
        }
    }

    public function hasUpdate()
    {
        echo "123";
    }
}
