$(document).ready(function() {
// get list of courses
     $.ajax({
      type: "POST",
      url: "php/functions.php",
      data: {
        get_course: "1"
       
      },
      success: function(result) {
          document.getElementById("select-course").innerHTML = result;       
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
          document.getElementById("select-prof").innerHTML = result;       
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
          document.getElementById("select-class").innerHTML = result;       
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
          document.getElementById("select-room").innerHTML = result;       
      },
      error: function(result) {

         }
    });
// submit button    
      function check_submission(){
      
        $.ajax({
          type: "POST",
          url: "php/functions.php",
          data: {
            add_schedule: "1"
           
          },
          success: function(result) {
              alert(result);

          },
          error: function(result) {

             }
        });

     }   
         
    
});
