
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".reqs-form");
    const messageBox = document.getElementById("messageBox");


    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const year = parseInt(document.getElementById("year").value);
        const passedCourses = parseInt(document.getElementById("passed_courses").value);
        const average = parseFloat(document.getElementById("average").value);
        const englishLevel = document.querySelector('input[name="english"]:checked');

        const englishMap = { A1: 1, A2: 2, B1: 3, B2: 4, C1: 5, C2: 6 };
        const requiredEnglish = 4;

        let errors = [];

        if (isNaN(year) || year <= 2) {
            errors.push("Το έτος σπουδών πρέπει να είναι τουλάχιστον 2ο.");
        }

        if (isNaN(passedCourses) || passedCourses < 70) {
            errors.push("Το ποσοστό περασμένων μαθημάτων πρέπει να είναι τουλάχιστον 70%.");
        }

        if (isNaN(average) || average < 6.5) {
            errors.push("Ο μέσος όρος πρέπει να είναι τουλάχιστον 6.50.");
        }

        if (!englishLevel || englishMap[englishLevel.value] < requiredEnglish) {
            errors.push("Το επίπεδο αγγλικών πρέπει να είναι τουλάχιστον B2.");
        }

        if (errors.length > 0) {
            messageBox.className = "message-box  message-error";
            messageBox.innerHTML = "❌ Δεν πληρούνται οι απαιτήσεις:<br><ul>" + errors.map(e => `<li>${e}</li>`).join('') + "</ul>";
        } else {
           messageBox.className = "message-box message-success";
            messageBox.innerHTML = "✅ Πληροίτε όλες τις ελάχιστες απαιτήσεις για το πρόγραμμα Erasmus!";
        }
    })
})


