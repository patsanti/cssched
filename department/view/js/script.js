// initialize calendar
var dp = new DayPilot.Calendar("dp");
dp.startDate = "2013-03-04";  // DO NOT CHANGE!!
dp.viewType = "Week";
dp.headerDateFormat = "dddd";
dp.init();

//start up display when visiting view page 
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



// display schedule when user chooses professor
$('#select-prof').on('change', function() {
    var dp = new DayPilot.Calendar("dp");
    dp.startDate = "2013-03-04";  // DO NOT CHANGE!!
    dp.viewType = "Week";
    dp.headerDateFormat = "dddd";
    dp.init();
    
    var id = this.value;
      $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            get_schedule_data_all: 1,
            query: " AND prof_id ="+id
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




    
$(document).ready(function() {

    var url = window.location.href;
    var filename = url.substring(url.lastIndexOf('/')+1);
    if (filename === "") filename = "index.html";
    $(".menu a[href='" + filename + "']").addClass("selected");



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