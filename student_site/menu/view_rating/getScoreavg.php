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

$sql= "select food_id, round(avg(score)) from rating group by food_id";

$rating = $conn->query($sql);

$response=array();

if ($rating->num_rows > 0) {
    // output data of each row
    while($rol = $rating->fetch_assoc()) {
        array_push($response,array(
		"food_id"=>$rol["food_id"],
		"rating"=>$rol["round(avg(score))"]
		));
		
    }
}

else {
	$response=null;
}

echo(json_encode($response));




?>