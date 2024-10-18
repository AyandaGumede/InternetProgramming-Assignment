<?php include("DB_Connection.php"); ?>
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
// Start session
session_start();
include("DB_Connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: LogInForm.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$userEmail = $_SESSION['user_email'];

// Fetching user's first name and last name
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
$stmt->close(); 

// image upload
if (isset($_POST['saveProfile'])) {
    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'images/'.$file_name;

    if (!empty($file_name)) {
        if (move_uploaded_file($tempname, $folder)) {
            $query = mysqli_query($connection, "UPDATE syncup_users SET user_profile = '$file_name' WHERE users_id = $user_id");
            if (!$query) {
                echo "<script>alert('Error updating database: " . mysqli_error($connection).')'."</script>";
            }
        } else {
            echo "File not uploaded";
        }
    }
}
?>

<form action="homePage.php" method="POST" enctype="multipart/form-data">
    <h1>Welcome,<br> <?php echo htmlspecialchars($first_name . ' ' . $last_name); ?>.</h1>
    <button><a href="messages.php">Messages</a></button>

    <!-- - - - - - Profile - - - - - --> 
    <?php 
    $query = mysqli_query($connection, "SELECT user_profile FROM syncup_users WHERE users_id = $user_id");

    if (!$query) {
        echo "Error in SQL query: " . mysqli_error($connection);
        exit();
    }

    while ($row = mysqli_fetch_assoc($query)) {
        echo "<img src='images/" . $row['user_profile'] . "' alt='Profile Image' />";
    }
    ?>
    <input type="file" name="image" placeholder="set Profile"/>
    <br>
    <button type="submit" class="custom-upload-btn" name="saveProfile">Save Profile</button>
    <br><br>

    <!-- - - - - - Posting Area - - - - - --> 
    <textarea placeholder="Share Something....." name="user-post"></textarea>
    <?php
        if (isset($_POST["postBtn"])) {
            $postArea = $_POST["user-post"];
            
            if (empty($postArea)) {
                echo "<p class='error'>Please write something....*</p>";
            } else {
                if (isset($userEmail)) {
                    
                    $query = mysqli_query($connection, "INSERT INTO syncup_posts (user_id, user_email, post_content) VALUES ('$user_id', '$userEmail', '$postArea')");

                    if (!$query) {
                        echo "<script>alert('Error: " . mysqli_error($connection) . "');</script>";
                    } else {
                        echo "<script>alert('Posted successfully');</script>";
                    }
                } else {
                    echo "<script>alert('User email not set');</script>";
                }
            }
        }
    ?>

    <br>
    <button type="submit" name="postBtn">Post</button>

    <!-- - - - - User Posts - - - -  -->
    <h1>Your Posts</h1>
    <?php
    $sql = mysqli_query($connection, "SELECT post_content, post_date_time FROM syncup_posts WHERE user_id = '$user_id' ORDER BY post_date_time DESC");
    $row = mysqli_num_rows($sql);

    if ($row) { 
        while ($r = mysqli_fetch_array($sql)) {
            echo "<div class='user-posts'>";
                echo '<p>'.$r['post_content'] . "<br>".'</p>';
                echo "<p class='date'>". $r['post_date_time'] . "<br>"."</p>";
            echo "</div>";
        }
    } else {
        echo "No posts found.";
    }
    ?>

    <!-- Search Area -->
    <h1>Search Users</h1>
    <input type="text" placeholder="Search by name or email" name="user-search"/>
    <br>
    <button type="submit" name="search">Search</button>

   <!--  - - - - - - Search Results - - - - - - -  -->
    <?php 
        if (isset($_POST['search'])) {
            if (empty($_POST['user-search'])) {
                echo "<p class='error'>Please write something....*</p>";
            } else {
                $searchEmail = $_POST["user-search"];
                $sqlQuery = mysqli_query($connection, "SELECT first_name, last_name, email FROM syncup_users WHERE email = '$searchEmail' or first_name = '$searchEmail'");
                $row = mysqli_num_rows($sqlQuery);
                
                echo "<h1>Search Results</h1>";
                if ($row) {
                    $r = mysqli_fetch_array($sqlQuery);
                    $_SESSION['searched-user'] = $r['email'];
                    echo "<div class='result-area'>";
                        echo "<p><b>Name:</b> ".$r['first_name']." ".$r['last_name']."</p>";
                        echo "<br>";
                        echo "<p><b>Email:</b> ".$r['email']."</p>";
                        echo "<br>";
                        echo "<button name='viewProfile'>View Profile</button>";
                    echo "</div>";
                }
            }
        }
        
        if (isset($_POST["viewProfile"])) {
            header("Location: userProfile.php");
            exit();
        }
?>

</form>
</body>
</html>
