 var dp = new DayPilot.Calendar("dp");
    dp.startDate = "2013-03-04";  // DO NOT CHANGE!!
    dp.viewType = "Week";
    
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
                            document.getElementById('error_msg').innerHTML = "Schedule/Subject Already Taken!";
                        }
                        
                    }
                });
                
            }
        });


    };
    // function when user clicked on the schedule
    dp.onEventClick = function(args) {

        //alert(args.e.start());
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

    dp.headerDateFormat = "dddd";
    dp.init();

    // for getting all schedule data and displays
        $.ajax({
            type: "POST",
            url: "php/functions.php",
            data: {
                get_schedule_data_all: 1
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


    
    
$(document).ready(function() {
    var url = window.location.href;
    var filename = url.substring(url.lastIndexOf('/')+1);
    if (filename === "") filename = "index.html";
    $(".menu a[href='" + filename + "']").addClass("selected");

///////////

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
            }
        },
        error: function (result) {

        }
    });




});