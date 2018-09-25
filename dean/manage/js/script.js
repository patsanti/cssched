$(document).ready(function() {

  start();

});

function start(){
  	$.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            fetch_all: 1,
            id: $('#id').val(),
            type_data: $('#type').val()
        },
        success: function(result) {
        	$("#all-data").append(result);

        }
    });
  }



function update(){
    var stat = "";
    if($('#type').val() == "prof"){
      $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            update:   $('#id').val(),
            type_update: "prof",
            fname: $('#fname').val(),
            mname: $('#mname').val(),
            lname: $('#lname').val(),
        },
        success: function(result) {
          $("#msg").css({ color: 'green' });
          document.getElementById('msg').innerHTML = "Update successfully";
        }
      });

    }

  else if($('#type').val() == "class"){
      $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            update:   $('#id').val(),
            type_update: "class",
            class_name: $('#class_name').val()
        },
        success: function(result) {
          $("#msg").css({ color: 'green' });
          document.getElementById('msg').innerHTML = "Update successfully";
        }
      });

    }
    else if($('#type').val() == "room"){
      $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            update:   $('#id').val(),
            type_update: "room",
            room_name: $('#room_name').val()
        },
        success: function(result) {
          $("#msg").css({ color: 'green' });
          document.getElementById('msg').innerHTML = "Update successfully";
        }
      });

    }

   if (!stat)
      return false;
}



var modalConfirm = function(callback){
  
  $("#btn-confirm").on("click", function(){
    $("#mi-modal").modal('show');
  });

  $("#modal-btn-si").on("click", function(){
    callback(true);
    $("#mi-modal").modal('hide');
  });
  
  $("#modal-btn-no").on("click", function(){
    callback(false);
    $("#mi-modal").modal('hide');
  });
};

modalConfirm(function(confirm){
  if(confirm){
   var stat = "";
        $.ajax({
            type: "POST",
            url: "php/functions.php",
            data: {
                delete:   $('#id').val(),
                type_delete: $('#type').val()
            },
            success: function(result) {
                window.location.href = "../index.php";

            }
        });
     if (!stat)
        return false;
  }
});