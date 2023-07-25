const buttonComment = ".button-comment";
const commentUpdate = ".comment-update";
const commentUser = ".comment-user";
const formComment = ".form-comment";
const commentList = ".comment-list .user-comment";
const contentComment = "#contentComment";
const commentLoadMore = ".comment-load-more";
const orderComment = ".order-comment";
const iconComment = ".icon-comment";
const commentEdit = ".comment-edit";
const commentPage = ".comment-page";
const editCommentText = "#editCommentText";
const commentMessage = ".comment-message";
const countComment = ".count-comment";
const deleteComment = ".comment-delete";
let page = 1;

if ($(commentMessage).text != "") {
    setInterval(() => {
        $(commentMessage)
            .text("")
            .removeClass("green")
            .removeClass("red")
            .fadeOut(350);
    }, 4000);
}

if ($(window).width() < 576) {
    $(".related-slider").addClass("owl-carousel owl-theme");
    $(".related-slider").owlCarousel({
        items: 1,
        margin: 50,
        nav: true,
    });
}

$(document).on("click", iconComment, function () {
    let index = $(this).index(iconComment);
    $(buttonComment).hide();
    $(commentUpdate).hide();
    $(buttonComment).eq(index).toggle();
    $(commentUser).show();
});

$(document).on("click", commentEdit, function () {
    let index = $(this).index(commentEdit);
    $(buttonComment).hide();
    $(commentUpdate).eq(index).css("display", "flex");
});

$(formComment).submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: e.target.action,
        type: "POST",
        dataType: "json",
        data: $(this).serialize(),
        success: function (response) {
            $(commentList).html(response.htmlComment);
            $(contentComment).val("");
            $(countComment).text(" (" + response.countComment + ")");
            $(commentMessage).show().addClass("green").text(response.message);
        },
        error: function (data) {
            $(commentMessage)
                .show()
                .addClass("red")
                .text(data.responseJSON.message);
        },
    });
});

$(document).on("submit", commentUpdate, function (e) {
    let index = $(this).index(commentUpdate);
    e.preventDefault();
    $.ajax({
        url: e.target.action,
        type: "POST",
        dataType: "json",
        data: $(this).serialize(),
        success: function (response) {
            $(commentUser).eq(index).text(response.content);
            $(commentUpdate).eq(index).hide();
            $(editCommentText).eq(index).val();
            $(buttonComment).eq(index).hide();
            $(commentMessage).show().addClass("green").text(response.message);
        },
        error: function (data) {
            $(commentMessage).show().addClass("red").text(data.responseJSON.message);
        },
    });
});

$(document).on("click", ".comment-delete", function () {
    $(`#commentDelete${$(this).data("id")}`).submit();
});

let lastPageOld = parseInt($(commentLoadMore).data("last-page")) - 1;
let lastPage = lastPageOld;

$(document).on("click", commentLoadMore, function () {
    page++;
    lastPage--;
    if (page == $(this).data("last-page")) {
        $(this).hide();
    }
    $.ajax({
        url: $(this).data("url"),
        type: "get",
        dataType: "json",
        data: {
            order: $(orderComment).val(),
            page: page,
            post_id: $(this).data("post"),
        },
        success: function (response) {
            $(commentList).append(response.html);
            $(commentPage).text(lastPage);
        },
    });
});

$(document).on("change", orderComment, function () {
    page = 1;
    lastPage = lastPageOld;
    $(commentLoadMore).show();
    $.ajax({
        url: $(this).data("url"),
        type: "get",
        dataType: "json",
        data: {
            order: $(this).val(),
            post_id: $(this).data("post"),
        },
        success: function (response) {
            $(commentList).html(response.html);
            $(commentPage).show().text(lastPage);
        },
    });
});
