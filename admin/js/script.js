$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            manage_user: 1
        },
        success: function(result) {
            $("#manage-user-data").append(result);
            //document.getElementById('manage-user-data').innerHTML = result
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
                window.setTimeout(function(){ window.location = "index.php"; },1000);

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


function change_password() {
    var stat = "";
    $("#submit").val("Updating...");
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
                window.setTimeout(function(){ window.location = "index.php"; },3000);

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