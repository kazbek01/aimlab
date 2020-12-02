$(document).ready(function () {
    $('.call-menu').click(function(){
        $('.nav-box').addClass('showed');
    });
    $('.close-menu').click(function(){
        $('.nav-box').removeClass('showed');
    });

    $('.show-more').click(function (e) {
        e.preventDefault();
        $('.modal-plain').addClass('modal-show');
        $('.overlay').addClass('overlay-showed');
        $('body').addClass('scroll-locked');
    });

    $('.close-modal').click(function () {
        $('.modal-plain').removeClass('modal-show');
        $('.overlay').removeClass('overlay-showed');
        $('body').removeClass('scroll-locked');
    })

    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');


        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });


        return false;
    });
});







