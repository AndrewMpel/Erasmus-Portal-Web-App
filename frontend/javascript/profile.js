const form = document.getElementById("profile");
const nameInput = document.getElementById("name");
const surnameInput = document.getElementById("surname"); 
const amInput = document.getElementById("AM"); 
const emailInput = document.getElementById("email");
const phoneInput = document.getElementById("phone"); 
const formMessage = document.getElementById("formMessage");

const formControlDiv = formMessage.closest('.form-control');

const currentNameSpan = document.getElementById("currentName");
const currentSurnameSpan = document.getElementById("currentSurname");
const currentAMSpan = document.getElementById("currentAM");
const currentEmailSpan = document.getElementById("currentEmail");
const currentPhoneSpan = document.getElementById("currentPhone");

form.addEventListener("submit", function(e) {
  e.preventDefault();

  formMessage.innerText = "";
  formMessage.style.color = "";
  formControlDiv.classList.remove('success', 'error');

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
    // Parse the JSON response body
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

    } else {
      formMessage.style.color = "red";
      formMessage.innerText = data.message;
      formControlDiv.classList.add('error');
    }
  })
  .catch(error => {
    formMessage.innerText = "Κάτι πήγε στραβά: " + error.message + ". Δοκίμασε ξανά.";
    formControlDiv.classList.add('error');
    console.error('Fetch Error:', error);
  });
});
function checkValues() {
  const nameValue = nameInput.value.trim();
  const surnameValue = surnameInput.value.trim();
  const amValue = amInput.value.trim();
  const emailValue = emailInput.value.trim();
  const phoneValue = phoneInput.value.trim();

  formMessage.innerText = "";
  formMessage.style.color = "";
  formControlDiv.classList.remove('success', 'error');

  const allEmpty = !nameValue && !surnameValue && !amValue && !emailValue && !phoneValue;

  if (allEmpty) {
    formMessage.style.color = "red";
    formMessage.innerText = "Δεν έγινε καμία αλλαγή";
    formControlDiv.classList.add('error');
    return false;
  }

  // Basic email format validation
  if (emailValue && !/^\S+@\S+\.\S+$/.test(emailValue)) {
    formMessage.style.color = "red";
    formMessage.innerText = "Παρακαλώ εισάγετε ένα έγκυρο email.";
    formControlDiv.classList.add('error'); // Add 'error' class to make message visible
    return false;
  }
  // You can add more client-side validation rules here (e.g., phone number length, AM format)

  return true; // All client-side checks passed
}