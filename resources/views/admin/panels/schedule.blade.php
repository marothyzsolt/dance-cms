<div class="row">
    <div class="col-md-12">

    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><b style="margin-right: 30px;">QUEUE</b>
                <button class="btn btn-success btn-raised queueAction">START</button>
                <button class="btn btn-warning btn-raised queueNext">NEXT</button>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Függöny animáció (ms): </span>
                    </div>
                    <input type="text" class="form-control" id="curtain_timeout">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Nevek megjelenése (ms): </span>
                    </div>
                    <input type="text" class="form-control" id="dancers_name_timeout">
                </div>

                <hr>

                <div class="dancer_queue">
                    <table class="table table-hover">
                        <thead style="text-align: center">
                        <tr>
                            <th>#1</th>
                            <th>#2</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody style="text-align: center">

                        </tbody>
                    </table>
                </div>

                <table class="table-hover table">
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="#1 Rajtszám" id="queue_number1">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="#2 Rajtszám" id="queue_number2">
                            </div>
                        </td>
                        <td><button class="addToQueue btn btn-raised btn-primary btn-fab"><i class="material-icons">last_page</i></button></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4 p-5">

    </div>
</div>

<script>
    var queueRunning = false;
    var queueTimeout1 = null;
    var queueTimeout2 = null;

    $(".queueNext").hide();

    $("body").on("click", ".queueAction", function () {
        if(queueRunning) { // STOP
            $(this).addClass("btn-success").removeClass("btn-danger").html("START");
            $(".queueNext").hide();
            queueRunning = false;
            clearTimeout(queueTimeout1);
            clearTimeout(queueTimeout2);
        } else { // START
            $(this).removeClass("btn-success").addClass("btn-danger").html("STOP");
            $(".queueNext").show();
            queueRunning = true;
            runQueue_stepCurtain();
        }
    });

    $("body").on("click", ".queueNext", function () {
        runQueue_stepCurtain();
    });



    function runQueue_stepCurtain()
    {
        if(queueRunning === false)
            return;
        let curtainEffectId = effectList[0];
        ajax('{{url('cms/page/select')}}', 'POST', {id:curtainEffectId})
        queueTimeout1 = setTimeout(function () {
            runQueue_stepNames();
        }, $("#curtain_timeout").val()?$("#curtain_timeout").val():5000)
    }

    function runQueue_stepNames()
    {
        if(queueRunning === false)
            return;

        let nextDancerData = dancerQueue.shift();
        let fadingTime = parseInt($("#fadingTime").html());
        if(fadingTime === 0) fadingTime = 1;
        goLive(nextDancerData.page_id, fadingTime, parseInt(fadingTime*1.68));

        refreshQueueView();
        queueTimeout2 = setTimeout(function () {
            randomEffect();
        }, $("#dancers_name_timeout").val()?$("#dancers_name_timeout").val():5000)
    }

    $("body").on("click", ".addToQueue", function () {
        let n1 = $("#queue_number1").val();
        let n2 = $("#queue_number2").val();
        if(n1.length === 0)
            return;
        if(n2.length === 0)
            n2 = n1;

        let dancer1 = findDancer(n1);
        let dancer2 = findDancer(n2);
        if(dancer1 !== 0 && dancer2 !== 0) {
            ajax('{{url('cms/page/dancer/create')}}', 'POST', {id1: dancer1, id2: dancer2}, {
                success: function (data) {
                    dancerQueue.push(data);
                    refreshQueueView();
                }
            })
        }
    });

    function findDancer(number)
    {
        let index = 0;
        $(dancers).each(function(i, dancer) {
            if(dancer.num == number) {
                index = dancer.id;
                return;
            }
        });
        return index;
    }
</script>
