<?php
header('Content-Type: application/json');

function sqlGenByhr($date,$hr){
	$sql = "select count(*),time_hour,consumptionLocation,mealtype ";
	$sql = $sql."from v_hour ";
	$sql = $sql."where consumeTime like '".$date."%' and mealtype='breakfast' and time_hour=".$hr ;
	$sql = $sql." group by time_hour, consumptionLocation";
	$sql = $sql." order by consumptionLocation,time_hour";
	return $sql;
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

$sql = sqlGenByhr($_GET["date"],$_GET["hr"]);//7,8,9
$data = $conn->query($sql);

$response=array(
"id"=>$_GET["hr"]-7,
"data"=> array()
);
$rc=array('CKLC', 'CKPC', 'CKYC', 'CYTC', 'FPJC', 'LCWC', 'MCMC', 'MLC', 'SEAC', 'SPC');

$datahold=array();

if ($data->num_rows > 0) {
	while($rol=$data->fetch_assoc()){
		array_push($datahold, $rol);
	}
	
	
	for ($i=0;$i<count($rc);$i++){
		$found = False;
		for($j=0;$j<count($datahold);$j++){
			if($rc[$i]== $datahold[$j]["consumptionLocation"]){
				array_push($response["data"],(int)$datahold[$j]["count(*)"]);
				$found = True;
				break;
			}
		}
		
		if ($found == False){
			array_push($response["data"],0);
		}
	}
}
		

echo(json_encode($response));
?>