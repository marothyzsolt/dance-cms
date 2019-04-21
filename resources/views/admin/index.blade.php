@extends('layouts.cms')
@section('content')

<div class="container-fluid">

<div class="row">
    <div class="col-md-5 preview-container">
        <div class="title">PREVIEW</div>
        <div id="preview">
            <img src="https://via.placeholder.com/400x240">
        </div>
    </div>
    <div class="col-md-2 golive-container">
        <button id="go_live" class="btn btn-success">GO LIVE > </button>
    </div>
    <div class="col-md-5 live-container">
        <div class="title">LIVE</div>
        <iframe src="{{url('/')}}"></iframe>
    </div>
</div>

<div class="row effect-list">
    @foreach($effects as $effect)
        <div class="col-md-2">
            <a class="effect" data-id="{{$effect->page->id}}">
                <img width="100%" src="{{$effect->thumbnail}}" alt="">
                <div>{{$effect->name}}</div>
            </a>
        </div>
    @endforeach
</div>

</div>
@endsection
@section('script')
    <script>
        var selectedPage = null;
        $(".effect").click(function() {
            var pageID = $(this).attr('data-id');
            selectedPage = pageID;
            var link = $(this).children('img').attr('src');
            $('#preview').html('<img id="theImg" src="'+link+'" width="400"/>');
        });


        $("#go_live").on('click', function() {
            if(selectedPage == null)
                return;
            let e = this;
            $(e).prop('disabled', true);
            setTimeout(function () {
                $(e).prop('disabled', false);
            }, 2000);

            var CSRF_TOKEN = $('meta[name="token"]').attr('content');
            console.log(CSRF_TOKEN);
            $.ajax({
                url: '{{url('cms/selectPage')}}',
                type: 'POST',
                data: {_token: CSRF_TOKEN, id:selectedPage},
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                }
            });
            console.log(selectedPage);
        });
    </script>

    <style>

        .effect {
            cursor: pointer;
        }

        .effect {
            text-align: center;
        }

        .container-fluid {
            padding: 10px 40px !important;
        }

        .effect-list {
            margin-top: 20px;
        }

        iframe {
            width: 400px;
            height: 230px;
        }

        .live-container, .preview-container {
            text-align: center;
            font-weight: bold;
        }

        .golive-container {
            text-align: center;
            margin-top:100px;
        }

    </style>
@endsection
