const iconComment = $(".icon-comment");
const buttonComment = $(".button-comment");
const commentEdit = $(".comment-edit");
const commentUpdate = $(".comment-update");
const commentUser = $(".comment-user");

console.log(commentUser);

iconComment.click(function () {
    let index = iconComment.index(this);
    buttonComment.hide();
    commentUpdate.hide();
    buttonComment.eq(index).toggle();
    commentUser.show();
});
commentEdit.click(function () {
    let index = commentEdit.index(this);
    buttonComment.hide();
    commentUpdate.eq(index).toggle();
});
