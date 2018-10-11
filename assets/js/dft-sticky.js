/**
 * Sticky menu
 */
var classeMenu = ".header-principal";

if (window.screen.width > 1000) {
    stickyDesktop();
    $(document).scroll(stickyDesktop);
}

function stickyDesktop() {
    var windowHeight = $(document).scrollTop();
    var minWidth = 0;

    if (window.screen.width < 1400) {
        minWidth = 100;
    } else {
        minWidth = 180;
    }

    if (windowHeight >= minWidth) {
        $(classeMenu).addClass("sticky");
    } else {
        $(classeMenu).removeClass("sticky");
    }
}