$(document).ready(function() {
    $("#Deleteimg").click(function() {
        if (confirm('Are you sure you want to delete this ?')) {

            $.ajax({
                type: "POST",
                url: site_url + "subcat/deleteImg",
                data: {id: $("#sid").val()},
                success: function() {
                    $('#image').show();
                    $('#vProfileImg').hide();
                    $('#hiddenval').val('0')
                    $('#cancelbtn4all').trigger('click');
                    $('#confirmbtn4all').html('Confirm');
                    $('#confirmbtn4all').attr('disabled', false);
                }
            });
        }
    });


    $("#subcat_form").validate({
        rules: {
            subcat: {
                required: true
            }
        },
        messages: {
            subcat: {
                required: "please enter sub category",
            }
        },
        submitHandler: function(form) {
            form.submit();
        },
        errorPlacement: function(error, e) {
            error.css('color', 'red');
            error.css('font-size', '13px');
            error.css('font-weight', 'normal');
            if (e.parents().hasClass('custom-select')) {
                e.after(error);
            } else {
                e.after(error);
            }
        },
        highlight: function(e) {
            $(e).closest('.validate').removeClass('has-success has-error').addClass('has-error');
        }
    });


});
