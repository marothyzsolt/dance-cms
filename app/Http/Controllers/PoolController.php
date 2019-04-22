<?php

namespace App\Http\Controllers;

use App\Page;
use App\TypeDancer;
use App\TypeEffect;
use Illuminate\Http\Request;

class PoolController extends Controller
{
    private $currentPage = null;
    private $tick = 0;

    public function index() {
        $this->currentPage = \Setting::get('page');
        while(true)
        {
            if($this->hasUpdate())
            {
                $page = \App\Page::find($this->currentPage);
                if($page->pageable_type == TypeEffect::class) $view = 'types.effect';
                if($page->pageable_type == TypeDancer::class) $view = 'types.dancer';
                return response()->json([
                    'view' => view($view, compact('page'))->render()
                ]);
            }
            usleep(1000*1000);
            $this->tick++;
            if($this->tick > 10) exit();
        }
    }

    public function hasUpdate()
    {
        $hasUpdate = $this->currentPage != $this->loadSetting('page');
        if($hasUpdate)
            $this->currentPage = \Setting::get('page');
        return $hasUpdate;
    }

    private function loadSetting($name)
    {
        \Setting::load($name);
        return \Setting::get($name);
    }
}
