<?php $x1 = rand(1, 100000); $x2 = rand(1, 5000000); ?>
<?php $video1 = rand(1, 100000); $video2 = rand(1, 5000000); ?>


<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .video {
        position: fixed;
        top: 0;
        left: 0;
        min-height: 100%;
        object-fit: fill;
        min-width: 50%;
        width: 50%;
    }

    @if($viewType > 0)
        .videox{{$video1}} {
            left: 0 !important;
        }
        .videox{{$video2}} {
            left: 50% !important;
        }
        @if($viewType == 2)
            .videox{{$video2}} {
            -moz-transform:    scaleX(-1); /* Gecko */
            -o-transform:      scaleX(-1); /* Opera */
            -webkit-transform: scaleX(-1); /* Webkit */
            transform:         scaleX(-1); /* Standard */
            filter: FlipH;                 /* IE 6/7/8 */
        }
        @endif
    @else
        .videox{{$video1}} {
            width: 100% !important;
            left: 0;
            min-width: 100% !important;
        }
    @endif

</style>


<video loop preload class="video videox{{$video1}} video{{$x1}}" id="">
    <source src="{{$page->pageable->url}}" type="video/mp4">
</video>

<video loop autoplay preload class="video videox{{$video1}} video{{$x2}}" id="">
    <source src="{{$page->pageable->url}}" type="video/mp4">
</video>

@if($viewType > 0)
    <video loop preload class="video videox{{$video2}} video{{$x1}}" id="">
        <source src="{{$page->pageable->url}}" type="video/mp4">
    </video>

    <video loop autoplay preload class="video videox{{$video2}} video{{$x2}}" id="">
        <source src="{{$page->pageable->url}}" type="video/mp4">
    </video>
@endif


<script>
    function _getNextVideo() {
        return currentPlaying=='video{{$x1}}'?'video{{$x2}}':'video{{$x1}}';
    }

    function getNextVideo(e) {
        return e.id == 'video{{$x1}}'?'video{{$x2}}':'video{{$x1}}';
    }
    var endingOutTime = 4000;

    var currentPlaying = 'video{{$x2}}';
    var isFading = false;

    $("video").currentTime = 0;

    $(".video{{$x1}}").fadeOut(1);

    $('video').bind('ended', function(){
        this.currentTime = 0;
    });

    $('video').on('timeupdate', function(event) {
        var current = Math.round(event.target.currentTime * 1000);
        var total = Math.round(event.target.duration * 1000);

        if(this.id == currentPlaying) { // current MAIN playing
            if ((total - current) < endingOutTime && !isFading) {
                isFading = true;
                console.log('fade out');
                $(this).fadeOut(2800);
                var last = this;

                let nextPlaying = _getNextVideo();
                document.getElementById(nextPlaying).play();
                $("."+nextPlaying).fadeIn(2000);
                setTimeout(function() {
                    last.pause();
                    last.currentTime = 0;
                    currentPlaying = nextPlaying;
                    isFading = false;
                }, 3000);
            }
        }
        if(this.id != currentPlaying) {
            if(current >= total) isFading = false;
        }
    });
</script>



