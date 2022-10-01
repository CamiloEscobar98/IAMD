function changeIntellectualPropertyRightCategory() {
    let selectCategory = $('#intellectual_property_right_category_id').val();

    getIntellectualPropertyRightSubcategories(selectCategory);
}

function changeIntellectualPropertyRightSubcategory() {
    let selectSubcategory = $('#intellectual_property_right_subcategory_id').val();

    getIntellectualPropertyRightProducts(selectSubcategory);
}

function getIntellectualPropertyRightCategories() {
    $.ajax({
        type: 'GET',
        url: "/api/intellectual_property_rights/categories/"
    }).done(function (res) {

        if (Array.isArray(res)) {
            putIntellectualPropertyRightCategories(res);

            let category = res[0]['id'];

            getIntellectualPropertyRightSubcategories(category);
        }
    });
}

function getIntellectualPropertyRightSubcategories(category) {

    $.ajax({
        type: 'GET',
        url: "/api/intellectual_property_rights/categories/" + category + "/subcategories"
    }).done(function (res) {

        if (Array.isArray(res)) {
            putIntellectualPropertyRightSubcategories(res);

            let subcategory = res[0]['id'];

            getIntellectualPropertyRightProducts(subcategory);
        } else {
            putIntellectualPropertyRightSubcategories([]);
            putIntellectualPropertyRightProducts([]);
        }

    });
}

function getIntellectualPropertyRightProducts(subcategory) {

    $.ajax({
        type: 'GET',
        url: "/api/intellectual_property_rights/subcategories/" + subcategory + "/products"
    }).done(function (res) {
        if (Array.isArray(res)) {
            putIntellectualPropertyRightProducts(res);
        }else{
            putIntellectualPropertyRightProducts([]);
        }
    });
}


function putIntellectualPropertyRightCategories(items) {
    let selectCategory = $('#intellectual_property_right_category_id');

    selectCategory.empty();

    selectCategory.append(`<option value="-1">Seleccionar Categoría</option>`);

    items.forEach(category => {
        var id = category['id'];
        var name = category['name'];

        selectCategory.append(`<option value="${id}">${name}</option>`);

    });
}

function putIntellectualPropertyRightSubcategories(items) {
    let selectSubcategory = $('#intellectual_property_right_subcategory_id');

    selectSubcategory.empty();

    selectSubcategory.append(`<option value="-1">Seleccionar Subcategoría</option>`);

    items.forEach(category => {
        var id = category['id'];
        var name = category['name'];

        selectSubcategory.append(`<option value="${id}">${name}</option>`);

    });
}

function putIntellectualPropertyRightProducts(items) {
    let selectProduct = $('#intellectual_property_right_product_id');

    selectProduct.empty();

    selectProduct.append(`<option value="-1">Seleccionar Producto</option>`);

    items.forEach(category => {
        var id = category['id'];
        var name = category['name'];

        selectProduct.append(`<option value="${id}">${name}</option>`);

    });
}