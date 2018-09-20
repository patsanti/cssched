$(document).ready(function() {
    
    var Year = 2018;
    for (var i = 0; i < 50; i++) {
        var option = '<option  value="' + Year + '"> ' + Year + ' </option>';
        Year = Year + 1;
        $("#year").append(option);
    }


    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            schedule_name: 1,
            status: 1
        },
        success: function(result) {
                var schedule = eval(result);
                var Length = schedule.length / 2;
                var n = 0;
                for (var i = 0; i < Length; i++){
                    var option = '<option  value="' + schedule[n] + '"> ' + schedule[n+1] + ' </option>';
                    $("#sched_name").append(option);
                    n = n + 2;
                }
        }
    });

        $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            schedule_name: 1,
            status: 2
        },
        success: function(result) {
                var schedule = eval(result);
                var Length = schedule.length / 2;
                var n = 0;
                for (var i = 0; i < Length; i++){
                    var option = '<option  value="' + schedule[n] + '"> ' + schedule[n+1] + ' </option>';
                    $("#sched_name_view").append(option);
                    n = n + 2;
                }
        }
    });

});


function open_schedule(sched) {
    var stat = "";

    if($('#sched_name').val() == 0){
        $("#error_msg_open").css({ color: 'red' });
        document.getElementById('error_msg_open').innerHTML = "0 Pending schedule request.";
        return false;
    }
    else{
        $.ajax({
            type: "POST",
            url: "php/functions.php",
            data: {
                open: 1,
                open_schedule_id: sched
            },
            success: function(result) {
                window.location.href = "request/";

            }
        });
    }
    if (!stat)
        return false;
}


function view_schedule(sched) {
    var stat = "";

    if($('#sched_name_view').val() == 0){

        $("#error_msg_view").css({ color: 'red' });
        document.getElementById('error_msg_view').innerHTML = "You got 0 approved schedule request.";
        return false;
    }
    else{
        $.ajax({
            type: "POST",
            url: "php/functions.php",
            data: {
                open: 1,
                open_schedule_id: sched
            },
            success: function(result) {
                window.location.href = "view/";

            }
        });
    }
    if (!stat)
        return false;
}