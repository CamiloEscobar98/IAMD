function getAdministrativeUnits() {
    let client = $('#form').data('client');

    $.ajax({
        type: 'GET',
        url: "/api/" + client + "/administrative_units"
    }).done(function (res) {
        if (Array.isArray(res) && res.length > 0) {
            putAdministrativeUnits(res);

            if ($('#research_unit_id')) {
                let administrative_unit_id = res[0]['id'];
                getResearchUnits(administrative_unit_id);
            }
        }
    });
}

function getResearchUnits(administrative_unit_id) {
    let client = $('#form').data('client');

    $.ajax({
        type: 'GET',
        url: "/api/" + client + "/administrative_units/" + administrative_unit_id + '/research_units'
    }).done(function (res) {

        if (Array.isArray(res) && res.length > 0) {
            putResearchUnits(res);

            let research_unit_id = res[0]['id'];

            getProjects(research_unit_id);
        } else {
            putResearchUnits([]);
            putProjects([]);
        }
    });
}

function getProjects(research_unit_id) {
    let client = $('#form').data('client');
    $.ajax({
        type: 'GET',
        url: "/api/" + client + "/research_units/" + research_unit_id + '/projects'
    }).done(function (res) {

        if (Array.isArray(res) && res.length > 0) {
            putProjects(res);
        } else {
            putProjects([]);
        }
    });
}

function changeAdministrativeUnit() {
    let administrative_unit_id = $('#administrative_unit_id').val();

    getResearchUnits(administrative_unit_id);
}

function changeResearchUnit() {
    let research_unit_id = $('#research_unit_id').val();

    if ($('#project_id').length > 0) {
        getProjects(research_unit_id);
    }
}

function putAdministrativeUnits(items) {
    let selectAdministrativeUnit = $('#administrative_unit_id');

    selectAdministrativeUnit.empty();

    items.forEach((item, index) => {
        var id = item['id'];
        var name = item['name'];

        selectAdministrativeUnit.append(`<option value="${id}">${name}</option>`);

    });
}

function putResearchUnits(items) {
    let selectResearchUnit = $('#research_unit_id');

    selectResearchUnit.empty();

    selectResearchUnit.append(`<option value="0">---Seleccionar Unidad Investigativa</option>`);

    let isSelected = '';

    items.forEach((item, index) => {
        var id = item['id'];
        var name = item['name'];

        selectResearchUnit.append(`<option value="${id}" ${isSelected}>${name}</option>`);

    });
}

function putProjects(items) {
    let selectProject = $('#project_id');

    selectProject.empty();

    selectProject.append(`<option value="0">---Seleccionar Proyecto</option>`);

    let isSelected = '';

    items.forEach((item, index) => {
        var id = item['id'];
        var name = item['name'];

        selectProject.append(`<option value="${id}" ${isSelected}>${name}</option>`);

    });
}