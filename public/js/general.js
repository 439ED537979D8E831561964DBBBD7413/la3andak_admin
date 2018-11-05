$(document).ready(function(e) {
    setInterval(function() {
        sessiontimeout();
    }, (1000 * 60001));

    $(document).on('click', '.Delete', function(e) {

        if (!confirm('Are you sure you want to delete?'))
            e.preventDefault();
    });

    $(document).on('click', '.cancelbtn', function(e) {
        history.go(-1);
    });

});

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1);
        if (c.indexOf(name) != -1)
            return c.substring(name.length, c.length);
    }
    return "";
}

function preventcall() {
    window.event.preventDefault();
}

function sessiontimeout() {
    $.ajax({
        type: 'POST',
        url: 'chksession1',
        success: function(data) {
            if (data == 'timeout') {
                $.ajax({
                    type: 'POST',
                    url: rootPath + 'signout',
                    success: function(data) {
                        window.location.replace(window.location.href);
                    }});
            } else if (data == 'admin_timeout') {
                $.ajax({
                    type: 'POST',
                    url: rootPath + 'logout',
                    success: function(data) {
                        window.location.replace(window.location.href);
                    }});
            } else if (data == 'true') {
                //                        alert(1)
            } else {
                //                window.location.href = 'signout';
                window.location.replace('signout');
                //                    alert('timeover')
            }
        }
    });


}
