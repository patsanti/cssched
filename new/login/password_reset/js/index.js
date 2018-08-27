//Display error if password < 8
$('#c_pass').on('blur', function(){
    if(this.value.length < 8){ // checks the password value length
       $(this).focus(); // focuses the current field.
       $("input[type=submit]").attr("disabled", "disabled");
       $("input[type=submit]").css({backgroundColor: 'grey'});
       $("input[type=password]#c_pass").css({border: '1px solid red'});
       $("input[type=password]#c_pass").css({padding: '7px 7px 5px'});
       $("#error_msg").css({color: 'red'});
       document.getElementById("error_msg").innerHTML = "Password Must be Atleast 8 characters long";
    }
    else{
       document.getElementById("error_msg").innerHTML = "";
       $("input[type=submit]").removeAttr("disabled");
       $("input[type=password]#c_pass").css({border: '1px solid #ccd6dd'});
       $("input[type=submit]").css({backgroundColor: '#50a5e6'});
    }
});
// validate form if passwords are not the same
function validateForm() {
    var crt_pass = document.forms["c_Form"]["c_pass"].value;
    var crt_pass2 = document.forms["c_Form"]["n_pass"].value;

    if (crt_pass != crt_pass2) {
        document.getElementById("error_msg").innerHTML = "Password Must be the same!";
        return false;
    }

}

//load user
$(document).ready(function() {
                $.ajax({
                    type: "POST",
                    url: "php/change_pass.php",
                    data: {
                        hidden: $("#hidden").val()
                    },
                    success: function(result) {
                        if(result == "failed"){
                           window.location.assign("../");
                      }
                      else{
                        document.getElementById("hello_user").innerHTML= result;

                      }
                    }
               });

     });