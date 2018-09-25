$(document).ready(function() {
     // get list of courses
    $.ajax({
        type: "POST",
        url: "../../global/php/all_functions.php",
        data: {
            get_subject: "1"
        },
        success: function (result) {
            var course = eval(result);
            var Length = course.length / 2;
            var n = 0;

            for (var i = 0; i < Length; i++) {
                var option = '<option  value="' + course[n] + '"> ' + course[n + 1] + ' </option>';
                n = n + 2;
                $("#select-course").append(option);
            }
        },
        error: function (result) {

        }
    });

    $.ajax({
        type: "POST",
        url: "../../global/php/all_functions.php",
        data: {
            reasons: "1"
        },
        success: function (result) {
            $('#correction_revise').append(result);
        },
        error: function (result) {

        }
    });
    // get list of professors
    $.ajax({
        type: "POST",
        url: "../../global/php/all_functions.php",
        data: {
            get_prof: "1"
        },
        success: function (result) {

            var professor = eval(result);
            var Length = professor.length / 2;
            var n = 0;

            for (var i = 0; i < Length; i++) {
                var option = '<option  value="' + professor[n] + '"> ' + professor[n + 1] + ' </option>';
                n = n + 2;
                $("#select-prof").append(option);
                $("#select-prof-view").append(option);

            }
        },
        error: function (result) {

        }
    });

    // get list of class
    $.ajax({
        type: "POST",
        url: "../../global/php/all_functions.php",
        data: {
            get_class: "1"
        },
        success: function (result) {
            var class_name = eval(result);
            var Length = class_name.length / 2;
            var n = 0;

            for (var i = 0; i < Length; i++) {
                var option = '<option  value="' + class_name[n] + '"> ' + class_name[n + 1] + ' </option>';
                n = n + 2;
                $("#select-class").append(option);
                $("#select-class-view").append(option);

            }
        },
        error: function (result) {

        }
    });
    // get list of room
    $.ajax({
        type: "POST",
        url: "../../global/php/all_functions.php",
        data: {
            get_room: "1"
        },
        success: function (result) {
            var room = eval(result);
            var Length = room.length / 2;
            var n = 0;

            for (var i = 0; i < Length; i++) {
                var option = '<option  value="' + room[n] + '"> ' + room[n + 1] + ' </option>';
                n = n + 2;
                $("#select-room").append(option);
                $("#select-room-view").append(option);

            }
        }
    });
     $.ajax({
        type: "POST",
        url: "../../global/php/all_functions.php",
        data: {
            get_name: "1"
        },
        success: function (result) {
           document.getElementById('request-name').innerHTML = result;
        },
        error: function (result) {

        }
    });
});
// start up display
get_title("SELECT class_yr_blk FROM class WHERE class_id = 1","class_yr_blk",1,"class");
display_all_schedule("AND class_id=1");
// display schedule when user chooses professor

$('#select-prof-view').on('change', function() {
    var id = this.value;
    get_title("SELECT prof_lname FROM professor WHERE prof_id ="+id,"prof_lname",id,"professor");
    display_all_schedule("AND prof_id="+id);
});

// by cass
$('#select-class-view').on('change', function() {    
    var id = this.value;
    get_title("SELECT class_yr_blk FROM class WHERE class_id ="+id,"class_yr_blk",id,"class");
    display_all_schedule("AND class_id="+id);
});

//by room
$('#select-room-view').on('change', function() {
    var id = this.value;
    get_title("SELECT room_name FROM room WHERE room_id ="+id,"room_name",id,"room");
    display_all_schedule("AND room_id="+id);
});




// Display title
function get_title(query,name,id,type){
    $.ajax({
        type: "POST",
        url: "../../global/php/all_functions.php",
        data: {
            get_name_schedule: "1",
            sql: query,
            data: name,
            session_id: id,
            type_data: type
        },
        success: function (result) {
            document.getElementById('title_name').innerHTML = "Weekly Schedule of <b>"+result+"</b>";
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
        url: "../../global/php/all_functions.php",
        data: {
            submit_schedule: "1",
            status: 2
        },
        success: function (result) {
            $("#success_msg").css({ color: 'green' });
            document.getElementById('success_msg').innerHTML = result;
            window.setTimeout(function(){ window.location = "../index.php"; },1000);
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
        url: "../../global/php/all_functions.php",
        data: {
            change_schedule_request: "1",
            correction: $('#correction').val()
        },
        success: function (result) {
            
            $("#success_msg").css({ color: 'green' });
            document.getElementById('success_msg').innerHTML = result;
            window.setTimeout(function(){ window.location = "../index.php"; },1000);
        }

    });
  }
});




function display_all_schedule(id){
    var dp = new DayPilot.Calendar("dp");
    dp.startDate = "2013-03-04";  // DO NOT CHANGE!!
    dp.viewType = "Week";
    dp.headerDateFormat = "dddd";
    dp.init();
          $.ajax({
        type: "POST",
        url: "../../global/php/all_functions.php",
        data: {
            get_schedule_data_all: 1,
            query: id
        },
        success: function(result) {
            if(result != 0){
                var schedule = eval(result);
                var Length = schedule.length / 4;
                var n = 0;

                for (var i = 0; i < Length; i++){
                    var e = new DayPilot.Event({
                        start: new DayPilot.Date(schedule[n+2]),
                        end: new DayPilot.Date(schedule[n+3]),
                        id: schedule[n],
                        text: schedule[n+1],
                    });
                    dp.events.add(e);
                    n = n + 4;
                }
            }
            
        }
    });

// function when user clicked on the schedule
    dp.onEventClick = function(args) {
        var start = args.e.id();
        $.ajax({
            type: "POST",
            url: "../../global/php/all_functions.php",
            data: {
                show_schedule: start
            },
            success: function(result) {
                var schedule = eval(result);
                document.getElementById('course_code').innerHTML = "<b>Course Code:</b> " + schedule[0];
                document.getElementById('course_description').innerHTML = "<b>Course Description:</b> " + schedule[1];
                document.getElementById('professor').innerHTML = "<b>Faculty:</b> " + schedule[2];
                document.getElementById('class').innerHTML = "<b>Class:</b> " + schedule[3];
                document.getElementById('room').innerHTML = "<b>Room:</b> " + schedule[4];
                document.getElementById('schedule').innerHTML = "<b>Schedule:</b> " + schedule[5];      
                $("#myModal").modal();
            }
        });
    };
}
