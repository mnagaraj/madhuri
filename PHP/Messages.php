<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
// Get a connection for the database
require_once('mysql_connect.php');

$type = $_GET[type];  // whether to display the history of messages or add a new message
if(is_null($type) == false){
	$company = $_GET[company];
	$query = "select CID from Company where Name = '".$company."';";
	$response = @mysqli_query($dbc, $query);

	if($response){
		while($row = mysqli_fetch_array($response)){
			$company = $row["CID"];
		}
	}
	else{
		echo "something went wrong";
	}

	$student = $_GET[student];
	$query = "select StudentId from Student where UserName = '".$student."';";
	$response = @mysqli_query($dbc, $query);

	if($response){
		while($row = mysqli_fetch_array($response)){
			$student = $row["StudentId"];
		//echo $receiver;
		}
	}



	$query = "select CID, SID,CompanySent, MessageSubject, MessageContent,MessageTime from Messages ";
	$query.="where CID='".$company."' and SID='".$student."';";
	//echo $query;

	$response = @mysqli_query($dbc, $query);
	if($response){

// mysqli_fetch_array will return a row of data from the query
// until no further data is available

		$list = array();
		while($row = mysqli_fetch_array($response)){
			$arrayrow = array();
			$arrayrow["MID"]=$row["MID"];
			$arrayrow["companySent"] = $row["CompanySent"];
		//$arrayrow["CID"]=$row['CID'];
		
			$query = "select FirstName, LastName,UserName from Student where StudentId = '".$row['SID']."';";
			$response1 = @mysqli_query($dbc, $query);
			if(response1){
				while($row1 = mysqli_fetch_array($response1)){
					$arrayrow["StudentName"] = $row1['FirstName']." ".$row1['LastName'];
					$arrayrow["username"] = $row1['UserName'];
				}
			}
		
			$query = "select Name from Company where CID = '".$row['CID']."';";
		//echo $query;
			$response1 = @mysqli_query($dbc, $query);
			if(response1){
				while($row1 = mysqli_fetch_array($response1)){
					$arrayrow["CompanyName"] = $row1['Name'];
				}
			}else {

				echo "Couldn't issue database query<br />";

				echo mysqli_error($dbc);

			}
		

			$arrayrow["subject"]=$row['MessageSubject'];
			$arrayrow["content"]=$row['MessageContent'];
			array_push($list, $arrayrow);
		}

	

	$jsonList = json_encode($list);
	echo $jsonList;

	} else {

		echo "Couldn't issue database query<br />";

		echo mysqli_error($dbc);

	}
}
else{
	$subject = htmlspecialchars($_POST["subject"]);
	$content = htmlspecialchars($_POST["content"]);
	$companySent = htmlspecialchars($_POST["companysent"]);
	$company = htmlspecialchars($_POST["company"]);
	$student = htmlspecialchars($_POST["student"]);
	$query = "select StudentId from Student where UserName = '".$student."';";
	echo $query;
	$response = @mysqli_query($dbc, $query);

	if($response){
		while($row = mysqli_fetch_array($response)){
			$student = $row["StudentId"];
		}
	}
	else{
		echo "something went wrong";
	}
//echo $sender;
	$query = "select CID from Company where Name = '".$company."';";
	echo $query;
	$response = @mysqli_query($dbc, $query);

	if($response){
		while($row = mysqli_fetch_array($response)){
			$company = $row["CID"];
		}
	}
	else{
		echo "something went wrong";
	}
	

	$query = "INSERT INTO `TalentPM`.`Messages` ( `CID`, `SID`,`CompanySent`, `MessageSubject`, `MessageContent`) VALUES ('".$company. "','".$student."','".$companySent."','".$subject."','".$content."');";
	echo $query;
	$response = @mysqli_query($dbc, $query);
	if($response)
		echo "well done";
	else
		echo "something went wrong";
}

// Close connection to the database
mysqli_close($dbc);


?>