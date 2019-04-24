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
        <button class="btn btn-info btn-raised dancerToQueue">TO QUEUE</button>
    </div>
</div>

<script>
    $(".dancerToQueue").on("click", function() {
        let dancer1 = $("#dancer_left").val();
        let dancer2 = $("#dancer_right").val();
        ajax('{{url('cms/page/dancer/create')}}', 'POST', {id1:dancer1, id2:dancer2}, {
            success: function(data) {
                dancerQueue.push(data);
                refreshQueueView();
            }
        })
    });

    function refreshQueueView() {
        bake_cookie("queue", dancerQueue);

        var html = "";
        let index = 0;
        $(dancerQueue).each(function(i, e) {
            if(e.num1 === e.num2) {
                html += "<tr><td colspan='2'>" + e.num1 + "<br>" + e.name1 + "</td>";
            } else {
                html += "<tr><td>" + e.num1 + "<br>" + e.name1 + "</td>";
                html += "<td>" + e.num2 + "<br>" + e.name2 + "</td>";
            }
            html += "<td>" +
                "<button data-index='"+index+"' data-page_id='"+e.page_id+"' class='queueElementToLive btn btn-raised btn-success btn-fab'><i class='material-icons'>live_tv</i></button> " +
                (index!==0?"<button data-index='"+i+"' class='queueUp btn btn-raised btn-info btn-fab'><i class='material-icons'>expand_less</i></button>":"") +
                (i!==dancerQueue.length-1?"<button data-index='"+i+"' class='queueDown btn btn-raised btn-info btn-fab'><i class='material-icons'>expand_more</i></button> ":"") +
                "<button data-index='"+index+"' class='queueDelete btn btn-raised btn-danger btn-fab'><i class='material-icons'>delete</i></button>" +
                "</td>";
            html += "</tr>";
            index++;
        });
        $(".dancer_queue table tbody").html(html);
    }
    $(document).ready(function() {
        refreshQueueView();

        $("body").on("click", ".queueUp", function() {
            let index = $(this).attr("data-index");
            let temp = dancerQueue[index-1];
            if(temp === undefined)
                return;
            dancerQueue[index-1] = dancerQueue[index];
            dancerQueue[index] = temp;
            refreshQueueView();
        });

        $("body").on("click", ".queueDown", function() {
            let index = $(this).attr("data-index");
            let temp = dancerQueue[parseInt(index)+1];
            if(temp === undefined)
                return;
            dancerQueue[parseInt(index)+1] = dancerQueue[parseInt(index)];
            dancerQueue[index] = temp;
            refreshQueueView();
        });

        $("body").on("click", ".queueDelete", function() {
            let index = $(this).attr("data-index");
            dancerQueue.splice(index, 1);
            refreshQueueView();
        });

        $("body").on("click", ".queueElementToLive", function() {
            let page_id = $(this).attr("data-page_id");
            goLive(page_id, $(fadingTime).html(), parseInt($(fadingTime).html()*1.68));
        });
    });


</script>
