<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="HomePage.css">
    <title>SyncUp | Home Page</title>
</head>
<body>
<?php
//Session start
session_start();
//DB included
include("DB_Connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: LogInForm.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT first_name, last_name FROM syncup_users WHERE users_id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($first_name, $last_name);
$result = $stmt->fetch(); 

if (!$result) {
    echo "<script>window.alert('User not found. Please log in again.');</script>";
    header("Location: LogInForm.php");
    exit();
}
//Profile Save
//Post save
if(isset($_POST["postBtn"])){
    $postArea = $_POST["user-post"];
    if(empty($postArea)){
        echo "<script>window.alert('Please write something!')</script>";
    }else{
        $userPost = $postArea;
    }
}


$stmt->close();
$connection->close();
?>

    
    <form action="homePage.php" method="POST" enctype="multipart/form-data">
        <h1>Welcome,<br> <?php echo htmlspecialchars($first_name . ' ' . $last_name); ?>.</h1>
        <button><a href="messages.php">Messages</a></button>
        <button type="button" class="custom-upload-btn" onclick="document.getElementById('uploadProfile').click();">
            Change Profile
        </button>
        <br>
        <!--  - - - - - - Default Profile Photo - - - - - -->
        <img src="Libra-core.png" alt="Profile" id="profile" width="150" height="150"/>
        <br>
        <input type="file" id="uploadProfile" accept="image/*" onchange="ChangeProfile()" style="display: none;" />
        <textarea placeholder="Share Something....." name="user-post"></textarea>
        <br>
        <button type="submit" name="postBtn">Post</button>
        <!-- - - - - - - User Posts - - - - - - - - - -->
        <h1>Your Posts</h1>
            <div class="user-posts">
                <p><?php echo $userPost;?></p>
            </div>
        <h1>Search Users</h1>
        <input type="text" placeholder="Search by name or email"/>
        <br>
        <!-- - - - - Search Area - - - - - - - --> 
        <button type="submit">Search</button>
        <h1>Search Results</h1>
    </form>

    <script src="homePage.js"></script>
</body>
</html>
