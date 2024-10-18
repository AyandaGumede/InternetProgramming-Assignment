<?php 
    session_start();
    include("DB_Connection.php");

    // logged-in user's email
    $user_id = $_SESSION['user_id'];
    $sqlQuery = mysqli_query($connection, "SELECT email FROM syncup_users WHERE users_id = '$user_id'");
    $r = mysqli_fetch_array($sqlQuery);

    if ($r) {
        $userEmail = $r['email']; 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syncup | Chats</title>
</head>
<style>
        body{
        background-color: rgb(238, 238, 237);
        height: 100%;
        margin: 0;
        display: grid;
        place-items: center;
        }
        #back{
            margin-top: 2%;
            margin-left: -92%;
            width: 3%;
            height: 6.5vh;
            background-color: cadetblue;
            color: white;
            font-size: 28px;
            border: none;
            border-radius: 50%;
        }
        #back:hover{
            background-color: rgb(50, 84, 85);
        }
        #back a{
            color: white;
            text-decoration: none;
        }
        .chats{
            width: 35%;
            height: 84vh;
            margin-top: 0%;
            border: none;
            border-radius: 10px;
            background-color: white;
            font-family: "Helvetica Neue", Arial, sans-serif;
            
        }
        .details-area{
            width: 100%;
            height: 15vh;
            display: inline-flex;
            border: none;
            border-radius: 10px  10px 0px 0px; 
            background-color: grey;
        }
        img{
            width: 23%;
            height: 17vh;
            margin-top: 8%;
            margin-left: 5%;
            border: 5px solid white;
            border-radius: 50%;
        }
        h1{
            color: white;
            font-size: 35px;
            padding-top: 5%;
            padding-left: 2%;
            font-family: 'Segoe UI';
            font-weight: lighter;
        }
        
        /* - - - - - - - Messages - - - - - */
        .messages {
    margin: 2%;
    width: 90%;
    height: 38vh; /* Fixed height for the message container */
    padding: 2%;
    border: 1px solid grey;
    border-radius: 10px;
    overflow-y: auto; /* Enables vertical scrolling when content overflows */
    background-color: #f9f9f9; /* Optional: Adds a light background for better visibility */
}

        .myMessage{
            width: 40%;
            padding: 1%;
            border: none;
            border-radius: 5px;
            margin-top: 2%;
            margin-left: 58%;
            background-color: cadetblue;
            font-size: 14px;
            color: white;
        }
        .myMessage b{
            margin-left: 78%;
            font-size: 10px;
        }
        .senderEmail{
            width: 40%;
            padding: 1%;
            border: none;
            border-radius: 5px;
            margin-top: 2%;
            background-color: gray;
            font-size: 18px;
            padding-left: 4%;
            color: white;
        }
        .senderEmail b{
            margin-left: 78%;
            font-size: 10px;
        }
        hr{
            width: 100%;
            margin-top: 5%;
        }
        /* ------ Sending Area ------- */
        .sending-area{
            padding: 2%;
        }
        .sending-area button{
            width: 10%;
            height: 48px;
            border: none;
            border-radius: 50%;
            background-color: grey;
            color: white;
            font-size: 18px;
            margin-left: 1px;
            cursor: pointer;
        }
        button:hover{
            background-color: black;
        }
        .sending-area input{
            width: 80%;
            height: 28px;
            border: 1px solid grey;
            border-radius: 15px;
            outline: none;
            padding: 2%;
            margin-top: -5%;
            margin-left: 3%;
        }
    </style>

<body>
    <button id="back"><a href="userProfile.php"><</a></button>
    <div class="chats">
        <div class="details-area">
            <?php 
                $searchedUser = $_SESSION['searched-user'];
                $sqlQuery = mysqli_query($connection, "SELECT * FROM syncup_users WHERE email = '$searchedUser'");
                $r = mysqli_fetch_array($sqlQuery);
                if ($r) {
                    echo "<img src='images/" . $r['user_profile'] . "' alt='No Profile' />";
                    echo "<h1>".$r['first_name']." ".$r['last_name']."</h1>";
                } 
            ?>
        </div>
        <!-- ------- Messages Area - - - - - -  -->
        <div class="messages">
            <?php 
                $sqlQuery = mysqli_query($connection, 
                "SELECT user_email, recipient_email, message, message_time 
                FROM syncup_messages 
                WHERE (user_email = '$userEmail' AND recipient_email = '$searchedUser') 
                OR (user_email = '$searchedUser' AND recipient_email = '$userEmail') 
                ORDER BY message_time"); 
            
                if ($sqlQuery) {
                    while ($r = mysqli_fetch_array($sqlQuery)) {
                        if ($r['user_email'] == $userEmail) {
                            echo "<div class='myMessage'>" . htmlspecialchars($r['message']) . "<br><b>" . htmlspecialchars($r['message_time']) . "</b></div>";
                        } else {
                            echo "<div class='senderEmail'>" . htmlspecialchars($r['message']) . "<br><b>" . htmlspecialchars($r['message_time']) . "</b></div>";
                        }
                    }
                } else {
                    echo "Error in query: " . mysqli_error($connection);
                }
            
            ?>
        </div>
        
    <hr>
    <!-- - - - - - - - - - SENDING AREA - - - - - - - - -->
        <div class="sending-area">
        <div class="sending-area">
        <form method="post" action="">
            <input type="text" name="typingArea" required>
            <button name="send">></button>

            <?php 
                //  recipient's email
                if (isset($_SESSION['searched-user'])) {
                    $searchedUser = $_SESSION['searched-user'];  
                }
                
                
                if (isset($_POST["send"])) {
                    

                    $message = $_POST["typingArea"];  

                    if (empty($message)) {
                        echo "<script>alert('Please write something');</script>";
                    }
                    $sqlQuery = mysqli_query($connection, "INSERT INTO syncup_messages(user_email, recipient_email, message) VALUES ('$userEmail', '$searchedUser', '$message')");
                    if ($sqlQuery) {
                        echo "<script>alert('Message sent successfully');</script>";
                        exit();
                    } else {
                    echo "<script>alert('Failed to send message: " . mysqli_error($connection) . "');</script>";
                    } 
                } 
            ?>
        </form>
        </div>
</div>
    </div>
</body>
</html>