$(document).ready(function() {

    var mode = $('#mode').val();
    var pid = $('#pid').val();

    if ($("#state").val() != "0") {
        district();
    }
    if ($("#cat").val() != "0") {
        cat();
    }

//    $("#action_type").unbind('click');
    $(document).on("change", "#cat", function() {
        cat();
    });
    $(document).on("change", "#state", function() {
        district();
    });
    $(document).on("change", "#district", function() {
        taluka();
    });
    $(document).on("change", "#taluka", function() {
        village();
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
                url: site_url + "product/deleteImg",
                data: {id: pid},
                success: function() {
                    $('#image').show();
                    $('#vProfileImg').hide();
                }
            });
        }
    });
    $('#change1').click(function() {
        $('#image1').show();
        $('#vProfileImg1').hide();
        $('#cancel1').show();
        $('#change1').hide();
    });

    $('#cancel1').click(function() {
        $('#image1').hide();
        $('#vProfileImg1').show();
        $('#cancel1').hide();
        $('#change1').show();
    });

    $("#Deleteimg1").click(function() {
        if (confirm('Are you sure you want to delete this ?')) {

            $.ajax({
                type: "POST",
                url: site_url + "product/deleteImg1",
                data: {id: pid},
                success: function() {
                    $('#image1').show();
                    $('#vProfileImg1').hide();
                }
            });
        }
    });
    $('#change2').click(function() {
        $('#image2').show();
        $('#vProfileImg2').hide();
        $('#cancel2').show();
        $('#change2').hide();
    });

    $('#cancel2').click(function() {
        $('#image2').hide();
        $('#vProfileImg2').show();
        $('#cancel2').hide();
        $('#change2').show();
    });

    $("#Deleteimg2").click(function() {
        if (confirm('Are you sure you want to delete this ?')) {

            $.ajax({
                type: "POST",
                url: site_url + "product/deleteImg2",
                data: {id: pid},
                success: function() {
                    $('#image2').show();
                    $('#vProfileImg2').hide();
                }
            });
        }
    });
    $('#change3').click(function() {
        $('#image3').show();
        $('#vProfileImg3').hide();
        $('#cancel3').show();
        $('#change3').hide();
    });

    $('#cancel3').click(function() {
        $('#image3').hide();
        $('#vProfileImg3').show();
        $('#cancel3').hide();
        $('#change3').show();
    });

    $("#Deleteimg3").click(function() {
        if (confirm('Are you sure you want to delete this ?')) {

            $.ajax({
                type: "POST",
                url: site_url + "product/deleteImg3",
                data: {id: pid},
                success: function() {
                    $('#image3').show();
                    $('#vProfileImg3').hide();
                }
            });
        }
    });




    $("#product_form").validate({
        rules: {
            name: "required",
            person: "required",
            price: {
                required: true,
                number: true
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
            },
            cat: {
                min: 1
            }
        },
        messages: {
            name: {
                required: "please enter name"
            },
            person: {
                required: "please enter contact person"
            },
            price: {
                required: "please enter price",
                number: "please enter valid price"
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
            },
            cat: {
                min: "please select category"
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
        url: site_url + 'product/getDistrict',
        data: {id: $("#state").val(), pid: $("#pid").val()},
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
            url: site_url + 'product/getTaluka',
            data: {id: $("#district").val(), pid: $("#pid").val()},
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
            url: site_url + 'product/getVillage',
            data: {id: $("#taluka").val(), pid: $("#pid").val()},
            success: function(data) {
                $('#villagelist').show();
                $('#villagelist').html(data);
            }
        });
    }
}

function cat() {
    $('#subcatlist').hide();

    if ($("#cat").val() != "0" && $("#cat").val() != null) {
        $.ajax({
            type: 'POST',
            url: site_url + 'product/getSubcat',
            data: {id: $("#cat").val(), pid: $("#pid").val()},
            success: function(data) {
                $('#subcatlist').show();
                $('#subcatlist').html(data);
            }
        });
    }
}