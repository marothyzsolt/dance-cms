<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><b>Táncos BAL oldal</b></div>
            <div class="card-body">
                <select title="Táncos #1" name="dancer_left{{rand(1,1000000)}}" data-live-search="true" class="selectpicker" id="dancer_left">
                    <option value="0">SELECT</option>
                    @foreach($categories as $category)
                        <optgroup label="{{$category->name}}" data-max-options="2">
                            @foreach($category->dancers as $id => $dancer)
                                <option value="{{$dancer->id}}">{{$dancer->title}}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><b>Táncos JOBB oldal</b></div>
            <div class="card-body">
                <select title="Táncos #2" name="dancer_right{{rand(1,1000000)}}" data-live-search="true" class="selectpicker" id="dancer_right">
                    @foreach($categories as $category)
                        <optgroup label="{{$category->name}}" data-max-options="2">
                            @foreach($category->dancers as $dancer)
                                <option value="{{$dancer->id}}">{{$dancer->title}}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4 p-5">
        <button class="btn btn-warning btn-raised dancerMakePreview">PREVIEW</button>
    </div>
</div>
