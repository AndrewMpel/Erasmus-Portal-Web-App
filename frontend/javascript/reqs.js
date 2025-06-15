const form = document.querySelector(".reqs-form");
const year = document.getElementById("year");
const passedCourses = document.getElementById("passed_courses");
const average = document.getElementById("average");
const englishRadios = document.querySelectorAll('input[name="english"]');
const finalMessage = document.getElementById("final-message");

form.addEventListener("submit", function (e) {
    e.preventDefault();
    checkValues();
});

function checkValues() {
    let allValid = true;

    const yearValue = parseInt(year.value);
    const passedCoursesValue = parseInt(passedCourses.value);
    const averageValue = parseFloat(average.value);
    const englishLevel = document.querySelector('input[name="english"]:checked');

    const englishMap = { A1: 1, A2: 2, B1: 3, B2: 4, C1: 5, C2: 6 };
    const requiredEnglish = 4;

    if (isNaN(yearValue) || yearValue < 2) {
        showError(year, "Το έτος πρέπει να είναι τουλάχιστον το 2ο");
        allValid = false;
    } else {
        showSuccess(year);
    }

    if (isNaN(passedCoursesValue) || passedCoursesValue < 70) {
        showError(passedCourses, "Το ποσοστό περασμένων μαθημάτων πρέπει να είναι τουλάχιστον 70%");
        allValid = false;
    } else {
        showSuccess(passedCourses);
    }

    if (isNaN(averageValue) || averageValue < 6.5) {
        showError(average, "Ο μέσος όρος πρέπει να είναι τουλάχιστον 6.50");
        allValid = false;
    } else {
        showSuccess(average);
    }

    const englishContainer = englishRadios[0].closest(".form-control");
    const small = englishContainer.querySelector("small");
    if (!englishLevel || englishMap[englishLevel.value] < requiredEnglish) {
        small.innerText = "Το επίπεδο αγγλικών πρέπει να είναι τουλάχιστον B2.";
        englishContainer.className = "form-control error";
        allValid = false;
    } else {
        small.innerText = "";
        englishContainer.className = "form-control success";
    }

    if (finalMessage) {
        const finalMessageSmall = finalMessage.querySelector("small");
        if (finalMessageSmall) { 
            if (allValid) {
                finalMessageSmall.innerText = "Συγχαρητήρια!! Περνάς επιτυχώς όλες τις προϋποθέσεις";
                finalMessage.className = "form-control success"; 
            } else {
                finalMessageSmall.innerText = "Δυστυχώς δεν πληροίς όλες τις απαιτήσεις";
                finalMessage.className = "form-control error"; 
            }
        }
    }
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
