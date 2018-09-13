var schedule_table = null;

window.addEventListener('load', function() {
    $.ajax({
        url: '../global/php/get_schedules.php',
        data: {
            year: 2018,
            orderBy: 'professor'
        },
        dataType: 'json',
        error: function(jqXHR, textStatus, errorThrown) {
            //for debugging only
            console.error(jqXHR, textStatus, errorThrown);
        },
        success: function(result) {
            handle_retrieved_info(result);
        }
    });
});