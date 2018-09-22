$(document).ready(function() {


fetch_data($('#type').val(),$('#value').val());


$("#reset_pass").click(function(){
    alert("The paragraph was clicked.");
}); 

});





function fetch_data(type,value){
    if(type == "user"){
        $.ajax({
            type: "POST",
            url: "php/functions.php",
            data: {
                user: value
            },
            success: function(result) {
                $("#data_here").append(result);
            }
        });
    }
    else if(type == "subject"){
        $.ajax({
            type: "POST",
            url: "php/functions.php",
            data: {
                subject: value
            },
            success: function(result) {
                $("#data_here").append(result);
            }
        });
    }
} 