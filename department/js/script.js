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
            schedule_name: 1
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

});



function create_schedule() {
    var stat = "";
    $("#create").val("Creating Request...");
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            create: 1,
            year: $("#year").val(),
            semester:$("#semester").val()
        },
        success: function(result) {
            if (result == 1) {
                window.location.href = "weekly/";
            }
            else {
                $("#profile").val("Create");
                $("#error_msg").css({ color: 'red' });
                document.getElementById("error_msg").innerHTML = "Schedule Request Already Exist!";
                stat = false;
            }
        }
    });
    if (!stat)
        return false;
}


function create_schedule() {
    var stat = "";
    $("#create").val("Creating Request...");
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            create: 1,
            year: $("#year").val(),
            semester:$("#semester").val()
        },
        success: function(result) {
            alert(result);
            if (result == 1) {
                window.location.href = "weekly/";
            }
            else {
                $("#profile").val("Create");
                $("#error_msg").css({ color: 'red' });
                document.getElementById("error_msg").innerHTML = "Schedule Request Already Exist!";
                stat = false;
            }
        }
    });
    if (!stat)
        return false;
}

function open_schedule() {
    var stat = "";

    if($('#sched_name').val() == 0){
        $("#error_msg_open").css({ color: 'red' });
        document.getElementById('error_msg_open').innerHTML = "You got 0 Unfinished schedule request. create one first";
        return false;
    }
    else{
        $.ajax({
            type: "POST",
            url: "php/functions.php",
            data: {
                open: 1,
                open_schedule_id: $('#sched_name').val()
            },
            success: function(result) {
                window.location.href = "weekly/";

            }
        });
    }
    if (!stat)
        return false;
}