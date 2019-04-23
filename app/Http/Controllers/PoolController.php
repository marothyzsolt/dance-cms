<?php

namespace App\Http\Controllers;

use App\Page;
use App\TypeDancer;
use App\TypeEffect;
use App\TypeImage;
use Illuminate\Http\Request;

class PoolController extends Controller
{
    private $currentPage = null;
    private $viewType = null;
    private $tick = 0;

    public function index() {
        $this->currentPage = \Setting::get('page');
        $this->viewType = \Setting::get('viewType');
        while(true)
        {
            if($this->hasUpdate())
            {
                $page = \App\Page::find($this->currentPage);
                if($page->pageable_type == TypeEffect::class) $view = 'types.effect';
                if($page->pageable_type == TypeDancer::class) $view = 'types.dancer';
                if($page->pageable_type == TypeImage::class) $view = 'types.image';
                return response()->json([
                    'fadeInTime' => $this->loadSetting('fadeInTime')?:2000,
                    'fadeOutTime' => $this->loadSetting('fadeOutTime')?:4000,
                    'viewType' => $this->viewType,
                    'view' => view($view, compact('page'))->with('viewType', $this->viewType)->render()
                ]);
            }
            usleep(0.5*(1000000));
            $this->tick++;
            if($this->tick > 20) exit();
        }
    }

    public function hasUpdate()
    {
        $hasPageUpdate = $this->currentPage != $this->loadSetting('page');
        $hasViewTypeUpdate = $this->viewType != $this->loadSetting('viewType');
        if($hasPageUpdate)
            $this->currentPage = \Setting::get('page');
        if($hasViewTypeUpdate)
            $this->viewType = \Setting::get('viewType');
        return $hasPageUpdate || $hasViewTypeUpdate;
    }

    private function loadSetting($name)
    {
        \Setting::load($name);
        return \Setting::get($name);
    }
}
