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
<div id="content1">
{{($page->pageable->dancer1->num)}}<br>
{{($page->pageable->dancer1->name)}}<br><br>
{{($page->pageable->dancer2->num)}}<br>
{{($page->pageable->dancer2->name)}}
</div>


<script>

</script>



