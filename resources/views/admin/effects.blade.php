
    <div class="row">
        <form method="post" action="{{route('cms.effects.upload')}}" enctype="multipart/form-data"
              class="dropzone" id="dropzone">
            @csrf
        </form>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
