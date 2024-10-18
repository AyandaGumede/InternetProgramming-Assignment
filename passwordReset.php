<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
         body{
            background-color: rgb(238, 238, 237);
        }
        #backBtn{
            width: 5%;
        }
        #backLink{
            color: white;
        }
        form{
            width: 30%;
            margin-top: 3%;
            padding: 22px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            font-family: "Helvetica Neue", Arial, sans-serif;
            margin-left: 35%;
            text-align: center;
        } form h2{
            text-align: center;
            font-family: sans-serif;
            padding: 1%;
        }
        form p{
            text-align: center;
            padding-bottom: 3%;
            font-size: 13.5px;
        }
        form input{
            width: 97%;
            height: 30px;
            border: 1px solid gray;
            border-radius: 5px;
            padding: 1%;
            margin-bottom: 1.8%;
            outline: none;
        }
        button{
            width: 30%;
            height: 35px;
            border: none;
            border-radius: 5px;
            background-color:cadetblue;
            color: white;
            cursor: pointer;
            margin-bottom: 2%;
        }
        button:hover{
            background-color: rgb(50, 84, 85);
            transform: scale(0.95);
        }
        .or-space{
            display: inline-flex;
        }
        span {
            display: inline-block;
            width: 40%;
            height: 3px;
            background-color: rgb(50, 84, 85);
            border: none;
            border-radius: 20px;
            margin-top: -5%;
        }
        a{
            font-size: 13.5px;
            color:rgb(50, 84, 85);
            text-align: right;
            text-decoration: none;
        }
        a:hover{
            color: cadetblue;
        }
    </style>
</head>
<body>
    <button id="backBtn"><a href="LogInForm.php" id="backLink">Back</a></button>
    <form action="passwordReset.php" method="POST">
        <h2>Trouble with loggin in?</h2>
        <p>Forgot your password?<br> Don't worry just enter your email address below, we'll get back your account.</p>
        <input type="email" placeholder="Email address" name="email" required/>
        <input type="password" placeholder="Enter new password" name="new-password" required/>
        <button type="submit" name="submitBtn">Submit</button>
    </form>

    <?php
include("DB_Connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submitBtn"])) {
        $user_email = $_POST["email"];
        $password = strtolower($_POST["new-password"]);

        // Hash the new password
        $new_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the user exists
        $sql = "SELECT * FROM syncup_users WHERE email = ?";
        $connect = $connection->prepare($sql);
        $connect->bind_param("s", $user_email); 
        $connect->execute();
        $result = $connect->get_result();

        if ($result->num_rows > 0) {
            // User exists, update the password
            $update_sql = "UPDATE syncup_users SET password = ? WHERE email = ?";
            $update_stmt = $connection->prepare($update_sql);
            $update_stmt->bind_param("ss", $new_password, $user_email);
            $update_stmt->execute();

            if ($update_stmt->affected_rows > 0) {
                echo "<script>alert('Password updated successfully');</script>";
            } else {
                echo "<script>alert('Failed to update password');</script>";
            }

            $update_stmt->close();
        } else {
            echo "<script>alert('User not found');</script>";
        }

        $connect->close();
    }
}
?>


</body>
</html>