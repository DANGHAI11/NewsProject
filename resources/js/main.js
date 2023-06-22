$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function () {
    $(".noti-center").delay(4000).fadeOut(350);

    $(".upload-image").click(function () {
        $("#image-file").click();
    });

    $("#image-file").change(function (e) {
        var file = e.target.files[0];
        var fileType = file.type;
        if (fileType && fileType.indexOf("image") !== -1) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(".show-image img").attr("src", e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    $("#logout").click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "/logout",
            type: "POST",
        }).done(function () {
            window.location.reload();
        });
    });

    $(".login").click(function (e) {
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

    // $(".popup-delete").click(function(){
    //     $.ajax({
    //         url: urlDelete,
    //         type: "DELETE",
    //         data:{
    //             id: idPost
    //         },
    //         success: function() {
    //             console.log("chay duoc");
    //             // window.location.href = urlHome+"/";
    //          }
    //     });
    // })
});

const menu = $(".header-left");
const background = $(".background-mobile");
const search = $(".header-right");
var prevScrollpos = $(window).scrollTop();

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
    var currentScrollPos = $(this).scrollTop();
    if (prevScrollpos < currentScrollPos) {
        $("header .nav").css("top", "-200px");
        search.removeClass("active");
    } else {
        $("header .nav").css("top", "0");
        search.removeClass("active");
    }
    prevScrollpos = currentScrollPos;
});
