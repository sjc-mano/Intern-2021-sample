"use strict";
$(function () {

    const triangle1 = $(".triangle1");
    const triangle2 = $(".triangle2");
    const header_username = $("#js-headeruserName");
    const logout = $(".header__sp__logout__second__li__link");

    // Enterでsubmitされないようにする
    $(document).on("keypress", "input", function (ev) {
        if ((ev.which && ev.which === 13) ||
            (ev.keyCode && ev.keyCode === 13)) {
            return false;
        } else {
            return true;
        }
    });

    triangle1.on("click", () => {
        logout.css('display', 'block');
        triangle1.hide();
        triangle2.show();
    });

    triangle2.on("click", () => {
        logout.hide();
        triangle1.show();
        triangle2.hide();
    });

    window.onload = () => {
        document.getElementsByTagName("body")[0].classList.remove("preload");
    }

    header_username.on("click", () => {
        if (logout.css('display') == 'none') {
            logout.css('display', 'block');
            triangle1.hide();
            triangle2.show();
        }
        else {
            logout.hide();
            triangle1.show();
            triangle2.hide();
        }
    });

});
