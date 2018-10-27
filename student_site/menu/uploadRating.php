<meta http-equiv="refresh" content="0;URL=./firstpage.html" />
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

$score = $_GET["score"];
$id = $_GET["id"];

$sql = "INSERT INTO rating (food_id,score)values ('$id','$score')";
$conn -> query($sql);

?>
