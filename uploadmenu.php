<meta http-equiv="refresh" content="0;URL=set_menu.php" />
<?php

$target_dir = "fdphoto/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}

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

$photo = $target_file;
$name = $_POST["name"];
$ingredient = $_POST["ingredient"];

$sql = "INSERT INTO todaymenu (photo,name,ingredient)values ('$photo','$name','$ingredient')";
echo($sql);

$conn->query($sql);

?>