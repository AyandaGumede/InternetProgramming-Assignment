<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SyncUp | user profile</title>
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
        margin-left: -90%;
        width: 8%;
        height: 40px;
        background-color: cadetblue;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
    }
    #back a{
            text-decoration: none;
            color: white;
            font-size: 13px;
        }
    .info-area{
        width: 45%;
        height: auto;
        margin-top: 0%;
        border: none;
        border-radius: 10px;
        background-color: white;
        font-family: "Helvetica Neue", Arial, sans-serif;
    }
    .details-area{
            width: 100%;
            height: 20vh;
            border: none;
            border-radius: 10px  10px 0px 0px; 
            background-color: grey;
        }
    img{
    width: 21.5%;
    height: 20vh;
    margin-top: 8%;
    margin-left: 7%;
    border: 8px solid white;
    border-radius: 50%;
    }
    h1{
        font-size: 45px;
        padding-left: 5%;
        margin-top: -1%;
        margin-bottom: -1.5%;
    }
    h2{
        font-size: 45px;
        padding-left: 5%;
    }
    h3{
        font-size: 15px;
        margin-top: -0.60%;
        padding-left: 5%;
        font-weight: lighter;
        font-style: italic;
        color: grey;
        margin-bottom: -0.20%;
    }
    button{
        width: 20%;
        height: 35px;
        background-color: cadetblue;
        margin-top: 20%;
        margin-left: 4%;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 13px;
    }
    button:hover{
        transform: scale(0.90);
    }
    #message{
        width: 20%;
        height: 35px;
        background-color: cadetblue;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        margin-left: -0.5%;
        font-size: 13px;
    }
    #message:hover{
        background-color: rgb(50, 84, 85);
    }
    #message a{
        color: white;
        text-decoration: none;
    }
    .user-posts{
    width: 88%;
    height: 85px;
    margin-top: 5%;
    margin-left: 3%;
    padding: 2%;
    margin-bottom: 5%;
    background: rgb(238, 238, 237);
    border: none;
    border-radius: 5px;
    box-shadow: 0 0px 4.5px 0px rgb(44, 44, 54);
    cursor: pointer;
}
.user-posts:hover{
    box-shadow: 0 0px 6px 0px rgb(0, 0, 0);
}
.user-posts p{
    font-size: 19px;
    font-family: 'Segoe UI';
    font-weight: lighter;
}
.user-posts .date{
    font-size: 16px;
}
.no-post{
    margin-left: 5%;
    margin-bottom: 5%;
}
    </style>
</head>
<body>
    <button id="back"><a href="homePage.php">Home</a></button>
    <div class="info-area">
        <?php
            include("DB_Connection.php");
            session_start(); 
            if (!isset($_SESSION['searched-user'])) {
                echo "No user selected!";
                exit();
            }

            $searchedUser = $_SESSION['searched-user'];
            $sqlQuery = mysqli_query($connection, "SELECT * FROM syncup_users WHERE email = '$searchedUser'");
            $r = mysqli_fetch_array($sqlQuery);
        ?>
        <!-- - - - - User Info Area - - - - -->
        <div class="details-area">
        <?php
            if ($r) {
                    echo "<img src='images/" . $r['user_profile'] . "' alt='No Profile' />";
                    echo "<h1>".$r['first_name']." ".$r['last_name']."</h1>";
                    echo "<br>";
                    echo "<h3>".$r['email']."</h3>";
                } 
        ?>
        </div>
        <br>
        <button id="follow" onclick="btnClick()">Follow</button>
        <button id="message"><a href="directMessages.php">Message</a></button>
        

    <!-- - - - - - - User Posts - - - - - - -  -->
        <h2>Posts</h2>
        <?php
        $sql = mysqli_query($connection, "SELECT post_content, post_date_time FROM syncup_posts WHERE user_email = '$searchedUser'");
        $row = mysqli_num_rows($sql);

        if ($row) { 
            while ($r = mysqli_fetch_array($sql)) {
                echo "<div class='user-posts'>";
                    echo '<p>'.$r['post_content'] . "<br>".'</p>';
                    echo "<p class='date'>". $r['post_date_time'] . "<br>"."</p>";
                echo "</div>";
            }
        } else {
            echo "<p class='no-post'>".$r['first_name']." has no posts!."."</p>";
        }
    ?>
    </div>

<script>
const followBtn =document.getElementById("follow");

function btnClick(){
    if(followBtn.textContent === 'Follow'){
        followBtn.textContent = 'Following';
        followBtn.style.backgroundColor = 'grey';
    }else{
        followBtn.textContent = 'Follow';
        followBtn.style.backgroundColor = 'cadetblue';
    }
}

</script>
</body>
</html>