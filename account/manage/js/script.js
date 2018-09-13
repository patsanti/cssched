$(document).ready(function() {
    // get all schedule
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            get_account_info: 1
        },
        success: function (result) {
            //document.getElementById('approve_data').innerHTML = result;
        },
        error: function (result) {

        }
    });


});


function create_user() {
    var stat = "";
    $("#submit").val("Creating Account...");
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            uname: $("#username").val(),
            pass: $("#password").val(),
            type:$("#user_type").val()
        },
        success: function(result) {
            if (result == 1) {
                $("#submit").val("Login");
                $("#error_msg").css({ color: 'green' });
                document.getElementById("error_msg").innerHTML = "Account Created";
                window.setTimeout(function(){ window.location = "index.html"; },3000);

            }
            else {
                $("#submit").val("Login");
                $("#error_msg").css({ color: 'red' });
                document.getElementById("error_msg").innerHTML = "username already taken!";
                stat = false;
            }
        }
    });
    if (!stat)
        return false;
}