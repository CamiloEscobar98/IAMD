function changeIsPublished() {
    let selectIsPublished = $("#isPublished").val();
    var publishedContainer = $("#publishedContainer");
    console.log(selectIsPublished);
    if (selectIsPublished == 1) {
        publishedContainer.show();
    } else {
        publishedContainer.hide();
    }
}