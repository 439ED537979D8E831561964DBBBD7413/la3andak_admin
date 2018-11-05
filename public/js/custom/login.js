$(document).ready(function () {
    $("#login_form").validate({
        rules: {
            email:{
                required:true,
                email:true
            },
            password: "required"
        },
        messages: {
            email:{
                required:"please enter email",
                email:"please enter valid email"
            },
            password: "please enter password"
        },
        submitHandler: function (form) {
	    form.submit();
	},
	errorPlacement: function (error, e) {
            error.css('color', 'red');
            error.css('font-size', '13px');
            error.css('font-weight', 'normal');
	    
		e.parent().before(error);
	    
	},
	highlight: function (e) {
	    $(e).closest('.validate').removeClass('has-success has-error').addClass('has-error');
	}     
    });
});
