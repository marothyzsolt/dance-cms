@extends('layouts.cms')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-4">
                <a href="{{route('cms.images.create')}}" class="float-right">
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

                @foreach($types as $type)
                    <tr style="text-align: center">
                        <td style="color:red; font-size: 17px" colspan="3"><b>{{$type->name}}</b></td>
                    </tr>
                    @foreach($type->images as $image)
                        <tr style="line-height: 10px;">
                            @php
                            //{{url('storage/images/')}}/{{$image->id}}/{{$image->path}}">{{$image->name}}
                                if (strpos($image->path, 'http') !== false) $prevImage = $image->path;
                                else $prevImage = url('storage/images/'.$image->id."/".$image->path);
                            @endphp
                            <td class="pop" data-img="{{$prevImage}}">{{$image->name}}</td>
                            <td><a href="{{route('cms.images.edit', ['id' => $image->id])}}"><i class="material-icons">edit</i></a></td>
                            <td><a href="{{route('cms.images.delete', ['id' => $image->id])}}"><i class="material-icons">delete</i></a></td>
                        </tr>
                    @endforeach
                @endforeach
                    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <img src="" class="imagepreview" style="width: 100%;" >
                                </div>
                            </div>
                        </div>
                    </div>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $('.pop').on('click', function() {
                $('.imagepreview').attr('src', $(this).attr('data-img'));
                $('#imagemodal').modal('show');
            });
        });
    </script>
@endsection
