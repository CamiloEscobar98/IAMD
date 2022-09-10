function changeIntangibleAssetLevel1() {
    let level_1 = $('#intangible_asset_type_level_1').val();

    getIntangibleAssetLevel2(level_1);
}

function changeIntangibleAssetLevel2() {
    let level_2 = $('#intangible_asset_type_level_2').val();

    getIntangibleAssetLevel3(level_2);
}

function getIntangibleAssetLevel1() {
    $.ajax({
        type: 'GET',
        url: "/api/intangible_asset_level_1/"
    }).done(function (res) {
        putIntangibleAssetLevel1(res);
        let level_1 = res[0]['id'];
        getIntangibleAssetLevel2(level_1);
    });
}

function getIntangibleAssetLevel2(level_1) {

    $.ajax({
        type: 'GET',
        url: "/api/intangible_asset_level_1/" + level_1
    }).done(function (res) {
        putIntangibleAssetLevel2(res['intangible_asset_type_level_2']);
        let level_2 = res['intangible_asset_type_level_2'][0]['id'];
        getIntangibleAssetLevel3(level_2);

    });
}

function getIntangibleAssetLevel3(level_2) {

    $.ajax({
        type: 'GET',
        url: "/api/intangible_asset_level_2/" + level_2
    }).done(function (res) {
        putIntangibleAssetLevel3(res['intangible_asset_type_level_3']);
    });
}


function putIntangibleAssetLevel1(items) {
    let selectLevel1 = $('#intangible_asset_type_level_1');

    selectLevel1.empty();

    items.forEach(category => {
        var id = category['id'];
        var name = category['name'];

        selectLevel1.append(`<option value="${id}">${name}</option>`);

    });
}

function putIntangibleAssetLevel2(items) {
    let selectLevel1 = $('#intangible_asset_type_level_2');

    selectLevel1.empty();

    items.forEach(category => {
        var id = category['id'];
        var name = category['name'];

        selectLevel1.append(`<option value="${id}">${name}</option>`);

    });
}

function putIntangibleAssetLevel3(items) {
    let selectLevel1 = $('#intangible_asset_type_level_3');

    selectLevel1.empty();

    items.forEach(category => {
        var id = category['id'];
        var name = category['name'];

        selectLevel1.append(`<option value="${id}">${name}</option>`);

    });
}