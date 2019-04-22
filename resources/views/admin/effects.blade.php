@extends('layouts.cms')
@section('content')
    @include('layouts.messages')
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://images-eds-ssl.xboxlive.com/image?url=8Oaj9Ryq1G1_p3lLnXlsaZgGzAie6Mnu24_PawYuDYIoH77pJ.X5Z.MqQPibUVTcxOxL9BTKHYqrenhdzWu_nohKq74prk1Dd2HNnTSc6_0CRPfgrUfuVjHnM7E4u4B67z9CkohEV6ZKbgzgDHKa9vbfwfYPratcUp_E6G6XceDZixIW6nosqqUPP7i2AKz7qx6pmk1NG7oGb5TK1v30BXoC9_WB1PDjNkKpFLxJJK0-&h=1080&w=1920&format=jpg" alt="" width="150" height="150">
        <h2>Dancing</h2>
    </div>

    <div class="row">
        <form method="post" action="{{route('cms.effects.upload')}}" enctype="multipart/form-data"
              class="dropzone" id="dropzone">
            @csrf
        </form>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
@endsection
