function changeIsPublished() {
    let select = $("#isPublished").val();
    var container = $("#publishedContainer");
    console.log(select);
    if (select == 1) {
        container.show();
    } else {
        container.hide();
    }
}

function changeHasConfidencialityContract() {
    let select = $("#hasConfidencialityContract").val();
    var container = $("#confidencialityContractContainer");
    console.log(select);
    if (select == 1) {
        container.show();
    } else {
        container.hide();
    }
}