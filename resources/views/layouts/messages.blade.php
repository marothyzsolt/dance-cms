@if(count($errors) > 0)
    <div class="alert alert-danger"><b>Hiba!</b> <br>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        <b>{{session('success')}}</b>
    </div>
@endif
