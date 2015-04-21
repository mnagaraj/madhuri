<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once('mysql_connect.php');
//$password = $_GET[password];
$profile = htmlspecialchars($_POST["profile"]);
$userName = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["password"]);
$type = htmlspecialchars($_POST["type"]);
//echo $type;
if($profile == "student"){
	if ($type == "login") {

		$query = "select Password from Student where UserName='".$userName."'";

		$response = @mysqli_query($dbc, $query);
		if($response){


			$list = array();
			while($row = mysqli_fetch_array($response)){
				$hash = $row['Password'];	
			}
		}
		else{
			echo "query failed";
		}

		if (password_verify($password, $hash)) {
    		echo 'Password is valid!';
		} else {
    		echo 'Invalid password.';
		}
	}
	else{
		$firstName =  htmlspecialchars($_POST["firstname"]);
		$lastName =  htmlspecialchars($_POST["lastname"]);
		$email =  htmlspecialchars($_POST["email"]);
		$userName = htmlspecialchars($_POST["username"]);
		$password =  htmlspecialchars($_POST["password"]);
		$university = htmlspecialchars($_POST["university"]);
		$degree = htmlspecialchars($_POST["degree"]);

		$query = "select UID from University where Name='".$university."'";

		$response = @mysqli_query($dbc, $query);
		if($response){


			$list = array();
			while($row = mysqli_fetch_array($response)){
				$UID = $row['UID'];	
			}
		}
			
		$query = "select DID from Degree where Name='".$degree."'";

		$response = @mysqli_query($dbc, $query);
		if($response){


			$list = array();
			while($row = mysqli_fetch_array($response)){
				$DID = $row['DID'];	
			}
		}

		$options = [
    	'cost' => 12,
		];
		$hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
		$query = "select UserName from Student";
		$response = @mysqli_query($dbc, $query);
		$duplicate = 0;
		while($row = mysqli_fetch_array($response)){
			if($userName == $row['UserName']){
				$duplicate = 1;	
				break;
			}
		}
		if($duplicate == 1){
			echo "Username already exists";
		}
		else{
			$query = "INSERT INTO `TalentPM`.`Student` (`FirstName`, `LastName`,`Email`,`UserName`, `Password`) VALUES ('".$firstName."','".$lastName."','".$email."','".$userName."','".$hashedPassword."');";
	//echo $query;
			$response = @mysqli_query($dbc, $query);
			if($response){
				$query = "select StudentID from Student where UserName='".$userName."'";

				$response = @mysqli_query($dbc, $query);
				if($response){
					while($row = mysqli_fetch_array($response)){
					$SID = $row['StudentID'];	
					}
				}
				$query = "INSERT INTO `TalentPM`.`Student_Degree` (`UID`, `DID`, `StuID`) VALUES ('".$UID."','".$DID."','".$SID."')";
				$response = @mysqli_query($dbc, $query);
				if($response) 
					echo "success";
				else
					echo mysqli_error($dbc);
			}
			else{
				//echo "65";
				echo mysqli_error($dbc);
				//echo "failure";
			}
		}
	}
}
elseif($profile == "company"){
	//echo $type;
	if ($type == "login") {
		$query = "select Password from Company where UserName='".$userName."'";

		$response = @mysqli_query($dbc, $query);
		if($response){


			$list = array();
			while($row = mysqli_fetch_array($response)){
				$hash = $row['Password'];	
			}
		}
		else{
			echo "query failed";
		}

		if (password_verify($password, $hash)) {
    		echo 'Password is valid!';
		} else {
    		echo 'Invalid password.';
		}
	}
	else{
		$industry =  htmlspecialchars($_POST["industry"]);
		$type =  htmlspecialchars($_POST["ctype"]);
		$size =  htmlspecialchars($_POST["size"]);
		$name = htmlspecialchars($_POST["name"]);
		$email = htmlspecialchars($_POST["email"]);
		$userName = htmlspecialchars($_POST["username"]);
		$password =  htmlspecialchars($_POST["password"]);
		$companyUrl = htmlspecialchars($_POST["companyurl"]);
		$foundedYear = htmlspecialchars($_POST["year"]);
		$query = "select CTypeID from CompanyType where Type='".$type."';";
		//echo $query;
		$response = @mysqli_query($dbc, $query);
		if($response){


			$list = array();
			while($row = mysqli_fetch_array($response)){
				$cTypeId = $row['CTypeID'];	
			}
		}
		$query = "select IndusID from Industry where Name='".$industry."'";

		$response = @mysqli_query($dbc, $query);
		if($response){


			$list = array();
			while($row = mysqli_fetch_array($response)){
				$indusId = $row['IndusID'];	
			}
		}

		$options = [
    	'cost' => 12,
		];
		$hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
		$query = "select UserName from Company";
		$response = @mysqli_query($dbc, $query);
		$duplicate = 0;
		while($row = mysqli_fetch_array($response)){
			if($userName == $row['UserName']){
				$duplicate = 1;	
				break;
			}
		}
		if($duplicate == 1){
			echo "Username already exists";
		}
		else{
			$query = "INSERT INTO `TalentPM`.`Company` (`Name`, `IndusID`,`CTypeID`,`Size`,`CompanyURL`,`Username`,`Password`,`Email`,`FoundedYear`) VALUES ('".$name."','".$indusId."','".$cTypeId."','".$size."','".$companyUrl."','".$userName."','".$hashedPassword."','".$email."','".$foundedYear."');";
	//echo $query;
			//echo $query;
			$response = @mysqli_query($dbc, $query);
			if($response){
				echo "success";
			}
			else{
				//echo "153";
				echo mysqli_error($dbc);
				//echo "failure";
			}
		}
	}
}
elseif($profile=="university"){
	//echo $type;
	if ($type == "login") {
		$query = "select Password from University where UserName='".$userName."'";

		$response = @mysqli_query($dbc, $query);
		if($response){


			$list = array();
			while($row = mysqli_fetch_array($response)){
				$hash = $row['Password'];	
			}
		}
		else{
			echo "query failed";
		}
		//echo $hash;
		//echo $password;
		if (password_verify($password, $hash)) {
    		echo 'Password is valid!';
		} else {
    		echo 'Invalid password.';
		}
	}
	else{
		$name =  htmlspecialchars($_POST["name"]);
		$email =  htmlspecialchars($_POST["email"]);
		$userName = htmlspecialchars($_POST["username"]);
		$password =  htmlspecialchars($_POST["password"]);
		$options = [
    	'cost' => 12,
		];
		$hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
		$query = "select UserName from Student";
		$response = @mysqli_query($dbc, $query);
		$duplicate = 0;
		while($row = mysqli_fetch_array($response)){
			if($userName == $row['UserName']){
				$duplicate = 1;	
				break;
			}
		}
		if($duplicate == 1){
			echo "Username already exists";
		}
		else{
			$query = "INSERT INTO `TalentPM`.`University` (`Name`,`Email`,`UserName`, `Password`) VALUES ('".$name."','".$email."','".$userName."','".$hashedPassword."');";
	//echo $query;
			$response = @mysqli_query($dbc, $query);
			if($response){
				echo "success";
			}
			else{
				echo mysqli_error($dbc);
				echo "failure";
			}
		}
	}
}
?>