function changeCountry() {
    let country_id = $('#country_id').val();

    getStates(country_id);
}

function changeState() {
    let state_id = $('#state_id').val();

    getCities(state_id);
}

function getCountries() {
    $.ajax({
        type: 'GET',
        url: "/api/countries/"
    }).done(function (res) {
        let countries = res;
        putCountries(countries);

        let country_id = res[0]['id'];
        getStates(country_id);
    });
}

function getStates(country_id) {

    $.ajax({
        type: 'GET',
        url: "/api/countries/" + country_id
    }).done(function (res) {
        let states = res['states'];
        putStates(states);

        let first_state_id = states[0]['id'];
        getCities(first_state_id);

    });
}

function getCities(state_id) {

    $.ajax({
        type: 'GET',
        url: "/api/states/" + state_id
    }).done(function (res) {
        let cities = res['cities'];
        putCities(cities);
    });
}


function putCountries(items) {
    let selectLevel1 = $('#country_id');

    selectLevel1.empty();

    items.forEach(item => {
        var id = item['id'];
        var name = item['name'];

        selectLevel1.append(`<option value="${id}">${name}</option>`);

    });
}

function putStates(items) {
    let selectLevel1 = $('#intangible_asset_type_level_2');

    selectLevel1.empty();

    items.forEach(item => {
        var id = item['id'];
        var name = item['name'];

        selectLevel1.append(`<option value="${id}">${name}</option>`);

    });
}

function putCities(items) {
    let selectLevel1 = $('#intangible_asset_type_level_3');

    selectLevel1.empty();

    items.forEach(item => {
        var id = item['id'];
        var name = item['name'];

        selectLevel1.append(`<option value="${id}">${name}</option>`);

    });
}