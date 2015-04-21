<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
// Get a connection for the database
require_once('mysql_connect.php');

$type = $_GET[type];  // whether to display the history of messages or add a new message
$sender = $_GET[From];
//echo $sender;
if(is_null($type) == false){

	$query = "select StudentId from Student where UserName = '".$sender."';";
	$response = @mysqli_query($dbc, $query);

	if($response){
		while($row = mysqli_fetch_array($response)){
			$sender = $row["StudentId"];
		}
	}
	else{
		echo "something went wrong";
	}
//echo $sender;
	$receiver = $_GET[To];
	$query = "select StudentId from Student where UserName = '".$receiver."';";
	$response = @mysqli_query($dbc, $query);

	if($response){
		while($row = mysqli_fetch_array($response)){
			$receiver = $row["StudentId"];
		}
	}

	
		$query = "select MID,Sender, Receiver,MessageSubject, MessageContent,MessageTime from Message_Talent ";
		$query.="where (Sender='".$sender."' and Receiver='".$receiver."')OR (Sender='".$receiver."' and Receiver='".$sender."') order by MessageTime;";
	
	$response = @mysqli_query($dbc, $query);
	if($response){

	$list = array();
	while($row = mysqli_fetch_array($response)){
		$arrayrow = array();
		$arrayrow["MID"]=$row["MID"];
		//$arrayrow["From"]=$row['Sender'];
		//$arrayrow["To"]=$row['Receiver'];
		$query = "select FirstName, LastName,UserName from Student where StudentId = '".$row['Sender']."';";
		$response1 = @mysqli_query($dbc, $query);
		if(response1){
			while($row1 = mysqli_fetch_array($response1)){
				$arrayrow["From"] = $row1['FirstName']." ".$row1['LastName'];
				$arrayrow["From_username"] = $row1['UserName'];
			}
		}
		$query = "select FirstName, LastName, UserName from Student where StudentId = '".$row['Receiver']."';";
		$response2 = @mysqli_query($dbc, $query);
		if(response2){
			while($row2 = mysqli_fetch_array($response2)){
				$arrayrow["To"] = $row2['FirstName']." ".$row2['LastName'];
				$arrayrow["To_username"] = $row2['UserName'];
			}
		}
		$arrayrow["messageTime"] = $row['MessageTime'];	
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
	$from = htmlspecialchars($_POST["from"]);
	$to = htmlspecialchars($_POST["to"]);
	$query = "select StudentId from Student where UserName = '".$from."';";
	echo $query;
	$response = @mysqli_query($dbc, $query);

	if($response){
		while($row = mysqli_fetch_array($response)){
			$from = $row["StudentId"];
		}
	}
	else{
		echo "something went wrong";
	}
//echo $sender;
	
	$query = "select StudentId from Student where UserName = '".$to."';";
	echo $query;
	$response = @mysqli_query($dbc, $query);

	if($response){
		while($row = mysqli_fetch_array($response)){
			$to = $row["StudentId"];
		}
	}

	$query = "INSERT INTO `TalentPM`.`Message_Talent` ( `Sender`, `Receiver`, `MessageSubject`, `MessageContent`) VALUES ('".$from. "','".$to."','".$subject."','".$content."');";
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