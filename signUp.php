<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SyncUp - Sign Up Form</title>
    <link rel="stylesheet" href="SignUp.css">   
</head>
<body>
    <form action="SignUp.php" method="POST">
                <?php
                // Start the session
                session_start();
            
                include("DB_Connection.php");
            
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST["name"];
                    $user_surname = $_POST["surname"];
                    $user_email = $_POST["email"];
                    $password = strtolower($_POST["password"]);
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $day = $_POST['dob-day'];
                    $month = $_POST["dob-month"];
    
                    $month_numeric = date('m', strtotime($month));
                    $year = $_POST['dob-year'];
                    // Corrected date format
                    $date_of_birth = $year . '-' . $month_numeric . '-' . $day;
            
                    // Name session
                    $_SESSION['username'] = $username;
                    $_SESSION['user_surname'] = $user_surname;
            
                    $db_connecor = $connection->prepare("INSERT INTO syncup_users (first_name, last_name, email, password, date_of_birth) VALUES (?, ?, ?, ?, ?)");
            
                    // Bind the actual values to the placeholders
                    $db_connecor->bind_param("sssss", $username, $user_surname, $user_email, $hashed_password, $date_of_birth);
            
                    // Execute the statement
                    if ($db_connecor->execute()) {
                        header("Location: homePage.php");
                        exit();
                    } else {
                        // Output the error for debugging
                        echo "<script>window.alert('Failed to create account: " . $db_connecor->error . "');</script>";
                    }
                    
                    // Close the statement and connection
                    $db_connecor->close();
                    mysqli_close($connection);
                }
                ?>
        <h2>Create a new account</h2>
        <p id="slogan">It's quick and easy.</p>
        <hr>
        <input type="text" placeholder="First name" id="name" name="name" required/>
        <input type="text" placeholder="Surname" id="surname" name="surname" required/>
        <br/>
        <input type="email" placeholder="Email address" name="email" required/>
        <br/>
        <input type="password" placeholder="New password" id="password" name="password" required/>
        <br/>
        <input type="password" placeholder="Confirm new password" id="confirm-password" name="confirm-password" required/>
        <br/>
        <div class="dob-container">
            <label for="dob-day">Date of birth</label>
            <br/>
            <select id="dob-day" name="dob-day" required>
                <?php for ($i = 1; $i <= 31; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
            <select id="dob-month" name="dob-month" required>
                <?php 
                $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                foreach ($months as $month): ?>
                    <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
                <?php endforeach; ?>
            </select>
            <select id="dob-year" name="dob-year" required>
                <?php for ($year = 1990; $year <= 2006; $year++): ?>
                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <br/>
        <p class="disclaimer">By clicking Sign Up, you agree to our <a href="#">Terms, Privacy Policy</a> and <a href="#">Cookies Policy</a>.</p>
        <br>
        <button type="submit" class="signup-btn" id="signup-btn">Sign Up</button>
        <br>
        <a href="LogInForm.php" class="logIn">Already have an account?</a>
    </form>


    <script src="SignUp.js"></script>
</body>
</html>
