<?php
header('Content-Type: application/json');

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

$sql= "select food_id,round(avg(rate)) from rating group by food_id";

$scores = $conn->query($sql);

$response=array();

if ($menu->num_rows > 0) {
    // output data of each row
    while($rol = $menu->fetch_assoc()) {
        array_push($response,array(
		"photo"=>$rol["photo"],
		"name"=>$rol["name"],
		"ingredient"=>$rol["ingredient"]));
		
    }
}

else {
	$response=null;
}

echo(json_encode($response));




?>