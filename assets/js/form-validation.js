const userForm = document.querySelector(".user-form");
const updateForm = document.querySelector(".update-form");
const submitUserForm = document.querySelector(".submit-btn");
const updateUserForm = document.querySelector(".update-btn");

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