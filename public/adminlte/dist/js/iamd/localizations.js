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
        url: "/api/localizaciones/paises/" + country_id + "/departamentos",
    }).done(function (res) {
        let states = res;
        putStates(states);
    });
}

function getCities(state_id) {
    $.ajax({
        type: "GET",
        url: "/api/localizaciones/departamentos/" + state_id + "/cities",
    }).done(function (res) {
        let cities = res;
        putCities(cities);
    });
}

function putCountries(items) {
    let selectCountries = $("#country_id");
    selectCountries.empty();

    for(const key in items) {
        var id = key;
        var name = items[key];

        selectCountries.append(`<option value="${id}">${name}</option>`);

        if ($("#state_id").val()) {
            let country_id = items[0]["id"];
            getStates(country_id);
        }
    }
}

function putStates(items) {
    let selectStates = $("#state_id");
    selectStates.empty();

    for(const key in items) {
        var id = key;
        var name = items[key];

        selectStates.append(`<option value="${id}">${name}</option>`);
    }

    if ($("#city_id").val()) {
        let state_id = items[0]["id"];
        getCities(state_id);
    }
}

function putCities(items) {
    let selectCities = $("#city_id");
    selectCities.empty();

    for(const key in items) {
        var id = key;
        var name = items[key];

        selectCities.append(`<option value="${id}">${name}</option>`);
    }
}
