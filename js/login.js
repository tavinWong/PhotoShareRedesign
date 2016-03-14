$(document).ready(function () {
    $('#Login-button').click(function () {
		$("#login_window").css("display", "block");
		$("#mask").fadeIn(300);

        return false;
    });

    // When clicking on the button close or the mask layer the popup closed
    $('body').on('click', ' #mask', function () {
        $('#mask, #login_window, #register_window').fadeOut(300, function () {
            //alert(document.getElementById("login_window").style.display);
            //$('#mask').css("display", "none");
        });
        return false;
    });
});