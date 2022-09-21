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

function changeHasSessionRightContract() {
    let select = $("#hasSessionRightContract").val();
    var container = $("#sessionRightContractContainer");
    console.log(select);
    if (select == 1) {
        container.show();
    } else {
        container.hide();
    }
}

function changeHasContability() {
    let select = $("#hasContability").val();
    var container = $("#commercialContainer");
    console.log(select);
    if (select == 1) {
        container.show();
    } else {
        container.hide();
    }
}

function changeHasDeposite() {
    let select = $("#hasDeposite").val();
    var container = $("#hasDepositeContainer");
    console.log(select);
    if (select == 1) {
        container.show();
    } else {
        container.hide();
    }
}
