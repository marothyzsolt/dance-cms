<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="token" content="{{csrf_token()}}">
    <link rel="icon" href="{{url('cms.png')}}">

    <title>Dancing Competition</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

    <!-- Material Design for Bootstrap CSS -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/checkout/form-validation.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.1/bootstrap-slider.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.1/css/bootstrap-slider.min.css" />

    <script>
        function bake_cookie(name, value) {
            var cookie = [name, '=', JSON.stringify(value), '; domain=.', window.location.host.toString(), '; path=/;'].join('');
            document.cookie = cookie;
        }
        function read_cookie(name) {
            var result = document.cookie.match(new RegExp(name + '=([^;]+)'));
            result && (result = JSON.parse(result[1]));
            return result;
        }
        function delete_cookie(name) {
            document.cookie = [name, '=; expires=Thu, 01-Jan-1970 00:00:01 GMT; path=/; domain=.', window.location.host.toString()].join('');
        }
    </script>
    <style>
        .filter-option-inner-inner {
            color: black;
        }

        .dropdown-menu, .dropdown-item, .dropdown-toggle  {
            width: 320px !important;
            max-width: 500px !important;
        }
        @media(min-width: 772px)
        {
            .dropdown-menu, .dropdown-item, .dropdown-toggle  {
                width: 200px !important;
                max-width: 500px !important;
            }
        }
        @media(min-width: 1120px)
        {
            .dropdown-menu, .dropdown-item, .dropdown-toggle  {
                width: 310px !important;
                max-width: 500px !important;
            }
        }
        @media(min-width: 1386px)
        {
            .dropdown-menu, .dropdown-item, .dropdown-toggle  {
                width: 395px !important;
                max-width: 500px !important;
            }
        }
        @media(min-width: 1520px)
        {
            .dropdown-menu, .dropdown-item, .dropdown-toggle  {
                width: 450px !important;
                max-width: 500px !important;
            }
        }

        .dropdown-toggle {
            box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);
        }

        .btn-group-xs > .btn, .btn-xs {
            padding  : .45rem .95rem;
            font-size  : .670rem;
            line-height  : 1.1;
            border-radius : .2rem;
        }

        .btn-fab {
            width: 0.5rem !important;
            min-width: 1.5rem !important;
            height: 1.5rem !important;
            border-radius: 10% !important;
            box-shadow: 0 1px 1.5px 0 rgba(0,0,0,.12),0 1px 1px 0 rgba(0,0,0,.26) !important;
            padding: 0 !important;
            line-height: 0 !important;
            font-size: 1.2rem !important;
            overflow: hidden !important;
        }

        .btn-fab i.material-icons {
            font-size: 19px;
        }
    </style>
</head>

<body class="bg-light">

@yield('content')


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/holder.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';

        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<script src="js/base.js"></script>
@yield('script')
</body>
</html>

