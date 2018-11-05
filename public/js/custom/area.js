$(document).ready(function() {

    $("#area_form").validate({
        rules: {
            name: {
                required: true

            },
            pcode:{
                required: true,
                number:true,
                maxlength:6
            }
        },
        messages: {
            name: {
                required: "please enter name",
            },
            pcode:{
                required: "please enter postal code",
                number:"please enter valid postal code",
                maxlength:"please enter 6 digit number"
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
