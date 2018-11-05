$(document).ready(function () {
    $("#driver_form").validate({
        rules: {            
            "salutation":{  
                required:true,  
            },  
            "required":{  
                     required:true,  
            }  
            
        },
        messages: {            
            
        },
        submitHandler: function (form) {
            //form.submit();
        
	},
	errorPlacement: function (error, e) {
            error.css('color', 'red');
            error.css('font-size', '13px');
            error.css('font-weight', 'normal');
		    e.parent().before(error);

	    
	},
	highlight: function (e) {
	    $(e).closest('.required').removeClass('has-success has-error').addClass('has-error');
	}     
    });
});
