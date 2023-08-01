const deleteBtns = document.querySelectorAll(".delete-btn");
const deleteForms = document.querySelectorAll("#delete");
const paginationItems = document.querySelectorAll(".page-item");

const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});
const page = params.page;

if (paginationItems.length > 0) {
    if (page === null) {
        paginationItems[0].classList.add('active')
    } else {
        paginationItems[page - 1].classList.add('active')
    }
}

deleteBtns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.preventDefault();
        const conf = window.confirm("Remove user?");
        deleteForms.forEach((form) => {
            if (form.dataset.id === e.target.dataset.id) {
                if (conf) {
                    form.submit();
                }
            }
        });
    });
});

const $tableCheckboxes = $(".table-checkbox");
const $deleteAllBtn = $(".delete-all-btn").hide();
const $checkAll = $(".check-all");

$deleteAllBtn.click(function (e) {
    e.preventDefault();
    const $conf = window.confirm("Remove users?");
    const $tableForm = $('.table-form');
    if ($conf) {
        $tableForm.submit();
    }
})

$tableCheckboxes.change(function () {
    $deleteAllBtn.toggle($tableCheckboxes.is(':checked'))
})

$checkAll.click(function () {
    $deleteAllBtn.toggle($checkAll.is(':checked'))
    $tableCheckboxes.not(this).prop('checked', this.checked);
});

