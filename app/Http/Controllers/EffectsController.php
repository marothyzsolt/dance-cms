<?php

namespace App\Http\Controllers;

use App\Http\Requests\EffectsUploadRequest;
use App\Page;
use App\TypeEffect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EffectsController extends Controller
{
    public function index() {

        //$sec = 10;
        //$movie = public_path("storage/effects/11/2.mp4");
        //dd($movie);
        //$thumbnail = 'thumbnail.png';

       /// $ffmpeg = \FFMpeg\FFMpeg::create();
        //$video = $ffmpeg->open($movie);
        //$frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($sec));
        //$frame->save($thumbnail);
        //echo '<img src="'.$thumbnail.'">';
      //  dd();
        return view('admin.effects');
    }
    public function upload(Request $request) {
        /*$fileName = $request->file('file')->getClientOriginalName();
        \VideoThumbnail::createThumbnail($request->file('file')->getRealPath(), '/', '/tmp/image.jpg', 2, 1920, 1080);
        $typeEffect = TypeEffect::create(['name' => $fileName]);
        $path = "public/effects/".$typeEffect->id."/";
        $request->file('file')->move($path, $fileName);*/


        $fileName = $request->file('file')->getClientOriginalName();
        $realPath = $request->file('file')->getRealPath();

        $typeEffect = TypeEffect::create(['name' => $fileName]);
        $page = Page::create(['pageable_id' => $typeEffect->id, 'pageable_type' => 'effect']);
        $path = storage_path("app/public/effects/".$typeEffect->id."/");
        $img = "{$realPath}.jpg";

        \VideoThumbnail::createThumbnail($realPath, '/', $img, 2, 1920, 1080);
        $request->file('file')->move($path, $fileName);

        \VideoThumbnail::createThumbnail("{$path}{$fileName}", '/', "{$path}image.jpg", 2, 1920, 1080);
    }
}
