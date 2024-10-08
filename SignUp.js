const signUpBtn = document.getElementById("signup-btn");

function FormValidation(event) {
    const userName = document.getElementById("name").value;
    const userSurname = document.getElementById("surname").value;
    const userPassword = document.getElementById("password").value;
    const passwordConfirmation = document.getElementById("confirm-password").value;

    const day = document.getElementById("dob-day").value;
    const month = document.getElementById("dob-month").value;
    const year = document.getElementById("dob-year").value;

    // Validate Name and Surname
    if (userName.length < 3 || userSurname.length < 3) {
        window.alert("Name or Surname must be at least 3 characters long.");
        event.preventDefault();
        return;
    }

    // Validate Password
    if (userPassword.length < 6) { 
        window.alert("Password must be at least 6 characters long.");
        event.preventDefault();
        return;
    } else if (userPassword !== passwordConfirmation) {
        window.alert("Passwords don't match!");
        event.preventDefault();
        return;
    }

    // Validate Date of Birth
    if (!isValidDate(day, month, year)) {
        window.alert("Invalid date of birth. Please enter a valid date.");
        event.preventDefault();
        return;
    }
}

function isValidDate(day, month, year) {
    const monthIndex = {
        "Jan": 0, "Feb": 1, "Mar": 2, "Apr": 3, "May": 4, "Jun": 5,
        "Jul": 6, "Aug": 7, "Sep": 8, "Oct": 9, "Nov": 10, "Dec": 11
    };

    const selectedMonth = monthIndex[month];
    const selectedDay = parseInt(day);
    const selectedYear = parseInt(year);

    const date = new Date(selectedYear, selectedMonth, selectedDay);

    // date object represents the exact date selected by the user
    return (date.getFullYear() === selectedYear && date.getMonth() === selectedMonth && date.getDate() === selectedDay);
}

signUpBtn.addEventListener("click", FormValidation);
