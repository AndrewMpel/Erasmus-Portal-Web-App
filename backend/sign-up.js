const form = document.getElementById("signform");

const name = document.getElementById("name");
const surname = document.getElementById("surname"); 
const AM = document.getElementById("AM");
const email = document.getElementById("email");
const phone = document.getElementById("phone");
const username = document.getElementById("username");
const password = document.getElementById("password");
const confpsw = document.getElementById("confpsw");

function isOnlyDigit(str) {
    for (let ch of str) {
        if (ch < '0' || ch > '9') {
            return false;
        }
    }
    return true;
}

function showError(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector("small");
    if (small) {
        small.innerText = message;
        formControl.className = "form-control error";
    }
}

function showSuccess(input) {
    const formControl = input.parentElement;
    const small = formControl.querySelector("small");
    if (small) {
        small.innerText = "";
        formControl.className = "form-control success";
    }
}

form.addEventListener("submit", function (e) {
    e.preventDefault();
    const isValid = validateForm();
    if (isValid) {
        form.submit();
    }
});

function validateForm() {
    let isValid = true;

    if (/\d/.test(surname.value.trim())) {
        showError(surname, "Το επώνυμο δεν πρέπει να περιέχει αριθμούς.");
        isValid = false;
    } else {
        showSuccess(surname);
    }

    if (/\d/.test(name.value.trim())) {
        showError(name, "Το όνομα δεν πρέπει να περιέχει αριθμούς.");
        isValid = false;
    } else {
        showSuccess(name);
    }

    if (AM.value.length !== 13 || !AM.value.startsWith("2022") || !isOnlyDigit(AM.value)) {
        showError(AM, "Ο Αριθμός Μητρώου πρέπει να έχει 13 ψηφία και να ξεκινάει με 2022.");
        isValid = false;
    } else {
        showSuccess(AM);
    }

    if (phone.value.length !== 10 || !isOnlyDigit(phone.value)) {
        showError(phone, "Το τηλέφωνο πρέπει να έχει ακριβώς 10 ψηφία.");
        isValid = false;
    } else {
        showSuccess(phone);
    }

    if (
        !email.value.includes("@") ||
        !email.value.includes(".") ||
        email.value.startsWith("@") ||
        email.value.endsWith("@")
    ) {
        showError(email, "Μη έγκυρο email.");
        isValid = false;
    } else {
        showSuccess(email);
    }

    const specialChars = "!@#$%^&*()_+-=[]{};:'\"\\|,.<>/?";
    let hasSpecial = false;
    for (let ch of password.value) {
        if (specialChars.includes(ch)) {
            hasSpecial = true;
            break;
        }
    }

    if (password.value.length < 5 || !hasSpecial) {
        showError(password, "Ο κωδικός πρέπει να έχει τουλάχιστον 5 χαρακτήρες και έναν ειδικό χαρακτήρα.");
        isValid = false;
    } else {
        showSuccess(password);
    }

    if (password.value !== confpsw.value) {
        showError(confpsw, "Τα πεδία password και confirm password δεν ταιριάζουν.");
        isValid = false;
    } else {
        showSuccess(confpsw);
    }
    return isValid;
}
