<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SyncUp - Log In Form</title>
    <style>
        body{
            background-color: rgb(238, 238, 237);
            height: 100%;
            margin: 0;
            display: grid;
            place-items: center;
        }
        form{
            width: 30%;
            margin-top: 3%;
            padding: 22px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            font-family: "Helvetica Neue", Arial, sans-serif;
        }
        form h2{
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
    <form action="LogInForm.php" method="POST">
        <h2>Welcome back</h2>
        <p>Please fill in the details below to log in.</p>
        <hr>
        <input type="email" placeholder="Email address" required/>
        <br>
        <input type="password" placeholder="Password" id="password" required/>
        <br>
        <button type="submit">Log In</button>
        <br>
        <a href="passwordReset.php">Forgot Password </a>|
        <a href="SignInForm.php">Sign Up</a>
    </form>
</body>
</html>