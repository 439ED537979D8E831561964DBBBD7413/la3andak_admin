$(document).ready(function() {
//    CKEDITOR.replace('text');

    $("#utype").change(function() {
        $('#selectuser').hide();
        if ($(this).val() != "0") {
            $.ajax({
                type: 'POST',
                url: site_url + 'notification/getUser',
                data: {type: $(this).val()},
                success: function(data) {
                    $('#selectuser').show();
                    $('#selectuser').html(data);
                }
            });
        }
    });

});
