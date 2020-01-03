class Main {
    constructor() {

    }

    showMenu(isNeed) {
        if (isNeed) {
            $('header .head ul.options').show(250);

        } else {
            $('header .head ul.options').hide(250);
        }
        $('.back-hide').toggleClass('active');
    }
}

$(document).ready(function () {
    var mainObj = new Main();

    if (typeof (flatpickr) != "undefined" && flatpickr !== null) {
        $('.form #date').flatpickr({
            enableTime: true,
            "locale": 'ru'
        });
    }


    $('header .head .mobile-burger').off('click').click(function () {
        mainObj.showMenu(true);
    });
    $('header .head .hide-menu').off('click').click(function () {
        mainObj.showMenu(false);
    });
    $('#contacts-button').off('click').click(function (e) {
        $([document.documentElement, document.body]).animate({
            scrollTop: $('footer').offset().top
        }, 850);
        if (window.screen.width <= 1024) {
            mainObj.showMenu(false);
        }
    });
});