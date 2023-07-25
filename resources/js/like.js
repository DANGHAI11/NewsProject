const releaseHeart = $(".release-heart");
const releaseHeartTotal = $(".release-heart span");
const releaseHeartStatus = $(".release-heart i");

releaseHeart.click(function () {
    let urlLike = $(this).data("url");
    if (urlLike) {
        $.ajax({
            url: urlLike,
            type: "POST",
            dataType: "json",
            success: function (response) {
                releaseHeartTotal.text(response.totalLike);
                response.statusLike ? releaseHeartStatus.addClass("active") : releaseHeartStatus.removeClass("active");
            },
        });
    }
});
