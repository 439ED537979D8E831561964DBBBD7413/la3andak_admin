$(document).ready(function() {

    var mode = $('#mode').val();
    $("#changpassbtndiv").hide();
    $("#cancelpassbtn").hide();
    $("#passdiv").hide();

    if (mode == 'edit') {
        $("#changpassbtndiv").show();
        $("#passdiv").hide();
    } else {
        $("#changpassbtndiv").hide();
        $("#passdiv").show();
    }

    $('#changpassbtn').click(function() {
        $("#cancelpassbtn").toggle();
        $("#changpassbtn").toggle();
        $("#passdiv").toggle();
        $("#chnagepassval").val("1");
    });
    $('#cancelpassbtn').click(function() {
        $("#cancelpassbtn").toggle();
        $("#changpassbtn").toggle();
        $("#passdiv").toggle();
        $("#password").val('');
        $("#pass").val('');
        $("#  ").val("0");
    });

    $.validator.addMethod("passwordRule", function(value, element) {
        return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,20}$/.test(value);
    }, "Password between 6 and 20 characters; must contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character, but cannot contain whitespace.");


    $("#buyer_form").validate({
        rules: {
            organization: {
                required: true
//                remote: {
//                    type: "post",
//                    url: site_url + "book/checkBook?id=" + $('#bookid').val() + "&year=" + $('#year').val()
//                }
            },
            contctpers: "required",
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6,
                passwordRule: true
            },
            pass: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            },
            mobile: {
                required: true,
                number: true,
                maxlength: 10
            }
        },
        messages: {
            organization: {
                required: "please enter organization",
//                remote: "Book Title and Published year are already exits"
            },
            contctpers: "please enter contact person",
            email: {
                required: "please enter email",
                email: "please enter valid email"
            },
            password: {
                required: "please enter password",
                minlength: "please enter atleast 6 digits password"
            },
            pass: {
                required: "please enter password",
                minlength: "please enter atleast 6 digits password"
            },
            mobile: {
                required: "please enter mobile",
                number: "please enter valid number"
//                maxlength:10
            }
        },
        submitHandler: function(form) {
            checkPeriod();
            
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


function checkPeriod(){
    var val=$("#checkp").val();
    if(val==''){
        if($("#trial").is(':checked') || $("#trial").is(':checked')){
            form.submit();  
        } else{
            alert("Please select Period");
        }
    return false;
    }else{
      form.submit();  
    }
//    
}