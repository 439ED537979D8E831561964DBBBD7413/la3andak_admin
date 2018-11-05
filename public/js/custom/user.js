$(document).ready(function() {

    var mode = $('#mode').val();
    $("#changpassbtndiv").hide();
    $("#cancelpassbtn").hide();
    $("#passdiv").hide();

//$('.datepicker').datepicker({
//	format: 'mm/dd/yyyy'
//    });
//    $('.datepicker').datepicker({
//        format: 'dd/mm/yyyy'
//    });

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

    if ($("#state").val() != "0") {
        district();
    }

//    $("#action_type").unbind('click');
    $(document).on("change", "#state", function() {
        district();
    });
    $(document).on("change", "#district", function() {
        taluka();
    });
    $(document).on("change", "#taluka", function() {
        village();
    });




    $.validator.addMethod("passwordRule", function(value, element) {
        return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,20}$/.test(value);
    }, "Password between 6 and 20 characters; must contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character, but cannot contain whitespace.");

    $("#user_form").validate({
        rules: {
            name: "required",
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
            },
            pin: {
                required: true,
                number: true
            },
            state: {
                min: 1
            }
        },
        messages: {
            name: {
                required: "please enter name"
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
                number: "please enter valid number",
                maxlength: "please enter 10 digits"
            },
            pin: {
                required: "please enter pincode",
                number: "please enter valid pincode"
            },
            state: {
                min: "please select state"
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

function district() {
    $('#districtlist').hide();
    $.ajax({
        type: 'POST',
        url: site_url + 'user/getDistrict',
        data: {id: $("#state").val(), uid: $("#uid").val()},
        success: function(data) {
            $('#districtlist').show();
            $('#districtlist').html(data);
            taluka();
        }
    });
}
function taluka() {
    $('#talukalist').hide();
    if ($("#district").val() != "0" && $("#district").val() != null) {
        $.ajax({
            type: 'POST',
            url: site_url + 'user/getTaluka',
            data: {id: $("#district").val(), uid: $("#uid").val()},
            success: function(data) {
                $('#talukalist').show();
                $('#talukalist').html(data);
                village();
            }
        });
    }
}
function village() {
    $('#villagelist').hide();

    if ($("#taluka").val() != "0" && $("#taluka").val() != null) {
        $.ajax({
            type: 'POST',
            url: site_url + 'user/getVillage',
            data: {id: $("#taluka").val(), uid: $("#uid").val()},
            success: function(data) {
                $('#villagelist').show();
                $('#villagelist').html(data);
            }
        });
    }
}