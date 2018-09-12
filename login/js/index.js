$(document).ready(function() {
    if ($("#activated").val() == '1') {
        $("#activated_modal").modal('show');
    }
    // hiding and showing
    $(".crt_form").hide();
    $(".show_hide").show();
    $(".show_hide2").show();
    $(".crt_form").hide();
    $(".email_d").hide();

    $('.show_hide').click(function() {
        $(".crt_form").slideToggle();
        $(".login_form").slideToggle();
    });

    $('.show_hide2').click(function() {
        $(".crt_form").hide();
        $(".login_form").hide();
        $(".email_d").slideToggle();
    });




});

function login_submit() {
    var stat = "";
    $("#submit").val("Loging in...");
    $.ajax({
        type: "POST",
        url: "login/php/login.php",
        data: {
            uname: $("#uname").val(),
            pass: $("#pass").val()
        },
        success: function(result) {
            if (result == 1) {
                window.location.assign("faculty/");
            }
            else if(result == 0) {
                window.location.assign("login/reactivate_account/");
            }
            else {
                $("#submit").val("Login");
                $("#error_msg").css({ color: 'red' });
                document.getElementById("error_msg").innerHTML = result;
                stat = false;
            }
        }
    });
    if (!stat)
        return false;
}

function email_submit() {
    var stat = "";
    $("#send_mail").val("Sending...");
    $.ajax({
        type: "POST",
        url: "login/php/password_reset.php",
        data: {
            email: $("#email").val()
        },
        success: function(result) {
            $("#send_mail").val("Send");

            if(result == 1){
                document.getElementById("error_email").innerHTML = "";
                $("#myModal").modal('show');
                window.setTimeout(function(){ window.location = "index.php"; },3000);
            }
            else{
                $("#error_email").css({ color: 'red' });
                document.getElementById("error_email").innerHTML = "Username not Found";
                stat = false;
            }
        }
    });
    if (!stat)
        return false;
}
