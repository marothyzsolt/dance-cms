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
    <div class="col-md-2">
        <div class="golive-random-container">
            <button id="go_live_random_effect" class="btn btn-info btn-raised btn-xs">RANDOM EFFECT LIVE > </button>
        </div>
        <div class="golive-container">
            <button id="go_live" class="btn btn-success btn-raised">GO LIVE > </button>
        </div>
    </div>
    <div class="col-md-5 live-container">
        <div class="title"><a href="{{url('/')}}" target="_blank">LIVE</a></div>
        <iframe src="{{url('/')}}"></iframe>
    </div>
</div>

    <div class="row p-4">
        <div class="col-md-1">
            <button data-toggle="collapse" data-parent="#panel_parent" href="#panel_effects" class="btn btn-info btn-sm">Effektek</button>
        </div>
        <div class="col-md-1">
            <button data-toggle="collapse" data-parent="#panel_parent" href="#panel_dancers" class="btn btn-info btn-sm">Táncosok</button>
        </div>
    </div>

    <div id="panel_parent">
        <div id="panel_effects" class="collapse in " data-parent="#panel_parent">
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

        <div id="panel_dancers" class="collapse in show" data-parent="#panel_parent">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><b>Táncos BAL oldal</b></div>
                        <div class="card-body">
                            <select title="Táncos #1" name="dancer_left{{rand(1,1000000)}}" data-live-search="true" class="selectpicker" id="dancer_left">
                                <option value="0">SELECT</option>
                                @foreach($categories as $category)
                                    <optgroup label="{{$category->name}}" data-max-options="2">
                                        @foreach($category->dancers as $id => $dancer)
                                            <option value="{{$dancer->id}}">{{$dancer->title}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><b>Táncos JOBB oldal</b></div>
                        <div class="card-body">
                            <select title="Táncos #2" name="dancer_right{{rand(1,1000000)}}" data-live-search="true" class="selectpicker" id="dancer_right">
                                @foreach($categories as $category)
                                    <optgroup label="{{$category->name}}" data-max-options="2">
                                        @foreach($category->dancers as $dancer)
                                            <option value="{{$dancer->id}}">{{$dancer->title}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-5">
                    <button class="btn btn-warning btn-raised dancerMakePreview">PREVIEW</button>
                </div>
            </div>
        </div>
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

            ajax('{{url('cms/page/select')}}', 'POST', {id:selectedPage})
        });

        var effectList = @json($effectList);

        $("#go_live_random_effect").on('click', function() {
            var randomEffectPageId = effectList[Math.floor(Math.random()*effectList.length)];
            ajax('{{url('cms/page/select')}}', 'POST', {id:randomEffectPageId})
        });

        $(".dancerMakePreview").on('click', function() {
            let dancer1 = $("#dancer_left").val();
            let dancer2 = $("#dancer_right").val();
            console.log(dancer1);
            console.log(dancer2);
            ajax('{{url('cms/page/dancer/create')}}', 'POST', {id1:dancer1, id2:dancer2}, {
                success: function(data) {
                    let html = "" +
                        "<div class='row preview_dancers'>" +
                            "<div class='col-md-6'>" +
                                "<div class='num'>" +
                                    data.num1+
                                "</div><br>"+
                                data.name1+
                            "</div>" +
                            "<div class='col-md-6'>" +
                                "<div class='num'>"+
                                    data.num2+
                                "</div><br>"+
                                data.name2+
                            "</div>" +
                        "</div>";
                    $("#preview").html(html);
                    console.log(data);
                    selectedPage = data.page_id;
                }
            })
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
            margin-top: 80px;
        }
        .golive-random-container {
            text-align: center;
            margin-top:10px;
            font-size: 13px;
        }

        .preview_dancers {
            font-size: 12px;
            padding: 80px 80px;
        }
        .preview_dancers .num {
            font-size: 17px;
        }

    </style>
@endsection
