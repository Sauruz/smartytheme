var heightNavbar = $('.navbar').outerHeight();
$(window).scroll(function () {
    if ($(window).scrollTop() > heightNavbar) {
        $('.navbar').removeClass('navbar-inverse').addClass('navbar-default');
    }
    else {
       $('.navbar').removeClass('navbar-default').addClass('navbar-inverse');
    }
});