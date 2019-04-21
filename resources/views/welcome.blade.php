<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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

    <div id="main1">
        @include('types.effect')
    </div>

    <div id="main2">

    </div>

    <script>
        var currentMain = "main1";

        function getNextMain() {
            return currentMain == 'main1'?'main2':'main1';
        }
        $("#main2").fadeOut(1);
        $("#main1").fadeIn(1);

        var updatePage = function() {
            $.ajax({
                type: "GET",
                url: '{{ url('pool') }}',
                success: function(data) {
                    $("#"+getNextMain()).html(data.view);
                    $("#"+getNextMain()).fadeIn(3500);
                    $("#"+currentMain).fadeOut(5000);
                    currentMain = getNextMain();
                },
                error: function() {
                    //console.log('Ooops, something happened!');
                },
                dataType: 'json',
                complete: function() {
                    updatePage();
                },
            });
        };

        updatePage();
    </script>
    </body>
</html>


