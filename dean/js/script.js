$(document).ready(function() {
    professor();
    class_data();
    room();


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


    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            schedule_name: 1,
            status: 4
        },
        success: function(result) {
                var schedule = eval(result);
                var Length = schedule.length / 2;
                var n = 0;
                for (var i = 0; i < Length; i++){
                    var option = '<option  value="' + schedule[n] + '"> ' + schedule[n+1] + ' </option>';
                    $("#sched_name_rejected").append(option);
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


function view_schedule_rejected(sched) {
    var stat = "";

    if($('#sched_name_rejected').val() == 0){

        $("#error_msg_rejected").css({ color: 'red' });
        document.getElementById('error_msg_rejected').innerHTML = "You got 0 rejected schedule request.";
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



function professor(){
     $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            professor: 1
        },
        success: function(result) {
            document.getElementById('all-professor-table').innerHTML = result;
        }
    });
}

function class_data(){
     $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            class: 1
        },
        success: function(result) {
            document.getElementById('all-class-table').innerHTML = result;
        }
    });
}

function room(){
     $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            room: 1
        },
        success: function(result) {
            document.getElementById('all-room-table').innerHTML = result;
        }
    });
}


var modalConfirm = function(callback){
  
  $("#btn-confirm").on("click", function(){
    $("#mi-modal").modal('show');
  });

  $("#modal-btn-si").on("click", function(){
    callback(true);
    $("#mi-modal").modal('hide');
  });
  
  $("#modal-btn-no").on("click", function(){
    callback(false);
    $("#mi-modal").modal('hide');
  });
};

modalConfirm(function(confirm){
  if(confirm){
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            type_add: "prof",
            fname: $('#fname').val(),
            mname: $('#mname').val(),
            lname: $('#lname').val()

        },
        success: function (result) {
            //window.setTimeout(function(){ window.location = "index.php"; },1000);
            professor();
        },
        error: function(){
            alert("error encountered");
        }

    });
  }
});



var modalConfirm2 = function(callback){
  
  $("#btn-confirm2").on("click", function(){
    $("#mi-modal2").modal('show');
  });

  $("#modal-btn-si2").on("click", function(){
    callback(true);
    $("#mi-modal2").modal('hide');
  });
  
  $("#modal-btn-no2").on("click", function(){
    callback(false);
    $("#mi-modal2").modal('hide');
  });
};

modalConfirm2(function(confirm){
  if(confirm){
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            type_add: "class",
            class_name: $('#class_name').val()

        },
        success: function (result) {
            //window.setTimeout(function(){ window.location = "index.php"; },1000);
            class_data();
        },
        error: function(){
            alert("error encountered");
        }

    });
  }
});


var modalConfirm3 = function(callback){
  
  $("#btn-confirm3").on("click", function(){
    $("#mi-modal3").modal('show');
  });

  $("#modal-btn-si3").on("click", function(){
    callback(true);
    $("#mi-modal3").modal('hide');
  });
  
  $("#modal-btn-no3").on("click", function(){
    callback(false);
    $("#mi-modal3").modal('hide');
  });
};

modalConfirm3(function(confirm){
  if(confirm){
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            type_add: "room",
            room_name: $('#room_name').val()

        },
        success: function (result) {
            //window.setTimeout(function(){ window.location = "index.php"; },1000);
            room();
        },
        error: function(){
            alert("error encountered");
        }

    });
  }
});