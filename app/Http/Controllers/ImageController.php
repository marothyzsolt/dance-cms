<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageSaveRequest;
use App\Http\Traits\ImageTrait;
use App\Image;
use App\ImageType;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    use ImageTrait;
    public function index() {
        return view('admin.images')
            ->with(['types' => ImageType::all()]);
    }
    public function edit(Image $image) {
        $image_types = ImageType::all();
        return view('admin.images_edit', compact('image', 'image_types'));
    }
    public function save(Image $image, ImageSaveRequest $request) {
        $this->saveImage($image,$request);
        return redirect()->route('cms.images.index')->withSuccess('Sikeres mentés!');
    }
    public function delete(Image $image) {
        $this->deleteImage($image);
        return redirect()->back()->withSuccess('Sikeres törlés!');
    }
}
