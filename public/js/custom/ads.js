$(document).ready(function() {

   
    $('#change').click(function() {
        $('#image').show();
        $('#vProfileImg').hide();
        $('#cancel').show();
        $('#change').hide();
        $('#hiddenval').val('0');
    });

    $('#cancel').click(function() {
        $('#image').hide();
        $('#vProfileImg').show();
        $('#cancel').hide();
        $('#change').show();
        $('#hiddenval').val('1');
    });

    $("#Deleteimg").click(function() {
        if (confirm('Are you sure you want to delete this ?')) {

            $.ajax({
                type: "POST",
                url: site_url + "ads/deleteImg",
                data: {id: $("#cid").val()},
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


    $("#ads_form").validate({
        rules: {
            title: {
                required: true
            },
            fromdate: {
                required: true
            },
            todate: {
                required: true
            }
            
        },
        messages: {
            title: {
                required: "please enter title",
            },
            fromdate: {
                required: "please enter From date"
            },
            todate: {
                required: "please enter To date"
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
