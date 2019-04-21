@extends('layouts.cms')
@section('content')
    @include('layouts.messages')
    <ul>
        @foreach($dancers as $dancer)
        <li>{{$dancer->id}}</li>
        <li>{{$dancer->name1}}</li>
        <li>{{$dancer->name2}}</li>
    </ul>
    <div class="row">
        <form method="post" action="{{route('cms.dancers.upload')}}" enctype="multipart/form-data"
              class="dropzone" id="dropzone">
            @csrf
        </form>
    </div>
    @endforeach
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
@endsection
