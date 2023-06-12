$(document).ready(function () {
    $(".noti-center").delay(4000).fadeOut(350);

    $(".view-delete-user").click(function () {
        ajaxResponse($(this).data("url"), "delete");
    });

    $(".view-profile-user").click(function () {
        ajaxResponse($(this).data("url"), "profile");
    });

    $("#popupProfile").on("click", ".close, .popup-cancel", function () {
        $("#popupProfile").html("");
    });
})

function ajaxResponse(url, checkResponse) {
    $.ajax({
        url: url,
        type: "get",
        dataType: "json",
        success: function (response) {
            if (checkResponse == "delete") {
                $("#popupProfile").html(response.htmlDelete);
            }
            if (checkResponse == "profile") {
                $("#popupProfile").html(response.htmlProfile);
            }
        },
    });
}
