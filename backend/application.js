document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('.form');

  const passedCourses = form.querySelector('input#passed_courses');
  const totalCourses = document.getElementById('total_courses');
  const percentage = document.getElementById('percentage');

  const average = document.getElementById('average');
  const englishRadios = document.getElementsByName('english');
  const langRadios = document.getElementsByName('languages');
  const uni1 = document.getElementById('1st-Choice');
  const uni2 = document.getElementById('2nd-Choice');
  const uni3 = document.getElementById('3rd-Choice');
  const grades = document.querySelector('input[name="grades"]');
  const langCert = document.querySelector('input[name="language_certificate"]');
  const agree = document.getElementById('Agree');

  function updatePercentage() {
    const passedVal = parseInt(passedCourses.value, 10);
    const totalVal = parseInt(totalCourses.value, 10);

    console.log('Passed:', passedVal, 'Total:', totalVal);  // Debug output

    if (!isNaN(passedVal) && !isNaN(totalVal) && totalVal > 0) {
      const perc = ((passedVal / totalVal) * 100).toFixed(2);
      if (percentage) {
        percentage.value = perc + '%';
      }
    } else {
      if (percentage) {
        percentage.value = '';
      }
    }
  }

  passedCourses.addEventListener('input', updatePercentage);
  totalCourses.addEventListener('input', updatePercentage);

  form.addEventListener('submit', function (event) {
    event.preventDefault();

    document.querySelectorAll('.form-control').forEach(el => {
      el.classList.remove('error');
      el.classList.remove('success');
      const small = el.querySelector('small');
      if (small) small.innerText = '';
    });

    let hasError = false;

    if (passedCourses.value.trim() === '') {
      showError(passedCourses, "Συμπληρώστε τον αριθμό περασμένων μαθημάτων.");
      hasError = true;
    } else if (isNaN(passedCourses.value) || Number(passedCourses.value) < 0) {
      showError(passedCourses, "Εισάγετε έγκυρο αριθμό περασμένων μαθημάτων.");
      hasError = true;
    } else {
      showSuccess(passedCourses);
    }

    if (!totalCourses) {
    } else {
      if (totalCourses.value.trim() === '') {
        showError(totalCourses, "Συμπληρώστε το συνολικό αριθμό μαθημάτων.");
        hasError = true;
      } else if (isNaN(totalCourses.value) || Number(totalCourses.value) <= 0) {
        showError(totalCourses, "Εισάγετε έγκυρο συνολικό αριθμό μαθημάτων (> 0).");
        hasError = true;
      } else {
        showSuccess(totalCourses);
      }
    }

    if (average.value.trim() === '') {
      showError(average, "Συμπληρώστε το μέσο όρο.");
      hasError = true;
    } else {
      showSuccess(average);
    }

    if (!Array.from(englishRadios).some(r => r.checked)) {
      showError(englishRadios[0].closest('.form-control'), "Επιλέξτε επίπεδο αγγλικών.");
      hasError = true;
    } else {
      showSuccess(englishRadios[0].closest('.form-control'));
    }

    if (!Array.from(langRadios).some(r => r.checked)) {
      showError(langRadios[0].closest('.form-control'), "Επιλέξτε αν έχετε άλλη γλωσσική γνώση.");
      hasError = true;
    } else {
      showSuccess(langRadios[0].closest('.form-control'));
    }

    if (uni1.value === '0') {
      showError(uni1, "Επιλέξτε 1η προτίμηση πανεπιστημίου.");
      hasError = true;
    } else {
      showSuccess(uni1);
    }

    if (uni2.value === '0') {
      showError(uni2, "Επιλέξτε 2η προτίμηση πανεπιστημίου.");
      hasError = true;
    } else {
      showSuccess(uni2);
    }

    if (uni3.value === '0') {
      showError(uni3, "Επιλέξτε 3η προτίμηση πανεπιστημίου.");
      hasError = true;
    } else {
      showSuccess(uni3);
    }

    if (!grades.files || grades.files.length === 0) {
      showError(grades, "Ανεβάστε το αρχείο βαθμολογίας.");
      hasError = true;
    } else {
      showSuccess(grades);
    }

    if (!langCert.files || langCert.files.length === 0) {
      showError(langCert, "Ανεβάστε το πιστοποιητικό γλωσσομάθειας.");
      hasError = true;
    } else {
      showSuccess(langCert);
    }

    if (!agree.checked) {
      showError(agree, "Πρέπει να αποδεχθείτε τους όρους.");
      hasError = true;
    } else {
      showSuccess(agree);
    }

    if (!hasError) {
      form.submit();
    }
  });

  function showError(input, message) {
    let formControl;
    if (input instanceof HTMLElement && input.classList.contains('form-control')) {
      formControl = input;
    } else if (input instanceof HTMLElement) {
      formControl = input.parentElement;
    } else {
      return;
    }
    const small = formControl.querySelector('small');
    if (small) small.innerText = message;
    formControl.classList.add('error');
    formControl.classList.remove('success');
  }

  function showSuccess(input) {
    let formControl;
    if (input instanceof HTMLElement && input.classList.contains('form-control')) {
      formControl = input;
    } else if (input instanceof HTMLElement) {
      formControl = input.parentElement;
    } else {
      return;
    }
    const small = formControl.querySelector('small');
    if (small) small.innerText = '';
    formControl.classList.remove('error');
    formControl.classList.add('success');
  }
});

