<?php

header('Content-Type: application/json');
$opts = array(
	'http'=>array(
		'method'=>"GET",
		'header'=>"Accept: application/json\r\nAuthorization: Bearer 96d06477-5826-3bf7-9d67-d290a2df0040"
	)
);
$context = stream_context_create($opts);

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

echo('db connected');

for ($i=1;$i<=100;$i++){
	$url = "https://api.data.umac.mo/service/student/student_meal_consumption/v1.0.0/all?page=".$i;
	$file = file_get_contents($url, false, $context);
	$decoded = json_decode($file);
	$meal=$decoded->_embedded;
	
	for($j=0; $j<count($meal); $j++){
		$apiId = $meal[$j]->_id;
		$rcMember = $meal[$j]->rcMember;
		$consumeTime = $meal[$j]->consumeTime;
		$consumptionLocation = $meal[$j]->consumptionLocation;
		$mealType = $meal[$j]->mealType;
		$sql = "INSERT INTO datafromapi(apiId,rcMember,consumeTime,consumptionLocation,mealType)values('$apiId','$rcMember','$consumeTime','$consumptionLocation','$mealType')";
		$conn->query($sql);
	}
	echo ("finish '$i'");
}
