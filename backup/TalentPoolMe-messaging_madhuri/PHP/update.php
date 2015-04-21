<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
// Get a connection for the database
require_once('mysql_connect.php');
$profile = htmlspecialchars($_POST["profile"]);
$userName = htmlspecialchars($_POST["username"]);

if($profile == "company"){

	$type = htmlspecialchars($_POST["type"]);
	if($type == "account"){
		$email = htmlspecialchars($_POST["email"]);
		$oldpassword = htmlspecialchars($_POST["oldpassword"]);
		$newpassword = htmlspecialchars($_POST["newpassword"]);
		if($email!=NULL and $newpassword!=NULL){
			echo "inside1";
			$query = "select Password from Company where UserName='".$userName."'";

			$response = @mysqli_query($dbc, $query);
			if($response){


				$list = array();
				while($row = mysqli_fetch_array($response)){
					$hash = $row['Password'];	
				}
			}
			$options = [
    			'cost' => 12,
			];
			$hashedPassword = password_hash($oldpassword, PASSWORD_BCRYPT, $options);
			if(password_verify($oldpassword, $hash)){
				$hashedPassword = password_hash($newpassword, PASSWORD_BCRYPT, $options);
				$query = "UPDATE `TalentPM`.`Company` SET `CrypticPassword`='".$hashedPassword."',`Email`='".$email."' WHERE `UserName`='".$userName."'";
				$response = @mysqli_query($dbc, $query);
				if($response){
					echo "Email and password successfully updated";
				}
				
			}
			else{
				echo "wrong password entered";
			}
		}
		elseif ($newpassword!=NULL) {
		 	echo "inside2";
			$query = "select Password from Student where UserName='".$userName."'";

			$response = @mysqli_query($dbc, $query);
			if($response){


				$list = array();
				while($row = mysqli_fetch_array($response)){
					$hash = $row['Password'];	
				}
			}
			$options = [
    			'cost' => 12,
			];
			$hashedPassword = password_hash($oldpassword, PASSWORD_BCRYPT, $options);
			if(password_verify($oldpassword, $hash)){
				$hashedPassword = password_hash($newpassword, PASSWORD_BCRYPT, $options);
				$query = "UPDATE `TalentPM`.`Company` SET `CrypticPassword`='".$hashedPassword."' WHERE `UserName`='".$userName."'";
				$response = @mysqli_query($dbc, $query);
				if($response){
				echo "Password successfully updated";
				
			}
			else{
					echo "wrong password entered";
				}
			}
		}
		elseif($email!=NULL){
			$query = "UPDATE `TalentPM`.`Company` SET `email`='".$email."' WHERE `UserName`='".$userName."';";
			echo $query;
			$response = @mysqli_query($dbc, $query);
			if($response){
				echo "Email ID successfully updated";
			}	
		}

	}
	else{
		// Updating the company information
		//1) Industry2) Size3) Type4) Founded5) EVP
		$success = 0;
		$query = "select CID from Company where UserName='".$userName."'";

		$response = @mysqli_query($dbc, $query);
		if($response){


			$list = array();
			while($row = mysqli_fetch_array($response)){
				$CID = $row['CID'];	
			}
		}
		echo $CID;

		if((htmlspecialchars($_POST["industry"])) != NULL){
			// updating industry
			$industry = htmlspecialchars($_POST["industry"]);
			
			$query = "select IndusID from Industry where Name='".$industry."'";

			$response = @mysqli_query($dbc, $query);
			if($response){


				$list = array();
				while($row = mysqli_fetch_array($response)){
					$indusId = $row['IndusID'];	
				}
			}
			$query = "UPDATE `TalentPM`.`Company` SET `IndusID`='".$indusId."' WHERE `CID`='".$CID."'";
			$response = @mysqli_query($dbc, $query);
			if($response){
				$success = 1;
			}
		}		
		if((htmlspecialchars($_POST["ctype"])) != NULL){
			//updating company type
			$type = htmlspecialchars($_POST["ctype"]);
			$query = "select CTypeID from CompanyType where Name='".$type."'";

			$response = @mysqli_query($dbc, $query);
			if($response){


				$list = array();
				while($row = mysqli_fetch_array($response)){
					$cTypeId = $row['CTypeID'];	
				}
			}
			$query = "UPDATE `TalentPM`.`Company` SET `CTypeID`='".$cTypeId."' WHERE `CID`='".$CID."'";
			$response = @mysqli_query($dbc, $query);
			if($response){
				$success = 1;
			}
		}
		if((htmlspecialchars($_POST["foundedyear"])) != NULL){
			$foundedYear = htmlspecialchars($_POST["foundedyear"]);

			$query = "UPDATE `TalentPM`.`Company` SET `FoundedYear`='".$foundedYear."' WHERE `CID`='".$CID."'";
			$response = @mysqli_query($dbc, $query);
			if($response){
				$success = 1;
			}

		}
		if((htmlspecialchars($_POST["size"])) != NULL){
			$size = htmlspecialchars($_POST["size"]);

			$query = "UPDATE `TalentPM`.`Company` SET `Size`='".$size."' WHERE `CID`='".$CID."'";
			$response = @mysqli_query($dbc, $query);
			if($response){
				$success = 1;
			}

		}


		if($success == 1){
			echo "updated profile successfully";
		}
		else{
			echo "Error";
		}
	}
	
}
elseif($profile == "university"){
		$email = htmlspecialchars($_POST["email"]);
		$oldpassword = htmlspecialchars($_POST["oldpassword"]);
		$newpassword = htmlspecialchars($_POST["newpassword"]);
		$partner = htmlspecialchars($_POST["partner"]);
		
		
		$success = 0;
		if($newpassword != NULL){
			echo $newpassword;
			$query = "select Password from University where UserName='".$userName."'";

			$response = @mysqli_query($dbc, $query);
			if($response){


				$list = array();
				while($row = mysqli_fetch_array($response)){
					$hash = $row['Password'];	
				}
			}
		//	$options = [
    	//		'cost' => 12,
		//	];
			//$hashedPassword = password_hash($oldpassword, PASSWORD_BCRYPT, $options);
			$options = [
    		'cost' => 12,
			];
			$hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
			if (password_verify($oldpassword, $hash)) {
				echo "Password update working";
				$hashedPassword = password_hash($newpassword, PASSWORD_BCRYPT, $options);
				$query = "UPDATE `TalentPM`.`University` SET `Password`='".$hashedPassword."' WHERE `UserName`='".$userName."';";
				$response = @mysqli_query($dbc, $query);
				if($response){
					$success = 1;
				}
				
			}
			else{
				echo "wrong password entered";
			}
		}
		if($email != NULL){
			echo $email;
			$query = "UPDATE `TalentPM`.`University` SET `Email`='".$email."' WHERE `UserName`='".$userName."';";
			echo $query;

			$response = @mysqli_query($dbc, $query);
			if($response){
				$success = 1;
			}	
			else{
				echo "update failed";
			}
		}

		if($partner != NULL){
			echo $partner;
			$query = "UPDATE `TalentPM`.`University` SET `Partner`='".$partner."' WHERE `UserName`='".$userName."';";
			echo $query;

			$response = @mysqli_query($dbc, $query);
			if($response){
				$success = 1;
			}	
			else{
				echo "update failed";
			}
		}

		if($success == 1){
			echo "Profile updated successfully";
		}

}
elseif($profile == "student"){

	$type = htmlspecialchars($_POST["type"]);
	if($type == "account"){
		$success = 0;
		$email = htmlspecialchars($_POST["email"]);
		$oldpassword = htmlspecialchars($_POST["oldpassword"]);
		$newpassword = htmlspecialchars($_POST["newpassword"]);
		$query = "select StudentID from Student where UserName='".$userName."'";

		$response = @mysqli_query($dbc, $query);
		if($response){


			$list = array();
			while($row = mysqli_fetch_array($response)){
				$SID = $row['StudentID'];	
			}
		}

		if($newpassword!=NULL){
			$query = "select Password from Student where UserName='".$userName."'";

			$response = @mysqli_query($dbc, $query);
			if($response){


				$list = array();
				while($row = mysqli_fetch_array($response)){
					$hash = $row['Password'];	
				}
			}
			

			
			echo $oldpassword;
			echo $userName;
			echo $hash;
			//$hashedPassword = password_hash($oldpassword, PASSWORD_BCRYPT, $options);
			if (password_verify($oldpassword, $hash)) {
				echo "wrong password entered";
			}
			else{
				$hashedPassword = password_hash($newpassword, PASSWORD_BCRYPT, $options);
				$query = "UPDATE `TalentPM`.`Student` SET `Password`='".$hashedPassword."' WHERE `StudentID`='".$SID."'";
				$response = @mysqli_query($dbc, $query);
				if($response){
					$success = 1;
				}
			}
		}
		if($email!=NULL){
			$query = "UPDATE `TalentPM`.`Student` SET `Email`='".$email."' WHERE `StudentID`='".$SID."';";
			$response = @mysqli_query($dbc, $query);
			echo $query;
			if($response){
				echo "Email ID successfully updated";
			}	
		}

	}
	else{
		// Updating the Student information
		//1) Degree ) Size3) Type4) Founded5) EVP
		$success = 0;
		$query = "select StudentID from Student where UserName='".$userName."'";

		$response = @mysqli_query($dbc, $query);
		if($response){


			$list = array();
			while($row = mysqli_fetch_array($response)){
				$SID = $row['StudentID'];	
			}
		}

		if((htmlspecialchars($_POST["major"])) != NULL){
			// updating industry
			$major = htmlspecialchars($_POST["major"]);
			$degree = htmlspecialchars($_POST["degree"]);

			$query = "select MID from Major where Name='".$major."'";

			$response = @mysqli_query($dbc, $query);
			if($response){


				$list = array();
				while($row = mysqli_fetch_array($response)){
					$DID = $row['MID'];	
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

			$type =  htmlspecialchars($_POST["type"]);
			if($type == "update"){
				$query = "UPDATE `TalentPM`.`Student_Degree` SET `Major`='".$major."' WHERE `SID`='".$StudentID." and `DID` = '".$DID."';";
				$response = @mysqli_query($dbc, $query);
				if($response){
					$success = 1;
				}
			}

		}		



		if((htmlspecialchars($_POST["gpa"])) != NULL){
			//updating company type
			$gpa = htmlspecialchars($_POST["gpa"]);
			$degree = htmlspecialchars($_POST["degree"]);
			$query = "select DID from Degree where Name='".$degree."'";

			$response = @mysqli_query($dbc, $query);
			if($response){


				$list = array();
				while($row = mysqli_fetch_array($response)){
					$DID = $row['DID'];	
				}
			}
			$query = "UPDATE `TalentPM`.`Student_Degree` SET `GPA`='".$gpa."' WHERE `DID`='".$DID." and `SID` = '".$StudentID."';";
			$response = @mysqli_query($dbc, $query);
			if($response){
				$success = 1;
			}
		}
		if((htmlspecialchars($_POST["workexperience"]))!= NULL){
			$workexperience = htmlspecialchars($_POST["workexperience"]);
			$description = htmlspecialchars($_POST["description"]);
			$type = htmlspecialchars($_POST["type"]);

			if($type == update){
				//$expID = htmlspecialchars($_POST["experienceid"]);

				$query = "UPDATE `TalentPM`.`Experiences` SET `Description`='".$description."' WHERE `ExID`='".$workexperience."and `SID` = '".$StudentID."';";
				$response = @mysqli_query($dbc, $query);
				if($response){
					$success = 1;
				}
			}
			else{
				$query = "INSERT INTO `TalentPM`.`Experiences` (`StuID`, `Description`) VALUES ('".$StudentID."','".$description."')";
				$response = @mysqli_query($dbc, $query);
				if($response){
					$success = 1;
				}

			}

		}
		if((htmlspecialchars($_POST["skills"]))!= NULL){
			$skills = htmlspecialchars($_POST["skills"]);
			$query = "select SkillID from Degree where SkillName='".$skills."'";

			$response = @mysqli_query($dbc, $query);
			if($response){


				$list = array();
				while($row = mysqli_fetch_array($response)){
					$newskills = $row['SkillID'];	
				}
			}
			//$description = htmlspecialchars($_POST["description"]);
			$type = htmlspecialchars($_POST["type"]);

			if($type == "update"){

				$query = "UPDATE `TalentPM`.`Student_Skills` SET `SkillID`='".$newskills."' WHERE `StuID`='".$StudentID."and `SkillID` = '".$skills."';";
				$response = @mysqli_query($dbc, $query);
				if($response){
					$success = 1;
				}
			}
			else{
				$query = "INSERT INTO `TalentPM`.`Student_Skills` (`StuID`, `SkillID`) VALUES ('".$StudentID."','".$skills."')";
				$response = @mysqli_query($dbc, $query);
				if($response){
					$success = 1;
				}

			}

		}

		if($success == 1){
			echo "updated profile successfully";
		}
		else{
			echo "Error";
		}
	}
	
}
?>