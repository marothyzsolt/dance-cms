@extends('layouts.cms')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-4">
                <a href="{{route('cms.dancers.create')}}" class="float-right">
                    <button type="button" class="btn btn-info bmd-btn-icon active">
                        <i class="material-icons">add</i>
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        @include('layouts.messages')
        <div class="col-md-6 offset-md-3">
            <table class="table table-hover">

                @foreach($categories as $category)
                    <tr style="text-align: center">
                        <td style="color:red; font-size: 17px" colspan="3"><b>{{$category->name}}</b></td>
                    </tr>
                    @foreach($category->dancers as $dancer)
                        <tr style="line-height: 10px;">
                            <td width="10px"><b>{{$dancer->num}}</b></td>
                            <td>{{$dancer->name}}</td>
                            <td><a href="{{route('cms.dancers.edit', ['id' => $dancer->id])}}"><i class="material-icons">edit</i></a></td>
                            <td><a href="{{route('cms.dancers.delete', ['id' => $dancer->id])}}"><i class="material-icons">delete</i></a></td>
                        </tr>
                    @endforeach
                @endforeach

            </table>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
@endsection
