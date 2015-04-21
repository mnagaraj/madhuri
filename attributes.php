<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once('mysql_connect.php');


$query = "Select Name from States;";

$response = @mysqli_query($dbc,$query);
$attributes = array();

if($response){
	$states = array();
	while($row = mysqli_fetch_array($response)){
		$newState = array();
		$newState["value"] = $row["Name"];
		array_push($states, $newState);
	}
	//array_push($attributes,$states);
	$attributes["states"] = $states;

}
else{
	echo (mysqli_error($dbc));
}

$query = "Select Name from Industry";

$response = @mysqli_query($dbc, $query);
if($response){
	$industry = array();
	while($row = mysqli_fetch_array($response)){
		$newIndustry = array();
		$newIndustry["value"] = $row["Name"];
		array_push($industry, $newIndustry);
	}
	$attributes["industries"] = $industry; 
}
else{
	echo (mysqli_error($dbc));
}


$query = "Select Name, Size from CompanySize";

$response = @mysqli_query($dbc, $query);

if($response){
	$sizes = array();
	while($row = mysqli_fetch_array($response)){
		$newSize = array();
		$newSize["value"] = $row["Name"];
		$newSize["display"] = $row["Size"];
		array_push($sizes, $newSize);
	}
	$attributes["sizes"] = $sizes;
}
else{
	exit(mysqli_error($dbc));
}
$query = "Select Type from CompanyType;";

$response = @mysqli_query($dbc, $query);

if($response){
	$types = array();
	while($row = mysqli_fetch_array($response)){
		$newType = array();
		$newType["value"] = $row["Type"];
	//	$newTy["display"] = $row["Size"];
		array_push($types, $newType);
	}
	$attributes["types"] = $types;
}
else{
	echo (mysqli_error($dbc));
}


$query = "Select Value from years;";

$response = @mysqli_query($dbc, $query);

if($response){
	$years = array();
	while($row = mysqli_fetch_array($response)){
		$newYear = array();
		$newYear["value"] = $row["Value"];
	//	$newTy["display"] = $row["Size"];
		array_push($years, $newYear);
	}
	$attributes["years"] = $years;
}
else{
	echo (mysqli_error($dbc));
}
$jsonList = json_encode($attributes);
echo $jsonList;


?>