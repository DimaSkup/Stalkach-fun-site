const searchForm = document.getElementById('search-form');
const contentTypeInputs = document.querySelectorAll('[name="content-type"]');

contentTypeInputs.forEach(function (item) {
    item.addEventListener('checked', () => searchForm.submit());
});