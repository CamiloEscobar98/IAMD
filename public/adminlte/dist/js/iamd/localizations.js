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
        url: "/api/localizations/countries/"
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
        url: "/api/localizations/countries/" + country_id + "/states"
    }).done(function (res) {
        let states = res;
    
        putStates(states);
    });
}

function getCities(state_id) {

    $.ajax({
        type: 'GET',
        url: "/api/localizations/states/" + state_id + "/cities"
    }).done(function (res) {
        let cities = res;

        putCities(cities);
    });
}


function putCountries(items) {
    let selectCountries = $('#country_id');

    selectCountries.empty();

    items.forEach(item => {
        var id = item['id'];
        var name = item['name'];

        selectCountries.append(`<option value="${id}">${name}</option>`);

    });
}

function putStates(items) {
    let selectStates = $('#state_id');

    selectStates.empty();

    if (items.length > 0) {
        items.forEach(item => {
            var id = item['id'];
            var name = item['name'];

            selectStates.append(`<option value="${id}">${name}</option>`);

        });

        let state_id = items[0]['id'];
        getCities(state_id);
    } else {
        putCities([]);
    }
}

function putCities(items) {
    let selectCities = $('#city_id');

    selectCities.empty();

    if (items.length > 0) {
        items.forEach(item => {
            var id = item['id'];
            var name = item['name'];

            selectCities.append(`<option value="${id}">${name}</option>`);

        });
    }
}