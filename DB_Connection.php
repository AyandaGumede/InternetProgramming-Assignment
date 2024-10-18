<?php
$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "syncup";

try {
    $connection = mysqli_connect($db_server, $db_user, "", $db_name);
} catch (mysqli_sql_exception) {
    echo "<script>window.alert(Could not connect)</script>;";
}
?>
