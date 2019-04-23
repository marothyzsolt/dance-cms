<div class="row effect-list">
    @foreach($effects as $effect)
        <div class="col-md-2">
            <a class="effect" data-id="{{$effect->page->id}}">
                <img width="100%" src="{{$effect->thumbnail}}" alt="">
                <div>{{$effect->name}}</div>
            </a>
        </div>
    @endforeach
</div>
