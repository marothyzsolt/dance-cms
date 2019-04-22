@extends('layouts.cms')
@section('content')
    <link href="https://www.jquery-az.com/boots/css/bootstrap-imageupload/bootstrap-imageupload.css" rel="stylesheet">
    @include('layouts.messages')
    <style>
        .container{
            margin-top:20px;
        }
        .image-preview-input {
            position: relative;
            overflow: hidden;
            margin: 0px;
            color: #333;
            background-color: #fff;
            border-color: #ccc;
        }
        .image-preview-input input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
        .image-preview-input-title {
            margin-left:2px;
        }
    </style>
    <div class="container">
        <form action="{{route('cms.images.save',['image' => $image->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{(old('name', $image->name))}}">
            </div>
            <!--<div class="form-group">
                <label>Path:</label>
                <input type="text" class="form-control" id="path" name="path" value="">
            </div>-->
            <div class="imageupload panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left">Select Image file</h3>
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default active">File</button>
                        <button type="button" class="btn btn-default">URL</button>
                    </div>
                    @php
                        //{{url('storage/images/')}}/{{$image->id}}/{{$image->path}}">{{$image->name}}
                            if (strpos($image->path, 'http') !== false) $prevImage = $image->path;
                            else $prevImage = url('storage/images/'.$image->id."/".$image->path);
                    @endphp
                    @if(isset($image->path))
                        <img with="200px" height="200px" src="{{$prevImage}}" alt="{{$image->name}}">
                    @endif
                </div>
                <div class="file-tab panel-body">
                    <label class="btn btn-primary btn-file">
                        <span>Browse</span>
                        <input type="file" name="path" value="{{(old('path', $image->path))}}">
                    </label>
                    <button type="button" class="btn btn-danger">Delete image</button>
                </div>
                <div class="url-tab panel-body">
                    <div class="input-group">
                        <input type="text" class="form-control hasclear" id="path" name="path" placeholder="{{(old('path', $image->path))}}">
                    </div>
                    <button type="button" class="btn btn-default">Remove</button>
                </div>

            </div>
            <div class="mb-lg-3"></div>
            <div class="form-group">
                <label>Image Type ID:</label>
                <select data-live-search="true" class="selectpicker" id="image_type_id" name="image_type_id">
                    @foreach($image_types as $id => $type)
                        <option {{(old('image_type_id', $type->image_type_id)==$type->id)}} value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{url('js/images.js')}}"></script>
    <script>
        var $imageupload = $('.imageupload');

        $imageupload.imageupload();
    </script>
@endsection
