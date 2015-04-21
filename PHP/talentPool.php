<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once('mysql_connect.php');
$inputs = array();

$inputs["CompanyName"] = $_GET["CompanyName"];
$inputs["StudentUserName"] = $_GET["StudentUserName"];
//Get the ID of a particular student
$queryForSID = "select StudentId from Student where UserName = '".$inputs["StudentUserName"]."' ;";
//Get the ID of a particular company
$queryForCID = "select CID from Company where Name = '".$inputs["CompanyName"]."' ;";

// Query to get ID of the student
$response = @mysqli_query($dbc, $queryForSID);

if($response){
	while($row = mysqli_fetch_array($response)){
		$inputs["StudentId"] = $row["StudentId"]; 
		//echo $inputs["StudentId"];
	}
	$response = @mysqli_query($dbc, $queryForCID);

	if($response){
		while($row = mysqli_fetch_array($response)){
			$inputs["CID"] = $row["CID"]; 
			//echo $inputs["CID"];
		}
		$query = "select TPID FROM TalentPM.TalentPool where CID= ".$inputs["CID"]." AND StudentId= ".$inputs["StudentId"].";"; 
		//echo $query;
		$response = @mysqli_query($dbc, $query);
		if($response){
			$present = 0;
			while ($row = mysqli_fetch_array($response)) {
				$present = 1;
			}
			if($present == 1){
				echo "Already in the talent pool";
			}
			else{
				$query = "INSERT INTO `TalentPM`.`TalentPool` (`CID`, `StudentId`) VALUES ('" . $inputs["CID"] . "', '" . $inputs["StudentId"] . "')";
//echo $query;
				$response = @mysqli_query($dbc, $query);

				if($response){
					echo "true";
				}
				else{
					echo "false";
				}
			}
		}
		
	}
	else{
		echo ("Wrong company name");
	}
}
else
{
	exit("Wrong Student User Name");
}




	
?>
