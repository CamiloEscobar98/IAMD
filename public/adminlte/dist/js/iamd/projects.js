function changeResearchUnits() {
    getResearchUnits();
}

function getResearchUnits() {
    let projectId = $("#project_id").val();
    let administrativeUnitId = $("#administrative_unit_id").val();
    console.log(administrativeUnitId);
    let client = $("#form").data("client");

    $.ajax({
        type: "GET",
        url: "/api/" + client + "/unidades-investigativas/",
        data: `project_id=${projectId}&administrative_unit_id=${administrativeUnitId}`,
    }).done(function (res) {
        console.log(res);
        if (Array.isArray(res) && res.length > 0) {
            putResearchUnits(res);
        } else {
            putResearchUnits([]);
        }
    });
}

function putResearchUnits(items) {
    let selectResearchUnit = $("#research_unit_id");

    selectResearchUnit.empty();

    selectResearchUnit.append(
        `<option value="">---Seleccionar Unidad Investigativa</option>`
    );

    let isSelected = "";

    items.forEach((item, index) => {
        var id = item["id"];
        var name = item["name"];

        selectResearchUnit.append(
            `<option value="${id}" ${isSelected}>${name}</option>`
        );
    });
}
