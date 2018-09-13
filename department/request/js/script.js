//////////////////////////////////////////////////////////////
$(document).ready(function() {

     // get list of courses
    $.ajax({
        type: "POST",
        url: "php/functions.php",
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
    // get list of professors
    $.ajax({
        type: "POST",
        url: "php/functions.php",
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
        url: "php/functions.php",
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
        url: "php/functions.php",
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
});









var dp = new DayPilot.Calendar("dp");
dp.startDate = "2013-03-04";  // DO NOT CHANGE!!
dp.viewType = "Week";
dp.headerDateFormat = "dddd";
dp.init();


get_title("SELECT prof_lname FROM professor WHERE prof_id = 1 ","prof_lname",1,"professor");
// for getting all schedule data and displays
$.ajax({
    type: "POST",
    url: "php/functions.php",
    data: {
        get_schedule_data_all: 1,
        query: " AND prof_id =1"
    },
    success: function(result) {
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
});


// event creating schedule
dp.onTimeRangeSelected = function (args) {
    var subject = document.getElementById('select-course').value;
    var professor = document.getElementById('select-prof').value;
    var class_data = document.getElementById('select-class').value;
    var room = document.getElementById('select-room').value;
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            get_schedule_data: 1,
            get_subject_1: subject,
            get_professor_1: professor,
            get_class_1: class_data,
            get_room_1: room
        },
        success: function(result) {

            var name = result;
            if (!name) return;
            var e = new DayPilot.Event({
                start: args.start,
                end: args.end,
                id: DayPilot.guid(),
                text: name
            });

            var start_time = args.start.toString();
            var end_time = args.end.toString();
            start_time = start_time.split("T");
            end_time = end_time.split("T");
            var day = start_time[0].split("-");
            
            $.ajax({
                type: "POST",
                url: "php/functions.php",
                data: {
                    add_schedule: 1,
                    start_time: start_time[1],
                    end_time: end_time[1],
                    subject: subject,
                    professor: professor,
                    class_1: class_data,
                    room: room,
                    day: day[2]

                },
                success: function(result) {
                    if(result == 1){
                        dp.events.add(e);
                        dp.clearSelection();
                        $("#error_msg").css({ color: 'green' });
                        document.getElementById('error_msg').innerHTML = " Schedule Added";
                        window.setTimeout(function(){ window.location = "index.html"; },1000);
                    }
                    else{
                        $("#error_msg").css({ color: 'red' });
                        document.getElementById('error_msg').innerHTML = "Conflict: Schedule Already Taken!";
                    }
                    
                }
            });
            
        }
    });
};


// function when user clicked on the schedule
dp.onEventClick = function(args) {
    var start = args.e.id();
    $.ajax({
        type: "POST",
        url: "php/functions.php",
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



//////////////////////////////////////////////////////////////


$('#select-prof-view').on('change', function() {
    var dp = new DayPilot.Calendar("dp");
    dp.startDate = "2013-03-04";  // DO NOT CHANGE!!
    dp.viewType = "Week";
    dp.headerDateFormat = "dddd";
    dp.init();
    
    var id = this.value;
    var id_glo = id;
    get_title("SELECT prof_lname FROM professor WHERE prof_id ="+id,"prof_lname",id,"professor");
      $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            get_schedule_data_all: 1,
            query: " AND prof_id ="+id
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

      // event creating schedule
    dp.onTimeRangeSelected = function (args) {
        var subject = document.getElementById('select-course').value;
        var professor = document.getElementById('select-prof').value;
        var class_data = document.getElementById('select-class').value;
        var room = document.getElementById('select-room').value;
        $.ajax({
            type: "POST",
            url: "php/functions.php",
            data: {
                get_schedule_data: 1,
                get_subject_1: subject,
                get_professor_1: professor,
                get_class_1: class_data,
                get_room_1: room
            },
            success: function(result) {

                var name = result;
                if (!name) return;
                var e = new DayPilot.Event({
                    start: args.start,
                    end: args.end,
                    id: DayPilot.guid(),
                    text: name
                });
                var start_time = args.start.toString();
                var end_time = args.end.toString();
                start_time = start_time.split("T");
                end_time = end_time.split("T");
                var day = start_time[0].split("-");
                $.ajax({
                    type: "POST",
                    url: "php/functions.php",
                    data: {
                        add_schedule: 1,
                        start_time: start_time[1],
                        end_time: end_time[1],
                        subject: subject,
                        professor: professor,
                        class_1: class_data,
                        room: room,
                        day: day[2]

                    },
                    success: function(result) {
                        if(result == 1){
                            dp.events.add(e);
                            dp.clearSelection();
                            $("#error_msg").css({ color: 'green' });
                            document.getElementById('error_msg').innerHTML = " Schedule Added";
                            window.setTimeout(function(){ window.location = "index.html"; },1000);
                        }
                        else{
                            $("#error_msg").css({ color: 'red' });
                            document.getElementById('error_msg').innerHTML = "Conflict: Schedule Already Taken!";
                        }
                        
                    }
                });
                
            }
        });
    };

    dp.onEventClick = function(args) {
    var start = args.e.id();
    $.ajax({
        type: "POST",
        url: "php/functions.php",
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

});




// display schedule when user chooses professor
$('#select-class-view').on('change', function() {
    var dp = new DayPilot.Calendar("dp");
    dp.startDate = "2013-03-04";  // DO NOT CHANGE!!
    dp.viewType = "Week";
    dp.headerDateFormat = "dddd";
    dp.init();
    
    var id = this.value;
    get_title("SELECT class_yr_blk FROM class WHERE class_id ="+id,"class_yr_blk",id,"class");
      $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            get_schedule_data_all: 1,
            query: " AND class_id ="+id
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

    // event creating schedule
    dp.onTimeRangeSelected = function (args) {
        var subject = document.getElementById('select-course').value;
        var professor = document.getElementById('select-prof').value;
        var class_data = document.getElementById('select-class').value;
        var room = document.getElementById('select-room').value;
        $.ajax({
            type: "POST",
            url: "php/functions.php",
            data: {
                get_schedule_data: 1,
                get_subject_1: subject,
                get_professor_1: professor,
                get_class_1: class_data,
                get_room_1: room
            },
            success: function(result) {

                var name = result;
                if (!name) return;
                var e = new DayPilot.Event({
                    start: args.start,
                    end: args.end,
                    id: DayPilot.guid(),
                    text: name
                });
                var start_time = args.start.toString();
                var end_time = args.end.toString();
                start_time = start_time.split("T");
                end_time = end_time.split("T");
                var day = start_time[0].split("-");
                $.ajax({
                    type: "POST",
                    url: "php/functions.php",
                    data: {
                        add_schedule: 1,
                        start_time: start_time[1],
                        end_time: end_time[1],
                        subject: subject,
                        professor: professor,
                        class_1: class_data,
                        room: room,
                        day: day[2]

                    },
                    success: function(result) {
                        if(result == 1){
                            dp.events.add(e);
                            dp.clearSelection();
                            $("#error_msg").css({ color: 'green' });
                            document.getElementById('error_msg').innerHTML = " Schedule Added";
                            window.setTimeout(function(){ window.location = "index.html"; },1000);
                        }
                        else{
                            $("#error_msg").css({ color: 'red' });
                            document.getElementById('error_msg').innerHTML = "Conflict: Schedule Already Taken!";
                        }
                        
                    }
                });
                
            }
        });
    };

    dp.onEventClick = function(args) {
    var start = args.e.id();
    $.ajax({
        type: "POST",
        url: "php/functions.php",
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

});




//by room
$('#select-room-view').on('change', function() {
    var dp = new DayPilot.Calendar("dp");
    dp.startDate = "2013-03-04";  // DO NOT CHANGE!!
    dp.viewType = "Week";
    dp.headerDateFormat = "dddd";
    dp.init();
    
    var id = this.value;
    get_title("SELECT room_name FROM room WHERE room_id ="+id,"room_name",id,"room");
      $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            get_schedule_data_all: 1,
            query: " AND room_id ="+id
        },
        success: function(result) {
            if(result !=0){
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

      // event creating schedule
    dp.onTimeRangeSelected = function (args) {
        var subject = document.getElementById('select-course').value;
        var professor = document.getElementById('select-prof').value;
        var class_data = document.getElementById('select-class').value;
        var room = document.getElementById('select-room').value;
        $.ajax({
            type: "POST",
            url: "php/functions.php",
            data: {
                get_schedule_data: 1,
                get_subject_1: subject,
                get_professor_1: professor,
                get_class_1: class_data,
                get_room_1: room
            },
            success: function(result) {

                var name = result;
                if (!name) return;
                var e = new DayPilot.Event({
                    start: args.start,
                    end: args.end,
                    id: DayPilot.guid(),
                    text: name
                });
                var start_time = args.start.toString();
                var end_time = args.end.toString();
                start_time = start_time.split("T");
                end_time = end_time.split("T");
                var day = start_time[0].split("-");
                $.ajax({
                    type: "POST",
                    url: "php/functions.php",
                    data: {
                        add_schedule: 1,
                        start_time: start_time[1],
                        end_time: end_time[1],
                        subject: subject,
                        professor: professor,
                        class_1: class_data,
                        room: room,
                        day: day[2]

                    },
                    success: function(result) {
                        if(result == 1){
                            dp.events.add(e);
                            dp.clearSelection();
                            $("#error_msg").css({ color: 'green' });
                            document.getElementById('error_msg').innerHTML = " Schedule Added";
                            window.setTimeout(function(){ window.location = "index.html"; },1000);
                        }
                        else{
                            $("#error_msg").css({ color: 'red' });
                            document.getElementById('error_msg').innerHTML = "Conflict: Schedule Already Taken!";
                        }
                        
                    }
                });
                
            }
        });
    };

    dp.onEventClick = function(args) {
    var start = args.e.id();
    $.ajax({
        type: "POST",
        url: "php/functions.php",
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

});




// Display title
function get_title(query,name,id,type){
    $.ajax({
        type: "POST",
        url: "php/functions.php",
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
        url: "php/functions.php",
        data: {
            submit_schedule: "1",
        },
        success: function (result) {
            $("#success_msg").css({ color: 'green' });
            document.getElementById('success_msg').innerHTML = result;
            window.setTimeout(function(){ window.location = "../index.html"; },1000);
        }

    });
  }
});