<?php $x1 = rand(1, 100000); $x2 = rand(1, 5000000); ?>

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
        right: 0;
        bottom: 0;
        min-width: 100%;
        min-height: 100%;
        width: 100%;
    }

</style>


<video loop preload class="video" id="video{{$x1}}">
    <source src="{{$page->pageable->url}}" type="video/mp4">
</video>

<video loop autoplay preload class="video" id="video{{$x2}}">
    <source src="{{$page->pageable->url}}" type="video/mp4">
</video>


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

   // document.getElementById("video{{$x1}}").pause();
   // document.getElementById("video{{$x1}}").currentTime = 0;
    $("#video{{$x1}}").fadeOut(1);

    $('video').bind('ended', function(){
        this.currentTime = 0;
    });

    $('video').on('timeupdate', function(event) {
        var current = Math.round(event.target.currentTime * 1000);
        var total = Math.round(event.target.duration * 1000);

        /*if(this.id != currentPlaying) {
            if ((total - current) < endingOutTime && !isFading) {
                console.log('fading');
                $(this).fadeOut(4000);
                $("#" + getNextVideo(this)).fadeIn(1000);
                document.getElementById(getNextVideo(this)).play();
                isFading = true;
            }

            if (this.id != currentPlaying && current > endingOutTime) {
                isFading = false;
            }
        } else {
            if(current >= total) {
                document.getElementById(currentPlaying).pause();
                document.getElementById(currentPlaying).currentTime = 0;
            }
        }*/

       // console.log(this.id + " " + this.currentTime);
        if(this.id == currentPlaying) { // current MAIN playing
            if ((total - current) < endingOutTime && !isFading) {
                isFading = true;
                console.log('fade out');
                $(this).fadeOut(2800);
                var last = this;

                let nextPlaying = _getNextVideo();
                document.getElementById(nextPlaying).play();
                $("#"+nextPlaying).fadeIn(2000);
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

        if(current >= total) {
            //this.pause();
            //this.currentTime = 0;
        }
    });
</script>



