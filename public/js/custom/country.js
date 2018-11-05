$(document).ready(function() {

    $("#country_form").validate({
        rules: {
            name: {
                required: true

            }
        },
        messages: {
            name: {
                required: "please enter country name",
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
