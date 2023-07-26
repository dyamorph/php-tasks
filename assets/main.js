const deleteBtns = document.querySelectorAll(".delete-btn");
const deleteForms = document.querySelectorAll("#delete");
const userForm = document.querySelector(".user-form");
const updateForm = document.querySelector(".update-form");
const submitUserForm = document.querySelector(".submit-btn");
const updateUserForm = document.querySelector(".update-btn");
const paginationItems = document.querySelectorAll(".page-item");

const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});
const page = params.page;

if (page === null) {
    paginationItems[0].classList.add('active')
} else {
    paginationItems[page - 1].classList.add('active')
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

function validate(form) {

    function removeErrors(input) {
        const parent = input.parentElement;
        if (input.classList.contains("is-invalid")) {
            input.classList.remove("is-invalid");
            parent.querySelector(".error-message").remove();
        }
    }

    function createError(input, text) {
        const parent = input.parentElement;
        const invalidFeedback = parent.querySelector(".invalid-feedback");
        const errorMessage = document.createElement("p");
        input.classList.add("is-invalid");
        errorMessage.classList.add("error-message");
        errorMessage.textContent = text;
        invalidFeedback.appendChild(errorMessage);
        parent.appendChild(invalidFeedback);
    }

    let result = true;

    const inputs = document.querySelectorAll('.form-input');
    const selects = document.querySelectorAll('.select-input')

    for (let input of inputs) {
        removeErrors(input);
        if (input.dataset.name) {
            if (!input.value.match(/^[a-zA-Z ]*$/)) {
                removeErrors(input);
                createError(input, 'Only letters allowed!');
                result = false;
            }
        }

        if (input.dataset.email) {
            if (!input.value.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.+([a-zA-Z0-9-]+)*$/)) {
                removeErrors(input);
                createError(input, 'Enter email in format: example@mail.com');
                result = false;
            }
        }

        if (input.value === '') {
            removeErrors(input);
            createError(input, 'Fill this field!');
            result = false;
        }
    }

    for (let select of selects) {
        removeErrors(select);
        if (select.value === '') {
            removeErrors(select);
            createError(select, 'Select a value!');
            result = false;
        }
    }
    return result;
}

if (submitUserForm) {
    submitUserForm.addEventListener('click', (e) => {
        e.preventDefault();
        if (validate(userForm) === true) {
            userForm.submit();
        }
    })
}
if (updateUserForm) {
    updateUserForm.addEventListener('click', (e) => {
        e.preventDefault();
        if (validate(updateForm) === true) {
            updateForm.submit();
        }
    })
}

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
