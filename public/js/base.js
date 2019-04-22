$(document).ready(function() {

});

function ajax(url, type, data, callback)
{
    let CSRF_TOKEN = $('meta[name="token"]').attr('content');
    data._token = CSRF_TOKEN;
    $.ajax({
        url: url,
        type: type,
        data: data,
        dataType: 'JSON',
        success: function (data) {if(callback !== undefined) callCallable(callback.success, data)},
        error: function (data) {if(callback !== undefined) callCallable(callback.error, data)},
        complete: function (data) {if(callback !== undefined) callCallable(callback.complete, data)},
    });
}

function callCallable(func, data) {
    if(func !== undefined && func instanceof Function) func(data);
}
