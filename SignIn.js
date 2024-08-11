const signUpBtn = document.getElementById("signup-btn");

        function FormValidation(event) {
            event.preventDefault();

            const userName = document.getElementById("name").value;
            const userSurname = document.getElementById("surname").value;
            const userPassword = document.getElementById("password").value;
            const passwordConfirmation = document.getElementById("confirm-password").value;
            const day = parseInt(document.getElementById("dob-day").value);
            const month = document.getElementById("dob-month").value; 
            const year = parseInt(document.getElementById("dob-year").value);


            if (userName.length < 3 || userSurname.length < 3) {
                window.alert("Name or Surname must be at least 3 characters long.");
                return;
            }

            if (userPassword.length < 6) {
                window.alert("Password must be at least 6 characters long.");
                return;
            } else if (userPassword !== passwordConfirmation) {
                window.alert("Passwords don't match!");
                return;
            }

            // Convert month string to a month index (0-11)
            const monthIndex = {
                'Jan': 0, 'Feb': 1, 'Mar': 2, 'Apr': 3,
                'May': 4, 'Jun': 5, 'Jul': 6, 'Aug': 7,
                'Sep': 8, 'Oct': 9, 'Nov': 10, 'Dec': 11
            };

            // Create a date object
            const date = new Date(year, monthIndex[month], day);

            // Check if the date is valid
            if (
                date.getFullYear() === year &&
                date.getMonth() === monthIndex[month] &&
                date.getDate() === day
            ) {
                window.alert('Date is valid');
            } else {
                window.alert('Invalid date');
                return;
            }

            window.alert("Form submitted successfully!");
        }

        signUpBtn.addEventListener("click", FormValidation);