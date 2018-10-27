<meta http-equiv="refresh" content="0;URL=set_menu.php" />
<?php
//db setting
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "h-umdata";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id=$_POST["id"];

$sql = "delete from todaymenu where id='$id'";

$conn->query($sql);


?>