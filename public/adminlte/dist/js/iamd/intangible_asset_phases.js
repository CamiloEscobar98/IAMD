function changeIsPublished() {
    let select = $("#isPublished").val();
    var container = $("#publishedContainer");

    if (select == 1) {
        container.show();
    } else {
        container.hide();
    }
}

function changeHasConfidencialityContract() {
    let select = $("#hasConfidencialityContract").val();
    var container = $("#confidencialityContractContainer");

    if (select == 1) {
        container.show();
    } else {
        container.hide();
    }
}

function changeHasSessionRightContract() {
    let select = $("#hasSessionRightContract").val();
    var container = $("#sessionRightContractContainer");

    if (select == 1) {
        container.show();
    } else {
        container.hide();
    }
}

function changeHasAcademicRecord() {
    let select = $("#hasAcademicRecord").val();
    var container = $("#academicRecordContainer");

    if (select == 1) {
        container.show();
    } else {
        container.hide();
    }
}

function changeHasContability() {
    let select = $("#hasContability").val();
    var container = $("#commercialContainer");

    if (select == 1) {
        container.show();
    } else {
        container.hide();
    }
}

function changeHasDeposite() {
    let select = $("#hasDeposite").val();
    var container = $("#hasDepositeContainer");
    if (select == 1) {
        container.show();
    } else {
        container.hide();
    }
}

function changeHasSecretProtection() {
    let select = $("#hasSecretProtection").val();
    var container = $("#hasSecretProtectionContainer");

    if (select == 1) {
        container.show();
    } else {
        container.hide();
    }
}

function changeHasPriorityTools() {
    let select = $("#hasPriorityTools").val();
    var container = $("#hasPriorityToolsContainer");

    console.log(select);

    if (select == 1) {
        container.show();
    } else {
        container.hide();
    }
}

function changeIsCommercial() {
    let select = $("#isCommercial").val();
    var container = $("#isCommercialContainer");

    if (select == 1) {
        container.show();
    } else {
        container.hide();
    }
}
