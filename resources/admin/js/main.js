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

    notification("#approvedAll", "#formApprovedAll");
    notification("#categoryDelete", "#formCategoryDelete");
    notification("#userActiveAll", "#formUserActiveAll");
    notification("#postDelete", "#formPostDelete");
});

function notification(id, formId) {
    $(id).click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            confirmButtonText: "Yes!",
        }).then((result) => {
            if (result.isConfirmed) {
                $(formId).submit();
            }
        });
    });
}

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
