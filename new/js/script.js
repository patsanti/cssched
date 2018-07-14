$(document).ready(function() {
// get all schedule
      $.ajax({
      type: "POST",
      url: "php/functions.php",
      data: {
        get_data_schedule: "1"
       
      },
      success: function(result) {
          document.getElementById('schedule-data').innerHTML = result;
      },
      error: function(result) {

         }
    });
// get list of courses
     $.ajax({
      type: "POST",
      url: "php/functions.php",
      data: {
        get_course: "1"
       
      },
      success: function(result) {
          var course = eval(result);
          var Length = course.length / 2;
          var n = 0;

          for (var i = 0; i < Length; i++) {
            var option = '<option  value="'+course[n]+'"> '+course[n+1]+' </option>';
            n = n + 2;
            $("#select-course").append(option);
          }    
      },
      error: function(result) {

         }
    });
// get list of professors
    $.ajax({
      type: "POST",
      url: "php/functions.php",
      data: {
        get_prof: "1"
       
      },
      success: function(result) {
         
          var professor = eval(result);
          var Length = professor.length / 2;
          var n = 0;

          for (var i = 0; i < Length; i++) {
            var option = '<option  value="'+professor[n]+'"> '+professor[n+1]+' </option>';
            n = n + 2;
            $("#select-prof").append(option);
          }


      },
      error: function(result) {

         }
    });

// get list of class
    $.ajax({
      type: "POST",
      url: "php/functions.php",
      data: {
        get_class: "1"
       
      },
      success: function(result) {
          var class_name = eval(result);
          var Length = class_name.length / 2;
          var n = 0;

          for (var i = 0; i < Length; i++) {
            var option = '<option  value="'+class_name[n]+'"> '+class_name[n+1]+' </option>';
            n = n + 2;
            $("#select-class").append(option);
          }

      },
      error: function(result) {

         }
    });
// get list of room
     $.ajax({
      type: "POST",
      url: "php/functions.php",
      data: {
        get_room: "1"
       
      },
      success: function(result) {
          var room = eval(result);
          var Length = room.length / 2;
          var n = 0;

          for (var i = 0; i < Length; i++) {
            var option = '<option  value="'+room[n]+'"> '+room[n+1]+' </option>';
            n = n + 2;
            $("#select-room").append(option);
          }     
      },
      error: function(result) {

         }
    });


});

function check_submit() {
    var stat = "";
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            add_schedule: "1",
            "select-course": $("#select-course").val(),
            "select-prof": $("#select-prof").val(),
            "select-class": $("#select-class").val(),
            "select-day": $("#select-day").val(),
            "select-start-time": $("#select-start-time").val(),
            "select-end-time": $("#select-end-time").val(),
            "select-room": $("#select-room").val()
        },
        success: function(result) {
            if(result == 1){
              document.getElementById('error_msg').innerHTML = "Schedule Successfully Added";
              $("#error_msg").css({ color: 'green' });
            }
            else{
              document.getElementById('error_msg').innerHTML = "Conflict Schedule or Course has been already offered to a same class";
              $("#error_msg").css({ color: 'red' });

            }
        }
    });
    if (!stat)
        return false;
}