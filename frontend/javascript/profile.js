const form = document.getElementById("profile");
const name = document.getElementById("name");
const surname = document.getElementById("surname");
const AM = document.getElementById("AM");
const email = document.getElementById("email");
const phone = document.getElementById("phone");
const formMessage = document.getElementById("formMessage");

form.addEventListener("submit", function(e) {
  e.preventDefault();

  if (!checkValues()) {
    return;
  }
  const formData = new FormData(form);

  fetch('../../backend/profileChange.php', {
    method: 'POST',
    body: formData,
    credentials: 'same-origin'
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      formMessage.style.color = "green";
      formMessage.innerText = data.message;
        setTimeout(() => location.reload(), 1500);
    } else {
      formMessage.style.color = "red";
      formMessage.innerText = data.message;
    }
  })
  .catch(error => {
    formMessage.style.color = "red";
    formMessage.innerText = "Κάτι πήγε στραβά. Δοκίμασε ξανά.";
    console.error('Error:', error);
  });
});

function checkValues() {
  const nameValue = name.value.trim();
  const surnameValue = surname.value.trim();
  const amValue = AM.value.trim();
  const emailValue = email.value.trim();
  const phoneValue = phone.value.trim();

  const allEmpty = !nameValue && !surnameValue && !amValue && !emailValue && !phoneValue;

  if (allEmpty) {
    formMessage.style.color = "red";
    formMessage.innerText = "Δεν έγινε καμία αλλαγή.";
    return false;
  } else {
    formMessage.innerText = "";
  }

  return true;
}
