$(document).ready(function () {
    /* Show/Hidden Submenus */
    $('.nav-btn-submenu').on('click', function (e) {
        e.preventDefault();
        var SubMenu = $(this).next('ul');
        var iconBtn = $(this).children('.fa-chevron-down');
        if (SubMenu.hasClass('show-nav-lateral-submenu')) {
            $(this).removeClass('active');
            iconBtn.removeClass('fa-rotate-180');
            SubMenu.removeClass('show-nav-lateral-submenu');
        } else {
            $(this).addClass('active');
            iconBtn.addClass('fa-rotate-180');
            SubMenu.addClass('show-nav-lateral-submenu');
        }
    });

    /* Show/Hidden Nav Lateral */
    $('.show-nav-lateral').on('click', function (e) {
        e.preventDefault();
        var NavLateral = $('.nav-lateral');
        var PageConten = $('.page-content');
        if (NavLateral.hasClass('active')) {
            NavLateral.removeClass('active');
            PageConten.removeClass('active');
        } else {
            NavLateral.addClass('active');
            PageConten.addClass('active');
        }
    });

    /* Exit system button */
    $('.btn-exit-system-cs').on('click', function (e) {
        e.preventDefault();
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: '¿Está seguro de cerrar la sesión?',
                text: 'Está a punto de cerrar la sesión y salir del sistema',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Salir!',
                cancelButtonText: 'No, cancelar',
            }).then((result) => {
                if (result.value) {
                    window.location = '?c=Log_out';
                }
            });
        } else {
            console.error('SweetAlert no está cargado correctamente.');
        }
    });
});

/* Inicialización de mCustomScrollbar */
(function ($) {
    $(window).on('load', function () {
        if ($('.nav-lateral-content').length) {
            $(".nav-lateral-content").mCustomScrollbar({
                theme: "light-thin",
                scrollbarPosition: "inside",
                autoHideScrollbar: true,
                scrollButtons: { enable: true },
            });
        }
        if ($('.page-content').length) {
            $(".page-content").mCustomScrollbar({
                theme: "dark-thin",
                scrollbarPosition: "inside",
                autoHideScrollbar: true,
                scrollButtons: { enable: true },
            });
        }
    });
})(jQuery);

/* Inicialización de popovers */
$(function () {
    if ($.fn.popover) {
        $('[data-toggle="popover"]').popover();
    } else {
        console.warn('Bootstrap Popover no está cargado.');
    }
});
