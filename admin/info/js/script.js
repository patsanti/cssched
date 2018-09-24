$(document).ready(function() {


fetch_data($('#id').val());


$("#reset_pass").click(function(){
    reset_pass($('#id').val());
}); 

});





function fetch_data(id){

        $.ajax({
            type: "POST",
            url: "php/functions.php",
            data: {
                user: id
            },
            success: function(result) {
                $("#data_here").append(result);
            }
        });
    

}

function reset_pass(id){
        $.ajax({
            type: "POST",
            url: "php/functions.php",
            data: {
                reset: id
            },
            success: function(result) {
                $("#msg").append('<h3>New Password: <b style="border-style: solid;border-color:green;border-width: 2px;"> password</b></h3>');
            }
        });
} 