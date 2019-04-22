@extends('layouts.cms')
@section('content')
    @include('layouts.messages')
    <div class="container">
        <form action="{{route('cms.dancers.save',['dancer' => $dancer->id])}}" method="POST">
            @csrf
            <div class="form-group">
                <label>Num:</label>
                <input type="text" class="form-control" id="num" name="num" value="{{(old('num', $dancer->num))}}">
            </div>
            <div class="form-group">
                <label>Name1:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{(old('name', $dancer->name))}}">
            </div>
            <div class="form-group">
                <label>Category ID:</label>
                <select data-live-search="true" class="selectpicker" id="" name="dancer_category_id">
                    @foreach($categories as $id => $category)
                        <option {{(old('dancer_category_id', $dancer->dancer_category_id)==$category->id)}} value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
