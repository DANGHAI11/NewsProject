const relaseHeart = $(".relase-heart");
const relaseHeartTotal = $(".relase-heart span");
const relaseHeartStatus = $(".relase-heart i");

relaseHeart.click(function () {
    $.ajax({
        url: $(this).data("url"),
        type: "POST",
        dataType: "json",
        success: function (response) {
            relaseHeartTotal.text(response.totalLike);
            if (response.statusLike) {
                relaseHeartStatus.addClass("active");
            } else {
                relaseHeartStatus.removeClass("active");
            }
        },
    });
});
