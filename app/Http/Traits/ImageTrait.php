<?php
/**
 * Created by PhpStorm.
 * User: zsolt
 * Date: 2019. 04. 21.
 * Time: 11:51
 */

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ImageSaveRequest;
use App\Image;
use Illuminate\Http\Request;

trait ImageTrait
{
    public final function saveImage(Image $image,ImageSaveRequest $request) {
        $datas = $request->except('_token');
        $datas['path'] = $this->getFileName($request);
        //dd($this->getFileName($request));
        $imageCreate = Image::updateOrCreate(['id' => $image->id], $datas);
        $this->moveImage($imageCreate,$request);
    }
    public final function deleteImage(Image $image) {
        $image->delete();
    }
    public function moveImage(Image $imageCreate,ImageSaveRequest $request) {
        if($request->hasfile('path'))
        {
                $fileName=$request->file('path')->getClientOriginalName();
                $path = storage_path("app/public/images/".$imageCreate->id."/");
                $request->file('path')->move($path, $fileName);
        }
    }
    public function getFileName(ImageSaveRequest $request) {
        $fileName = '';
        if($request->hasfile('path')) {
            $fileName=$request->file('path')->getClientOriginalName();
        }
        return ($fileName) ? $fileName : $request->path;
    }
}
