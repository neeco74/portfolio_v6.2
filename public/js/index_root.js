$(document).ready(function () {

    $('.js-link').hover(function () {
        $(this).css('cursor', 'pointer');
    });

    $('.js-link').click(function () {

        var href = $(this).attr("href");
        if (href) {
            window.location = href;
        }
    });

    $("#div-login").show();
    $('.text-web-project').click(function () {
        $("#div-login").fadeToggle(1000);
        if ($("#div-register, #div-forget").is(':visible')) {
            $("#div-register, #div-forget").fadeOut();
        }
    });
    $('.js-btn-register').click(function () {
        $("#div-login").fadeOut();
        $("#div-register").fadeIn(1000);
    });
    $('.js-btn-retour').click(function () {
        $("#div-register").fadeOut();
        $("#div-login").fadeIn(1000);

    });
    $('.js-btn-forget').click(function () {
        $("#div-login").fadeOut();
        $("#div-forget").fadeIn(1000);
    });
    $('.js-btn-retour-forget').click(function () {
        $("#div-forget").fadeOut();
        $("#div-login").fadeIn(1000);

    });

    /**
     * Fonction qui permet de rediriger si query string register=1
     */
    function goToRegister() {
        var urlParams = new URLSearchParams(window.location.search);

        if(urlParams.has('register')) {
            var register = urlParams.get('register');

            if(register == 1) {
                $("#div-login").hide();
                $("#div-register").show();

            }
        }

    };

    goToRegister();

});