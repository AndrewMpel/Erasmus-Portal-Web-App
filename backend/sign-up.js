const form = document.getElementById("signform");

const name = document.getElementById("name");
const surname = document.getElementById("surname"); 
const AM = document.getElementById("AM");
const email = document.getElementById("email");
const phone = document.getElementById("phone");
const username = document.getElementById("username");
const password = document.getElementById("password");
const confpsw = document.getElementById("confpsw");

const formMessage = document.getElementById("formMessage");

function isOnlyDigit(str) {
    for (let ch of str) {
        if (ch < '0' || ch > '9') {
            return false;
        }
    }
    return true;
}

function showMessage(message, isError = true) {
    formMessage.style.display = "block";
    formMessage.style.whiteSpace = "pre-line";
    formMessage.textContent = message;
    if (isError) {
        formMessage.classList.add("error");
        formMessage.classList.remove("success");
    } else {
        formMessage.classList.add("success");
        formMessage.classList.remove("error");
    }
}

function validateForm(event) {
    formMessage.style.display = "none";
    formMessage.textContent = "";

    let errors = [];

    
    for (let ch of surname.value.trim()) {
        if (!isNaN(ch) && ch !== " ") {
            errors.push("❌ Το επώνυμο δεν πρέπει να περιέχει αριθμούς.");
            break;
        }
    }

    
    for (let ch of name.value.trim()) {
        if (!isNaN(ch) && ch !== " ") {
            errors.push("❌ Το όνομα δεν πρέπει να περιέχει αριθμούς.");
            break;
        }
    }

    
    if (AM.value.length !== 13 || !AM.value.startsWith("2022") || !isOnlyDigit(AM.value)) {
        errors.push("❌ Ο Αριθμός Μητρώου πρέπει να έχει 13 ψηφία και να ξεκινάει με 2022.");
    }

    
    if (phone.value.length !== 10 || !isOnlyDigit(phone.value)) {
        errors.push("❌ Το τηλέφωνο πρέπει να έχει ακριβώς 10 ψηφία.");
    }

    
    if (
        !email.value.includes("@") ||
        !email.value.includes(".") ||
        email.value.startsWith("@") ||
        email.value.endsWith("@")
    ) {
        errors.push("❌ Μη έγκυρο email.");
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
        errors.push("❌ Ο κωδικός πρέπει να έχει τουλάχιστον 5 χαρακτήρες και έναν ειδικό χαρακτήρα.");
    }

   
    if (password.value !== confpsw.value) {
        errors.push("❌ Τα πεδία password και confirm password δεν ταιριάζουν.");
    }


    if (errors.length > 0) {
        event.preventDefault();
        showMessage(errors.join("\n"), true); 
    }
}

form.addEventListener("submit", validateForm);
