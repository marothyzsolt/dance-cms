<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
            .video {
                position: fixed;
                right: 0;
                bottom: 0;
                min-width: 100%;
                min-height: 100%;
            }
        </style>

        <title>Laravel</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

        </style>
    </head>
    <body>
        <video controls preload class="video" id="video1">
            <source src="2.mp4" type="video/mp4">
        </video>

        <video autoplay controls preload class="video" id="video2">
            <source src="2.mp4" type="video/mp4">
        </video>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


        <script>
            /*$('#video1').bind('ended', function(){
                $("#video1").fadeOut();

                $("#video2").css('display', 'block');
                $("#video2").fadeIn();
                document.getElementById('video2').play();
            });*/

            function getNextVideo(e) {
                return e.id == 'video1'?'video2':'video1';
            }
            var endingOutTime = 4000;

            var currentPlaying = 'video1';
            var isFading = false;

            $('video').bind('ended', function(){
                this.currentTime = 0;
            });

            $('video').on('timeupdate', function(event) {
                var current = Math.round(event.target.currentTime * 1000);
                var total = Math.round(event.target.duration * 1000);

                if ( ( total - current ) < endingOutTime && !isFading) {
                    $(this).fadeOut(4000);
                    $("#"+getNextVideo(this)).fadeIn(4000);
                    document.getElementById(getNextVideo(this)).play();
                    isFading = true;
                }

                if(this.id != currentPlaying && current > endingOutTime)
                {
                    isFading = false;
                }
            });
        </script>
    </body>
</html>


