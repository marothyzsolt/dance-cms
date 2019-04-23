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

    .image {
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%;
        min-height: 100%;
        width: 100%;
        background: url('{{$page->pageable->image->url}}');
        background-size: 100% 100%;
    }

</style>


<img class="image" src="{{$page->pageable->image->url}}" alt="">
