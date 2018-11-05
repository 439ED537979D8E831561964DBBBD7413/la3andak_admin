$(document).ready(function () {
    $("#order_form").validate({
        rules: {
            cust_id:"required",
            loc_id:"required",
            pay_id:"required",
            "salutation":{  
                required:true,  
            },  
            "required":{  
                     required:true,  
            }  
            
        },
        messages: {            
            cust_id: "Please select customer.",
            loc_id: "Please select location.",
            pay_id: "Please select payment method.",
            
        },
        submitHandler: function (form) {
        var tbody = $("#vehicles-packages tbody");
        var rows=tbody.children().length;
        if (tbody.children().length == 0) {
            alert("Please add one vehicle with package");
        }else if(rows>0){
            
            for(i=0;i<=rows;i++){
                
                if(($("#vehicles"+i).length == 0) || ($("#packages"+i).length == 0)  ) {
                    //alert("row ="+rows); //continue;
                }
                var vehicles=  $('#vehicles'+i +' option:selected').val();
                var packages=  $('#packages'+i +' option:selected').val();
                if(vehicles=='' || packages==''){
                    alert("Please select vehicle and packages..");
                    return;
                }
            }

            form.submit();
        }
	},
	errorPlacement: function (error, e) {
            e.css('border-color', 'red');
            error.css('font-size', '13px');
            error.css('font-weight', 'normal');
		    //e.parent().before(error);

	    
	},
	highlight: function (e) {
	    $(e).closest('.required').removeClass('has-success has-error').addClass('has-error');
	}     
    });
});
