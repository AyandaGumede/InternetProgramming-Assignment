<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SyncUp - Log In Form</title>
    <link rel="Stylesheet" href="LogIn.css">
</head>
<body>
    <form method="POST">
        <h2>Welcome back</h2>
        <p>Please fill in the details below to log in.</p>
        <hr>
        <input type="email" placeholder="Email address" name="user-email" id="email" required/>
        <br>
        <input type="password" placeholder="Password" id="curr-pass" name="password" required/>
        <br>
        <button type="submit" id="submit-btn" name="submit">Log In</button>
        <br>
        <a href="passwordReset.php">Forgot Password </a>|
        <a href="SignUp.php">Sign Up</a>
    </form>

    <div class="cookies" id="cookies">
    <h2>SyncUp Uses Cookies for various purposes.</h2>
        <p>Cookies are small files stored on your device that help websites function and improve your experience.<br>
            We use cookies to:<br>
            <ul>
            <li> Managing Cookies</li>
            <li>Ensure our site works properly</li>
            <li>Remember your preferences</li>
            <li>Deliver relevant content and ads</li>
            <li>Analyze how you use our site to improve performance</li>
            </ul>
            You can control or delete cookies through your browser settings. Note that disabling cookies may affect your site experience.
            For more details, visit <b><a href="$">All About Cookies</a></b>.
        </p>
        <br>
    <form action="LogInForm.php" method="POST" class="user-cookies">
        <div class="cookies-btn">
            <button type="submit" name="disable" id="disable">Disable</button>
            <button type="submit" name="enable">Agree</button>
        </div>
    </form>
</div>

<?php
session_start(); 

include("DB_Connection.php");

if (isset($_POST["submit"])) {
    $user_email = $_POST["user-email"];
    $user_password = strtolower($_POST["password"]); // password is lowercase

    // query
    $result = mysqli_query($connection, "SELECT users_id, password FROM syncup_users WHERE email = '$user_email'");

   
    if ($result && mysqli_num_rows($result) > 0) {  
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['users_id'];
        $database_password = $row['password'];

        // Verify password
        if ($user_password == $database_password) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_email'] = $user_email; 
            header("Location: homePage.php");
            exit(); 
        } else {
            echo "<script>window.alert('Incorrect password.');</script>";
        }
    } else {
        echo "<script>window.alert('Incorrect email or password.');</script>"; 
    }
}

if (isset($_POST["enable"])) {
    if (isset($_SESSION['user_email'])) {
        setcookie("userEmail", $_SESSION['user_email'], time() + 604800);
    }
}

mysqli_close($connection);
?>


<script src="LogIn.js"></script>
</body>
</html>