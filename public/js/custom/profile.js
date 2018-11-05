$(document).ready(function() {

    var mode = $('#mode').val();
    $("#changpassbtndiv").show();
    $("#cancelpassbtn").hide();
    $("#passdiv").hide();


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
                url: site_url + "content/profile_image_delete",
                data: {id: userid},
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


    $.validator.addMethod("passwordRule", function(value, element) {
        return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,20}$/.test(value);
    }, "Password between 6 and 20 characters; must contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character, but cannot contain whitespace.");

    $("#profile_form").validate({
        rules: {
            organization: {
                required: true
//                remote: {
//                    type: "post",
//                    url: site_url + "book/checkBook?id=" + $('#bookid').val() + "&year=" + $('#year').val()
//                }
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
            }
        },
        messages: {
            organization: {
                required: "please enter organization",
//                remote: "Book Title and Published year are already exits"
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
