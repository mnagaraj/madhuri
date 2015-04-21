<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
// Get a connection for the database
require_once('mysql_connect.php');



$profile = htmlspecialchars($_POST["profile"]);

if($profile == "university"){
	$username = htmlspecialchars($_POST["username"]);
	if($university != NULL){
		$query = "select UID from university where UserName='".$username."'";
		echo $query;
		$response = @mysqli_query($dbc, $query);
		if($response){


			$list = array();
			while($row = mysqli_fetch_array($response)){
				$UID = $row['UID'];	
			}
			$query = "SELECT concat(FirstName,\" \",S.LastName) as Name, SD.UID FROM TalentPM.Student AS S, TalentPM.University AS U, TalentPM.Student_Degree AS SD
					  where (S.StudentID = SD.StuID and SD.UID = U.UID ) and `U.UID = '".$UID."';";
			echo $query;
			$response = @mysqli_query($dbc, $query);
			if($response){


				$list = array();
				while($row = mysqli_fetch_array($response)){
					$arrayrow = array();
					$arrayrow["name"] = $row['Name'];	
					array_push($list, $arrayrow);
				}
				echo $list;
			}
			else{
				echo mysqli_error($dbc);
			}
		}
		else{
			echo mysqli_error($dbc);
		}
	}
}
else if($profile == "talentpool"){
	$username = htmlspecialchars(_POST["username"]);
	$query = "select CID from Company where UserName='".$userName."'";

	$response = @mysqli_query($dbc, $query);
	if($response){


		$list = array();
		while($row = mysqli_fetch_array($response)){
			$CID = $row['CID'];	
		}
		$query = "select StudentID from TalentPM.TalentPool where CID ='".$CID."';";
		$response = @mysqli_query($dbc, $query);
		$list = array();
		if($response){
			while($row = mysqli_fetch_array($response)){
				
				$SID = $row['StudentID'];
				$query = "select CONCAT(FirstName," ",LastName) As Name, UserName from Student where StudentID = '".$SID."';";
				$response = mysqli_query($dbc, $query);
				if($response){
					while($rowforname = mysqli_fetch_array($response)){
						$arrayrow = array();
						$arrayrow["studentname"] = $rowforname["Name"];
						$arrayrow1["username"] = $rowforname["UserName"];
						array_push($list, $arrayrow);
						array_push($list, $arrayrow);
					}
					echo $list;
				}
				else{
					echo mysqsli_error($dbc);
				}
			}
		}
		else{
			echo mysqli_error($dbc);
		}
	}
	else{
		echo mysqli_error($dbc);
	}

}
elseif ($profile == "student") {
	$username = htmlspecialchars(_POST["username"]);
	$query = "select StudentID from Student where UserName='".$userName."'";

	$response = @mysqli_query($dbc, $query);
	if($response){


		$list = array();
		while($row = mysqli_fetch_array($response)){
			$SID = $row['StudentID'];	
		}
	}
	else{
		echo mysqli_error($dbc);
	}
}



// Close connection to the database
mysqli_close($dbc);


?>