function getAdministrativeUnits() {
    let client = $('#form').data('client');
    $.ajax({
        type: 'GET',
        url: "/api/" + client + "/administrative_units"
    }).done(function (res) {
        putAdministrativeUnits(res);
        let administrative_unit_id = res[0]['id'];
        getResearchUnits(administrative_unit_id);
    });
}

function getResearchUnits(administrative_unit_id) {
    let client = $('#form').data('client');
    $.ajax({
        type: 'GET',
        url: "/api/" + client + "/administrative_units/" + administrative_unit_id
    }).done(function (res) {
        putResearchUnits(res['research_units']);
        let research_unit_id = res['research_units'][0]['id'];
        getProjects(research_unit_id);

    });
}

function getProjects(research_unit_id) {
    let client = $('#form').data('client');
    $.ajax({
        type: 'GET',
        url: "/api/" + client + "/research_units/" + research_unit_id
    }).done(function (res) {
        putProjects(res['projects']);
    });
}

function changeAdministrativeUnit() {
    let administrative_unit_id = $('#administrative_unit_id').val();

    getResearchUnits(administrative_unit_id);
}

function changeResearchUnit() {
    let research_unit_id = $('#research_unit_id').val();

    getProjects(research_unit_id);
}

function putAdministrativeUnits(items) {
    let selectAdministrativeUnit = $('#administrative_unit_id');

    selectAdministrativeUnit.empty();

    items.forEach(item => {
        var id = item['id'];
        var name = item['name'];

        selectAdministrativeUnit.append(`<option value="${id}">${name}</option>`);

    });
}

function putResearchUnits(items) {
    let selectResearchUnit = $('#research_unit_id');

    selectResearchUnit.empty();

    items.forEach(item => {
        var id = item['id'];
        var name = item['name'];

        selectResearchUnit.append(`<option value="${id}">${name}</option>`);

    });
}

function putProjects(items) {
    let selectProject = $('#project_id');

    selectProject.empty();

    items.forEach(item => {
        var id = item['id'];
        var name = item['name'];

        selectProject.append(`<option value="${id}">${name}</option>`);

    });
}