function changeIntellectualPropertyRightCategory() {
    let selectCategory = $('#intellectual_property_right_category_id').val();

    getIntellectualPropertyRightSubcategories(selectCategory);
}

function changeIntellectualPropertyRightSubcategory() {
    let selectSubcategory = $('#intellectual_property_right_subcategories').val();

    getIntellectualPropertyRightProducts(selectSubcategory);
}

function getIntellectualPropertyRightCategories() {
    $.ajax({
        type: 'GET',
        url: "/api/intellectual_property_rights/categories/"
    }).done(function (res) {
        putIntellectualPropertyRightCategories(res);
        let category = res[0]['id'];
        getIntellectualPropertyRightSubcategories(category);
    });
}

function getIntellectualPropertyRightSubcategories(category) {

    $.ajax({
        type: 'GET',
        url: "/api/intellectual_property_rights/categories/" + category + "/subcategories"
    }).done(function (res) {
        console.log(res['intellectual_property_right_subcategories']);
        putIntellectualPropertyRightSubcategories(res);
        let subcategory = res[0]['id'];
        getIntellectualPropertyRightProducts(subcategory);

    });
}

function getIntellectualPropertyRightProducts(subcategory) {

    $.ajax({
        type: 'GET',
        url: "/api/intellectual_property_rights/subcategories/" + subcategory + "/products"
    }).done(function (res) {
        putIntellectualPropertyRightProducts(res);
    });
}


function putIntellectualPropertyRightCategories(items) {
    let selectCategory = $('#intellectual_property_right_category_id');

    selectCategory.empty();

    items.forEach(category => {
        var id = category['id'];
        var name = category['name'];

        selectCategory.append(`<option value="${id}">${name}</option>`);

    });
}

function putIntellectualPropertyRightSubcategories(items) {
    let selectCategory = $('#intellectual_property_right_subcategory_id');

    selectCategory.empty();

    items.forEach(category => {
        var id = category['id'];
        var name = category['name'];

        selectCategory.append(`<option value="${id}">${name}</option>`);

    });
}

function putIntellectualPropertyRightProducts(items) {
    let selectCategory = $('#intellectual_property_right_product_id');

    selectCategory.empty();

    items.forEach(category => {
        var id = category['id'];
        var name = category['name'];

        selectCategory.append(`<option value="${id}">${name}</option>`);

    });
}