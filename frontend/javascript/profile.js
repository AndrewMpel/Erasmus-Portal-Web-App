const form = document.getElementById("profile");
const nameInput = document.getElementById("name");
const surnameInput = document.getElementById("surname");
const amInput = document.getElementById("AM");
const emailInput = document.getElementById("email");
const phoneInput = document.getElementById("phone");
const passwordInput = document.getElementById("password");
const formMessage = document.getElementById("formMessage");

const formControlDiv = formMessage.closest('.form-control');

const currentNameSpan = document.getElementById("currentName");
const currentSurnameSpan = document.getElementById("currentSurname");
const currentAMSpan = document.getElementById("currentAM");
const currentEmailSpan = document.getElementById("currentEmail");
const currentPhoneSpan = document.getElementById("currentPhone");

function displayError(message) {
    formMessage.style.color = "red";
    formMessage.innerText = message;
    formControlDiv.classList.add('error');
    formControlDiv.classList.remove('success');
}

function clearMessages() {
    formMessage.innerText = "";
    formControlDiv.classList.remove('success', 'error');
}

form.addEventListener("submit", function(e) {
  e.preventDefault();

  clearMessages();

  if (!checkValues()) {
    return;
  }

  const formData = new FormData(form);

  fetch('../../backend/profileChange.php', {
    method: 'POST',
    body: formData,
    credentials: 'same-origin'
  })
  .then(response => {
    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();
  })
  .then(data => {
    if (data.success) {
      formMessage.style.color = "green";
      formMessage.innerText = data.message;
      formControlDiv.classList.add('success');

      if (data.updatedData) {
        currentNameSpan.innerText = data.updatedData.name;
        currentSurnameSpan.innerText = data.updatedData.surname;
        currentAMSpan.innerText = data.updatedData.student_id;
        currentEmailSpan.innerText = data.updatedData.email;
        currentPhoneSpan.innerText = data.updatedData.phone;
      }

      nameInput.value = '';
      surnameInput.value = '';
      amInput.value = '';
      phoneInput.value = '';
      emailInput.value = '';
      passwordInput.value = '';

    } else {
      displayError(data.message);
    }
  })
  .catch(error => {
    displayError("Κάτι πήγε στραβά: " + error.message + ". Δοκίμασε ξανά.");
    console.error('Fetch Error:', error);
  });
});

function isOnlyDigit(str) {
    return /^\d+$/.test(str);
}

function checkValues() {
    const nameValue = nameInput.value.trim();
    const surnameValue = surnameInput.value.trim();
    const amValue = amInput.value.trim();
    const emailValue = emailInput.value.trim();
    const phoneValue = phoneInput.value.trim();
    const passwordValue = passwordInput.value;

    clearMessages(); 

    const allEmpty = !nameValue && !surnameValue && !amValue && !emailValue && !phoneValue && !passwordValue;

    if (allEmpty) {
        displayError("Δεν έγινε καμία αλλαγή");
        return false;
    }

    if (nameValue) {
        if (/\d/.test(nameValue)) {
            displayError("Το όνομα δεν πρέπει να περιέχει αριθμούς");
            return false;
        }
    }

    if (surnameValue) {
        if (/\d/.test(surnameValue)) {
            displayError("Το επώνυμο δεν πρέπει να περιέχει αριθμούς");
            return false;
        }
    }

    if (amValue) {
        if (amValue.length !== 13 || !amValue.startsWith("2022") || !isOnlyDigit(amValue)) {
            displayError("Ο Αριθμός Μητρώου πρέπει να έχει 13 ψηφία και να ξεκινάει με 2022");
            return false;
        }
    }

    if (phoneValue) { 
        if (phoneValue.length !== 10 || !isOnlyDigit(phoneValue)) {
            displayError("Το τηλέφωνο πρέπει να έχει ακριβώς 10 ψηφία");
            return false; // STOP if error found
        }
    }

    if (emailValue) {
        if (
            !emailValue.includes("@") ||
            !emailValue.includes(".") ||
            emailValue.startsWith("@") ||
            emailValue.endsWith("@")
        ) {
            displayError("Μη έγκυρο email");
            return false;
        }
    }

    if (passwordValue) { 
        const specialChars = "!@#$%^&*()_+-=[]{};:'\"\\|,.<>/?";
        let hasSpecial = false;
        for (let ch of passwordValue) {
            if (specialChars.includes(ch)) {
                hasSpecial = true;
                break;
            }
        }
        if (passwordValue.length < 5 || !hasSpecial) {
            displayError("Ο κωδικός πρέπει να έχει τουλάχιστον 5 χαρακτήρες και έναν ειδικό χαρακτήρα");
            return false;
        }
    }
    return true;
}