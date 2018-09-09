$(document).ready(function() {
    // get all schedule
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            get_data_schedule: "0"
        },
        success: function (result) {
            document.getElementById('approve_data').innerHTML = result;
        },
        error: function (result) {

        }
    });


});


function request_type(value){
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            get_data_schedule: value
        },
        success: function (result) {
            
            document.getElementById('approve_data').innerHTML = result;
        },
        error: function (result) {

        }
    });
}