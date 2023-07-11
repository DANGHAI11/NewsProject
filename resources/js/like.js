const releaseHeart = $(".relase-heart");
const releaseHeartTotal = $(".relase-heart span");
const releaseHeartStatus = $(".relase-heart i");

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
