$(document).ready(function() {
    // get all schedule
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            info: "0"
        },
        success: function (result) {
            var data = JSON.parse(result);
            $('#fname').val(data['fname']);
            $('#lname').val(data['lname']);
            $('#uname').val(data['username']);
        },
        error: function (result) {
            console.log("error in retrieving account data");
        }
    });


});


function update_profile() {
    var stat = "";
    $("#profile").val("Updating Profile...");
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            profile: 1,
            fname: $("#fname").val(),
            lname:$("#lname").val()
        },
        success: function(result) {
            if (result == 1) {
                $("#profile").val("Updating...");
                $("#error_msg").css({ color: 'green' });
                document.getElementById("error_msg").innerHTML = "Profile Updated";
                window.setTimeout(function(){ window.location = "index.php"; },1000);

            }
            else {
                $("#profile").val("Update");
                $("#error_msg").css({ color: 'red' });
                document.getElementById("error_msg").innerHTML = "Update failed";
                stat = false;
            }
        }
    });
    if (!stat)
        return false;
}



function update_password() {
    var stat = "";
    $("#account").val("Updating Account...");
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            pass: $("#pass").val()
        },
        success: function(result) {
            if (result == 1) {
                $("#account").val("Updating...");
                $("#error_msg_acc").css({ color: 'green' });
                document.getElementById("error_msg_acc").innerHTML = "Account Updated";
                window.setTimeout(function(){ window.location = "index.php"; },1000);

            }
            else {
                $("#account").val("Update");
                $("#error_msg_acc").css({ color: 'red' });
                document.getElementById("error_msg_acc").innerHTML = "Update failed";
                stat = false;
            }
        }
    });
    if (!stat)
        return false;
}