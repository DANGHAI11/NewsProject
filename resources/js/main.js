$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function () {
    $(".noti-center").delay(4000).fadeOut(350);

    $(".btn-upload-image").click(function () {
        $("#uploadImage").click();
    });

    $("#uploadImage").change(function (e) {
        let file = e.target.files[0];
        let fileType = file.type;
        if (fileType && fileType.indexOf("image") !== -1) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $(".show-image img").attr("src", e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    $("#showMenuProfile").click(function (e) {
        e.preventDefault();
        $(".menu-profile").toggle();
    });

    $(".search-mobile").click(function () {
        searchMobile();
    });

    $(".bar-mobile").click(function () {
        menuMobile();
    });

    $(".background-mobile").click(function () {
        removeMenuMobile();
    });

    $(".delete-post").click(function () {
        $(".popup").css("display", "block");
    });

    $(".popup-cancel").click(function () {
        $(".popup").css("display", "none");
    });

    if ($(window).width() < 576) {
        $(".related-slider").addClass("owl-carousel owl-theme");
        $(".related-slider").owlCarousel({
            items: 1,
            margin: 50,
            nav: true,
        });
    }

    $("#selectCategory").change(function (e) {
        if ($(this).val() == 0) {
            window.location.href = "/";
        } else {
            window.location.href = $(this).val();
        }
    });
});

const menu = $(".header-left");
const background = $(".background-mobile");
const search = $(".header-right");
let prevScrollpos = $(window).scrollTop();

function searchMobile() {
    search.toggleClass("active");
}

function menuMobile() {
    menu.toggleClass("active");
    background.css("display", "block");
}

function removeMenuMobile() {
    menu.removeClass("active");
    background.css("display", "none");
}

$(window).on("scroll", function () {
    let currentScrollPos = $(this).scrollTop();
    if (prevScrollpos < currentScrollPos) {
        $("header .nav").css("top", "-200px");
        search.removeClass("active");
    } else {
        $("header .nav").css("top", "0");
        search.removeClass("active");
    }
    prevScrollpos = currentScrollPos;
});
