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


    // checking if username is available
    $("#crt_uname").blur(
        function(event) {
            if ($("#crt_uname").val() == "") {
                $("#uname_error").css({ color: 'red' });
                document.getElementById("uname_error").innerHTML = "Please Enter your desired Username";
            }
            else {
                $.ajax({
                    type: "POST",
                    url: "php/login.php",
                    data: {
                        uname: $("#crt_uname").val()
                    },
                    success: function(result) {
                        if (result == "Username's Available") {
                            document.getElementById("uname_error").innerHTML = result;
                            $("#uname_error").css({ color: 'green' });
                            $("input[type=submit]#crt_acc").removeAttr("disabled");
                            $("input[type=submit]#crt_acc").css({ backgroundColor: '#50a5e6' });
                        }
                        else {
                            document.getElementById("uname_error").innerHTML = result;
                            $("input[type=submit]#crt_acc").attr("disabled", "disabled");
                            $("#uname_error").css({ color: 'red' });
                            $("input[type=submit]#crt_acc").css({ backgroundColor: 'grey' });
                            //$("input[type=button]#crt_acc").removeClass('input[type=button]:hover');
                        }
                    }
                });
            }
        }
    );
});

function login_submit() {
    var stat = "";
    $("#submit").val("Loging in...");
    $.ajax({
        type: "POST",
        url: "php/login.php",
        data: {
            uname: $("#uname").val(),
            pass: $("#pass").val()
        },
        success: function(result) {
            if (result == "sucess") {
                window.location.assign(document.getElementById('redir_link').value);
            }
            else if (result == "deactivated account") {
                window.location.assign("reactivate_account/");
            }
            else if (result == "banned account") {
                window.location.assign("banned_account/");
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
        url: "php/password_reset.php",
        data: {
            email: $("#email").val()
        },
        success: function(result) {
            $("#send_mail").val("Send");

            if (result == "failed") {
                $("#error_email").css({ color: 'red' });
                document.getElementById("error_email").innerHTML = "Email not Found";
                stat = false;
            }
            else {
                document.getElementById("error_email").innerHTML = "";
                $("#myModal").modal('show');
            }
        }
    });
    if (!stat)
        return false;
}

function crt_submit() {
    var stat = "";
    $("#crt_acc").val("Creating Account...");
    if (($("#crt_uname").val() == "" && $("#crt_pass").val() == "") || ($("#crt_uname").val() == "" || $("#crt_pass").val() == "")) {
        $("#crt_acc").val("Create Account");
        $("#uname_error").css({ color: 'red' });
        document.getElementById("uname_error").innerHTML = "Please Fill up the form";
        stat = false;
    }
    else if ($("#crt_pass").val().length < 8) {
        $("#crt_acc").val("Create Account");
        $("#uname_error").css({ color: 'red' });
        document.getElementById("uname_error").innerHTML = "Password Must be atleast 8 characters";
        stat = false;
    }
    else {
        $.ajax({
            type: "POST",
            url: "php/login.php",
            data: {
                crt_uname: $("#crt_uname").val(),
                crt_pass: $("#crt_pass").val()
            },
            success: function(result) {
                // window.location.assign("http://localhost/augeo/home/account/?new=1");
                window.location.assign("http://localhost/cssched/login");
            }
        });
    }

    if (!stat)
        return false;
}