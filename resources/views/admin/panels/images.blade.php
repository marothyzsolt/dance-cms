<div class="effect-list image-list">
    @foreach($imageTypes as $category)
        <div class="category row">
            <div class="title">
                <button data-id="{{$category->id}}" class="categoryToLive btn btn-raised btn-xs btn-dark"><small>LOOPING</small></button>
                <h4>{{$category->name}}</h4>
            </div>
            <div class="title_live">
                <div class="form-inline">
                    <div class="form-group">
                        <label for="" class="label"></label>
                        <input value="3500" type="text" class="timeout form-control" placeholder="Timeout (ms)">
                        <button data-id="{{$category->id}}" class="categoryToLiveAction btn btn-raised btn-xs btn-success"><small>PREVIEW</small></button>
                    </div>
                </div>
            </div>
            <div class="row col-md-12 listing">
                @foreach($category->images as $image)
                    <div class="col-md-2">
                        <a class="effect" data-id="{{$image->typeImage->page->id}}">
                            <img height="110px" width="90%" src="{{$image->url}}" alt="">
                            <div>{{$image->name}}</div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

<script>
    let imageSlideshowRunning = false;
    let imageSlideshowCurrentIndex = 0;
    let imageSlideshowEffectList = [];
    let imageSlideshowTimeout = 3500;

    let slideshowTimer = null;

    $(".title_live").hide();
    $(".categoryToLive").on("click", function () {
        $(".category .title").show();
        $(".category .title_live").hide();

        let categoryName = $(this).parent().children('h4').html();
        let html = "";
        $(this).parent().hide();
        $(this).parent().parent().children(".title_live").show(0, function() {
            $(this).find("label").html(categoryName + ": ").css("margin-right", "10px");
        });
    });

    $(".categoryToLiveAction").on("click", function() {
        $(".category .title").show();
        $(".category .title_live").hide();
        imageSlideshowEffectList = [];
        $("#preview").html("SLIDESHOW Images:<br>");
        $(this).closest('.category').find(".effect").each(function() {
            imageSlideshowEffectList.push($(this).attr("data-id"));
            let imgUrl = $(this).find("img").attr("src");
            $("#preview").append("<img src='"+imgUrl+"' width='80px' height='40px'/>");
        });

        imageSlideshowCurrentIndex = 0;
        imageSlideshowTimeout = $(this).closest('.category').find('.timeout').val();
        selectedPage = "IMG_SLIDESHOW";

        //ajax('{{url('cms/page/select')}}', 'POST', {id:pageId})
    });

    $(".stopSlideShow").on('click', function() {
        if(imageSlideshowRunning) {
            clearTimeout(slideshowTimer);
            imageSlideshowRunning = false;
            imageSlideshowEffectList = [];
            imageSlideshowCurrentIndex = 0;
        }
    });

    $("#go_live").on("click", function() {
        if(selectedPage === "IMG_SLIDESHOW") {
            console.log(imageSlideshowEffectList);
            if(imageSlideshowEffectList.length > 0)
            {
                console.log("START SLIDESHOW");
                imageSlideshowRunning = true;
                imageSlideshowCurrentIndex = 0;
                startSlideShow();
            }
        }
    });

    function startSlideShow()
    {
        if(!imageSlideshowRunning)
            return;
        let fadeInTime = imageSlideshowTimeout-(imageSlideshowTimeout*0.9);
        let fadeOutTime = imageSlideshowTimeout-(imageSlideshowTimeout*0.7);

        goLive(imageSlideshowEffectList[nextSlideshowIndex()], fadeInTime, fadeOutTime);

        slideshowTimer = setTimeout(function() {
            startSlideShow();
        }, imageSlideshowTimeout);
    }

    function nextSlideshowIndex() {
        if(imageSlideshowCurrentIndex >= imageSlideshowEffectList.length-1)
            return imageSlideshowCurrentIndex = 0;
        else
            return ++imageSlideshowCurrentIndex;
    }
</script>

<style>
    .image-list .title button {
        position: absolute;
    }
    .image-list .title h4 {
        margin-left: 80px;
    }
</style>
