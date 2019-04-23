<?php

namespace App\Http\Controllers;

use App\Dancer;
use App\Page;
use App\TypeDancer;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function select(Request $request) {
        $response = "1";
        $page = Page::find($request->get('id'));
        $fadeInTime = $request->get('fadeInTime');
        $fadeOutTime = $request->get('fadeOutTime');

        \Setting::set('page', $page->id);
        \Setting::set('fadeInTime', $fadeInTime);
        \Setting::set('fadeOutTime', $fadeOutTime);
        \Setting::save();

        return response()->json($response);
    }

    public function createDancerPage(Request $request)
    {
        $dancer1 = Dancer::find($request->get('id1'));
        $dancer2 = Dancer::find($request->get('id2'));

        $typeDancer = TypeDancer::create(
            [
                'dancer1_id' => $dancer1->id,
                'dancer2_id' => $dancer2->id,
            ]
        );

        $page = Page::createDancer($typeDancer);

        $data = [
            'page_id' => $page->id,
            'num1' => $dancer1->num,
            'name1' => $dancer1->name,
            'num2' => $dancer2->num,
            'name2' => $dancer2->name,
        ];

        return response()->json($data);
    }
}
