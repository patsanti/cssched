$(document).ready(function() {
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




});
