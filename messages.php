<?php
    include("DB_Connection.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syncup | Messages</title>
    <style>
        body {
            background-color: rgb(238, 238, 237);
        }
        button {
            width: 8%;
            height: 40px;
            background-color: cadetblue;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }
        button a {
            text-decoration: none;
            color: white;
            font-size: 14px;
        }
        .inbox-area {
            border: none;
            border-radius: 10px;
            margin-left: 27%;
            padding: 2%;
            width: 40%;
            background: white; 
            padding-left: 8%; 
        }
        .inbox-area h1 {
            font-size: 45px;
            font-family: "Helvetica Neue", Arial, sans-serif;
        }
        .inbox-area button {
            width: 20%;
            height: 48px;
        }
        .inbox-area input {
            width: 60%;
            height: 30px;
            border: 1px solid grey;
            border-radius: 10px;
            padding: 1%;
            outline: none;
            font-size: 14px;
        }
        .error {
            color: red;
            font-weight: bold;
            font-family: Arial;
            font-style: italic;
        }
        
        li {
            list-style: none;
            display: inline-flex;
            padding: 5%;
            width: 80%;
            height: 15px;
            margin-left: -7%;
            background: rgb(238, 238, 237);
            border: none;
            border-radius: 5px;
            box-shadow: 0 0px 4.5px 0px rgb(44, 44, 54);
            cursor: pointer;
            margin-bottom: 2%;
        }
        li a{
            text-decoration: none;
            color: black;
        }
        img{
            width: 9.6%;
            height: 45px;
            border: 2px solid ;
            border-radius: 50%;
            margin-right: 3%;
            margin-top: -3%;
        }
        li:hover{
            box-shadow: 0 0px 6px 0px rgb(0, 0, 0);
        }
        li h2{
            margin-top: -2%;
            font-family: 'Segoe UI';
            font-weight: lighter;
        }
    </style>
</head>
<body>
    <button><a href="homePage.php">Back</a></button>
    <div class="inbox-area">
        <h1>Inbox</h1>
        <br>
        <form action="messages.php" method="POST">
            <input type="text" placeholder="Search.." name="search_input"/>
            <button type="submit" name="searchBtn">Search</button>
            <?php 
                if(isset($_POST["searchBtn"])){
                    $searchArea = $_POST["search_input"];
                    if(empty($searchArea)){
                        echo "<p class='error'>Please write something....*</p>";
                    } else {
                        $sqlQuery = mysqli_query($connection, "SELECT first_name, last_name, email, user_profile FROM syncup_users WHERE email = '$searchArea' OR first_name = '$searchArea'");
                        $row = mysqli_num_rows($sqlQuery);    
                        if ($row > 0) {
                            $r = mysqli_fetch_array($sqlQuery);
                            $_SESSION['searched-user'] = $r['email'] ;
                            echo "<h1>Search Results</h1>";
                            echo "<ul>"; 
                            echo "<li>"."<img src='images/" . $r['user_profile'] . "' alt='No Profile' />" ."<h2>"."<a href='directMessages.php'>".$r['first_name']." ".$r['last_name']."</a>"."</h2></li>";
                            echo "</ul>"; 
                        } else {
                            echo "<p class='error'>No results found for '$searchArea'.</p>";
                        }
                    }
                }
            ?>
        </form>
        <br>
    </div>
</body>
</html>
