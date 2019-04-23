<?php $x1 = rand(1, 100000); $x2 = rand(1, 5000000); ?>

<style>
    html, body {
        background-color: #fff;
        color: #000000;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .video_dancer {
        position: absolute;
        bottom: 0;
        height: 100%;
        min-height: 100%;
        opacity: 0.17;
        object-fit: fill;
        z-index: 0;
    }

    #video_dancer1 {
        left: 0;
        min-width: 50%;
        width: 50%;
    }

    #video_dancer2 {
        left: 50%;
        min-width: 50%;
        width: 50%;
    }

    #content1, #content2 {
        position: fixed;
        top: 0;
        width: 50%;
        text-align: center;
        z-index: 100;
    }
    #content2 {
        left: 50%;
    }

    @media(max-width: 1000px) {
        .dancer_screen {
            padding: 50px 0;
        }

        .dancer_screen .num {
            font-size: 70px;
        }

        .dancer_screen .name {
            font-size: 20px;
        }
    }

    @media(min-width: 1000px) {
        .dancer_screen {
            padding: 260px 0;
        }

        .dancer_screen .num {
            font-size: 220px;
        }

        .dancer_screen .name {
            font-size: 45px;
        }
    }
</style>
<video autoplay loop preload class="video_dancer" id="video_dancer1">
    <source src="{{url('video/plexus_.mp4')}}" type="video/mp4">
</video>
<video autoplay loop preload class="video_dancer" id="video_dancer2">
    <source src="{{url('video/plexus_.mp4')}}" type="video/mp4">
</video>

<div class="dancer_screen" id="content1">
    <div class="num">{{($page->pageable->dancer1->num)}}</div>
    <div class="name">{{($page->pageable->dancer1->name)}}</div>
</div>

<div class="dancer_screen" id="content2">
    <div class="num">{{($page->pageable->dancer2->num)}}</div>
    <div class="name">{{($page->pageable->dancer2->name)}}</div>
</div>


<script>

</script>



