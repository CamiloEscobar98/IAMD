function changeCountry() {
    let country_id = $("#country_id").val();
    getStates(country_id);
}

function changeState() {
    let state_id = $("#state_id").val();
    getCities(state_id);
}

function getCountries() {
    $.ajax({
        type: "GET",
        url: "/api/localizaciones/paises/",
    }).done(function (res) {
        let countries = res;
        putCountries(countries);

        let country_id = res[0]["id"];
        getStates(country_id);
    });
}

function getStates(country_id) {
    $.ajax({
        type: "GET",
        url: `/api/localizaciones/departamentos/?country_id=${country_id}`,
    }).done(function (res) {
        let states = res;
        putStates(states);
    });
}

function getCities(state_id) {
    $.ajax({
        type: "GET",
        url: `/api/localizaciones/ciudades/?state_id=${state_id}`,
    }).done(function (res) {
        let cities = res;
        putCities(cities);
    });
}

function putCountries(items) {
    let selectCountries = $("#country_id");
    selectCountries.empty();

    let firstCountryId = null;
    for (const key in items) {
        var id = key;
        var name = items[key];

        if (firstCountryId == null) {
            firstCountryId = id;
        }

        selectCountries.append(`<option value="${id}">${name}</option>`);
    }
    if ($("#state_id").val() && firstCountryId) {
        getStates(firstCountryId);
    }
}

function putStates(items) {
    let selectStates = $("#state_id");
    selectStates.empty();

    let firstStateId = null;
    for (const key in items) {
        var id = key;
        var name = items[key];

        if (firstStateId == null) {
            firstStateId = id;
        }

        selectStates.append(`<option value="${id}">${name}</option>`);
    }

    if ($("#city_id").val() && firstStateId) {
        getCities(firstStateId);
    }
}

function putCities(items) {
    let selectCities = $("#city_id");
    selectCities.empty();

    for (const key in items) {
        var id = key;
        var name = items[key];

        selectCities.append(`<option value="${id}">${name}</option>`);
    }
}
