$(document).ready(function() {

start();

});

function start(){
	$.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            get_subject: $('#id').val()
        },
        success: function(result) {
        	$("#subject-data").append(result);

        }
    });

}


function update(){
	    var stat = "";
		$.ajax({
        	type: "POST",
        	url: "php/functions.php",
        	data: {
	            update:   $('#id').val(),
	            sub_code: $('#sub_name').val(),
	            sub_des:  $('#sub_des').val(),
	            lec_unit: $('#lec_unit').val(),
	            lab_unit: $('#lab_unit').val(),
	            cre_unit: $('#cre_unit').val()
        	},
	        success: function(result) {
                $("#msg").css({ color: 'green' });
	        	document.getElementById('msg').innerHTML = "Update successfully";
	        }
    	});
     if (!stat)
        return false;

}


function delete_subject(){
	    var stat = "";
		$.ajax({
        	type: "POST",
        	url: "php/functions.php",
        	data: {
	            delete:   $('#id').val()
        	},
	        success: function(result) {
	        	window.location.href = "../index.php#subjects";

	        }
    	});
     if (!stat)
        return false;

}