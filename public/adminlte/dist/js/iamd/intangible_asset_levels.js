function changeIntangibleAssetLevel1() {
    let category = $('#intellectual_property_right_category_id').val();

    getIntangibleAssetLevel2(category);
}

function changeIntangibleAssetLevel2() {
    let subcategory = $('#intellectual_property_right_subcategories').val();

    getIntangibleAssetLevel3(subcategory);
}

function getIntangibleAssetLevel1() {
    $.ajax({
        type: 'GET',
        url: "/api/intellectual_property_right/categories/"
    }).done(function (res) {
        putIntangibleAssetLevel1(res);
        let category = res[0]['id'];
        getIntangibleAssetLevel2(category);
    });
}

function getIntangibleAssetLevel2(category) {

    $.ajax({
        type: 'GET',
        url: "/api/intellectual_property_right/categories/" + category
    }).done(function (res) {
        console.log(res['intellectual_property_right_subcategories']);
        putIntangibleAssetLevel2(res['intellectual_property_right_subcategories']);
        let subcategory = res['intellectual_property_right_subcategories'][0]['id'];
        getIntangibleAssetLevel3(subcategory);

    });
}

function getIntangibleAssetLevel3(subcategory) {

    $.ajax({
        type: 'GET',
        url: "/api/intellectual_property_right/subcategories/" + subcategory
    }).done(function (res) {
        putIntangibleAssetLevel3(res['intellectual_property_right_products']);
    });
}


function putIntangibleAssetLevel1(items) {
    let selectCategory = $('#intellectual_property_right_category_id');

    selectCategory.empty();

    items.forEach(category => {
        var id = category['id'];
        var name = category['name'];

        selectCategory.append(`<option value="${id}">${name}</option>`);

    });
}

function putIntangibleAssetLevel2(items) {
    let selectCategory = $('#intellectual_property_right_subcategory_id');

    selectCategory.empty();

    items.forEach(category => {
        var id = category['id'];
        var name = category['name'];

        selectCategory.append(`<option value="${id}">${name}</option>`);

    });
}

function putIntangibleAssetLevel3(items) {
    let selectCategory = $('#intellectual_property_right_product_id');

    selectCategory.empty();

    items.forEach(category => {
        var id = category['id'];
        var name = category['name'];

        selectCategory.append(`<option value="${id}">${name}</option>`);

    });
}