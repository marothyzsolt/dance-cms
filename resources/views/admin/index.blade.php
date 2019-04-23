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
        <div class="checks">
            <select class="custom-select custom-select-sm" name="x{{rand(1,1000000)}}" id="viewType">
                <option value="0">SIMPLE</option>
                <option value="1">DOUBLE SIDE</option>
                <option value="2">DS MIRROR</option>
            </select>
        </div>
        <div class="golive-container">
            <button id="go_live" class="btn btn-success btn-raised stopSlideShow">GO LIVE > <br><small id="fadingTime" style="font-size:10px">4000</small> </button>
        </div>
        <div class="settings-container">
            <input id="fading" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="10000" data-slider-step="250" data-slider-value="3500"/>
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
        <div class="col-md-1">
            <button data-toggle="collapse" data-parent="#panel_parent" href="#panel_images" class="btn btn-info btn-sm">Képek</button>
        </div>
        <div class="col-md-1">
            <button data-toggle="collapse" data-parent="#panel_parent" href="#panel_schedule" class="btn btn-info btn-sm">Időzítő</button>
        </div>
    </div>

    <div id="panel_parent">
        <div id="panel_effects" class="collapse in" data-parent="#panel_parent">
            @include('admin.panels.effects')
        </div>

        <div id="panel_dancers" class="collapse in" data-parent="#panel_parent">
            @include('admin.panels.dancers')
        </div>

        <div id="panel_images" class="collapse in" data-parent="#panel_parent">
            @include('admin.panels.images')
        </div>

        <div id="panel_schedule" class="collapse in show" data-parent="#panel_parent">
            @include('admin.panels.schedule')
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
            $('#preview').html('<img id="theImg" src="'+link+'" width="400" height="240"/>');
        });

        function goLive(id, fadeIn, fadeOut)
        {
            if(fadeIn === undefined) fadeIn = 3500;
            if(fadeOut === undefined) fadeOut = 5000;
            ajax('{{url('cms/page/select')}}', 'POST', {id: id, viewType: $("#viewType").val(), fadeInTime: fadeIn, fadeOutTime: fadeOut})
        }


        $("#go_live").on('click', function() {
            if(selectedPage == null)
                return;
            let e = this;
            $(e).prop('disabled', true);
            setTimeout(function () {
                $(e).prop('disabled', false);
            }, 2000);

            if(selectedPage !== "IMG_SLIDESHOW") {
                let fadingTime = parseInt($("#fadingTime").html());
                if(fadingTime === 0) fadingTime = 1;
                goLive(selectedPage, fadingTime, parseInt(fadingTime*1.68));
            }
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

        $('#fading').slider({
            formatter: function(value) {
                $("#fadingTime").html(value);
            }
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

        .preview-container {
            padding: 0 100px 0 100px;
        }

        #preview {
            border: 1px solid #bdbfb1;
            height: 240px;
        }

        #go_live {
            line-height: 13px;
        }

        .checks {
            margin-top:10px;
            text-align: center;
        }

    </style>
@endsection
