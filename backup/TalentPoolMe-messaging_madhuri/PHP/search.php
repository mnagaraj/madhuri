<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
// Get a connection for the database
require_once('mysql_connect.php');



$profile = htmlspecialchars($_POST["profile"]);

if($profile == "universitystudents"){
	$username = htmlspecialchars($_POST["username"]);

	if($username != NULL){
		$query = "select UID from University where UserName='".$username."'";
		echo $query;
		$response = @mysqli_query($dbc, $query);
		if($response){


			$list = array();
			while($row = mysqli_fetch_array($response)){
				$UID = $row['UID'];	
			}
			$query = "SELECT concat(FirstName,LastName) as Name, S.UserName As UserName FROM TalentPM.Student AS S, TalentPM.University AS U, TalentPM.Student_Degree AS SD
					  where (S.StudentID = SD.StuID and SD.UID = U.UID ) and U.UID = '".$UID."';";
			//echo $query;
			$response = @mysqli_query($dbc, $query);
			if($response){


				$list = array();
				while($row = mysqli_fetch_array($response)){
					$arrayrow = array();
					$arrayrow["name"] = $row['Name'];	
					$arrayrow["username"] = $row['UserName'];
					array_push($list, $arrayrow);
				}
				$jsonList = json_encode($list);
				echo $jsonList;
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
else if($profile == "university"){
	$username = htmlspecialchars($_POST["username"]);

	if($username != NULL){
		$query = "select UID from University where UserName='".$username."'";
		// /echo $query;
		$response = @mysqli_query($dbc, $query);
		if($response){


			$list = array();
			while($row = mysqli_fetch_array($response)){
				$UID = $row['UID'];	
			}
		//	$query = "SELECT concat(FirstName,LastName) as Name, S.UserName As UserName FROM TalentPM.Student AS S, TalentPM.University AS U, TalentPM.Student_Degree AS SD
			//		  where (S.StudentID = SD.StuID and SD.UID = U.UID ) and U.UID = '".$UID."';";
			//echo $query;
			$query = "Select Name, Email, Image from University where `UID` = '".$UID."';";

			$response = @mysqli_query($dbc, $query);
			if($response){


				$list = array();
				while($row = mysqli_fetch_array($response)){
				//	$arrayrow = array();
					$list["name"] = $row['Name'];	
					$list["email"] = $row['Email'];
					$list["image"] = $row['Image'];
					//array_push($list, $arrayrow);
				}
				$jsonList = json_encode($list);
				echo $jsonList;
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
	$username = htmlspecialchars($_POST["username"]);
	$query = "select CID from Company where UserName='".$username."'";

	$response = @mysqli_query($dbc, $query);
	if($response){


		$list = array();
		while($row = mysqli_fetch_array($response)){
			$CID = $row['CID'];	
		}
		$query = "select StudentID from TalentPM.TalentPool where CID ='".$CID."';";
		echo $query;
		$response = @mysqli_query($dbc, $query);
		
		if($response){
			while($row = mysqli_fetch_array($response)){
				$list = array();
				$SID = $row['StudentID'];
				$query = "select Distinct CONCAT(FirstName,\" \",LastName) As Name, UserName from Student where StudentID = '".$SID."';";
				$response1 = mysqli_query($dbc, $query);
				if($response1){
					while($rowforname = mysqli_fetch_array($response1)){
						$arrayrow = array();
						$arrayrow["studentname"] = $rowforname["Name"];
						$arrayrow1["username"] = $rowforname["UserName"];
						array_push($list, $arrayrow);
						array_push($list, $arrayrow1);
					}
					echo json_encode($list);

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
	$username = htmlspecialchars($_POST["username"]);
	$query = "select StudentID from Student where UserName='".$username."'";

	$response = @mysqli_query($dbc, $query);
	if($response){


		$list = array();
		$present = 0;
		while($row = mysqli_fetch_array($response)){
			$SID = $row['StudentID'];
			$present = 1;	
		}
		if($present == 1){
			$query = "SELECT Student.UserName As UserName, Student.Email As Email, University.Name As University, Degree.Name As Degree, Student_Degree.GPA as Gpa, Student_Degree.GraduationYear as Year, Major.Name as Major  FROM TalentPM.Student, University, Student_Degree, Degree, Major
					where Student.StudentID = Student_Degree.StuID and Student_Degree.UID = University.UID and Student_Degree.DID = Degree.DID and Student_Degree.Major = Major.MID and Student.StudentID = '".$SID."';";	
			//		echo $query;
		//	echo $query;
			$response = @mysqli_query($dbc, $query);
			$list = array();
			if($response){
				while($row = mysqli_fetch_array($response)){
					$arrayrow = array();
					$list["username"] = $row["UserName"];
					$list["university"] = $row["University"];
					$list["degree"] = $row["Degree"];
					$list["email"] = $row["Email"];
					$list["gpa"] = $row["Gpa"];
					$list["graduationyear"] = $row["Year"];
					$list["major"] = $row["Major"];
					//$list[""]
					//array_push($list, $arrayrow);
				}
				//$query = "Select "
				echo json_encode($list);
			}
			else{
				echo mysqli_error($dbc);
			}
		}
		else{
			echo "No Student found with username ".$username;
		}
	}
	else{
		echo mysqli_error($dbc);
	}
}
elseif ($profile == "company") {
	$username = htmlspecialchars($_POST["username"]);

	$query = "SELECT Company.CID AS CID,UserName,ImageUrl from Company, CompanyImages where Company.CID=CompanyImages.CID and Company.UserName = '".$username."';";	
	$response = @mysqli_query($dbc, $query);
	$list = array();
	//echo $query;
	if($response){
		
		while($row = mysqli_fetch_array($response)){
			$arrayrow = array();
			$list["username"] = $row["UserName"];
			$list["image"] = $row["ImageUrl"];
			//echo $arrayrow;
		//	array_push($list,$arrayrow);
		}
		
		
	}
	else{
		echo mysqli_error($dbc);
	}

	$query = "SELECT Name,IndusID, CTypeID, Size, CompanyURL,UserName,Partner, Email, FoundedYear from Company where Company.UserName = '".$username."';";
	$response = @mysqli_query($dbc, $query);
	// /$list = array();
//	echo $query;
	if($response){
		$arrayrow = array();
		while($row = mysqli_fetch_array($response)){

			$list["name"] = $row["Name"];
			$list["size"] = $row["Size"];
			$list["companyurl"] = $row["CompanyURL"];
			$list["email"] = $row["Email"];

			$query1 = "SELECT Name from Industry where IndusID ='".$row["IndusID"]."';";
			$response1 = @mysqli_query($dbc, $query1);

			if($response1){
				while($row1 = mysqli_fetch_array($response1)){
					//$arrayrow = array();
					$list["industry"] = $row1["Name"];

				}
			}

			$query1 = "SELECT Type from CompanyType where CTypeID ='".$row["CTypeID"]."';";
			$response1 = @mysqli_query($dbc, $query1);

			if($response1){
				while($row1 = mysqli_fetch_array($response1)){
					//$arrayrow = array();
					$list["type"] = $row1["Type"];
				}
			}

			//echo $arrayrow;
			//array_push($list,$arrayrow);
		}
		
		
	}
	else{
		echo mysqli_error($dbc);
	}



	$query = "SELECT Company.CID AS CID,UserName,PID from Company, CompanyPerks where Company.CID=CompanyPerks.CID and Company.UserName = '".$username."';";	
	$response = @mysqli_query($dbc, $query);
//	echo $query;
	if($response){
		while($row = mysqli_fetch_array($response)){
			$query1 = "SELECT Description from Perks where PID ='".$row["PID"]."';";
			$response1 = @mysqli_query($dbc, $query1);

			if($response1){
				while($row1 = mysqli_fetch_array($response1)){
					$arrayrow = array();
					$list["Perk"] = $row1["Description"];
					//array_push($list, $arrayrow);
				}
			}
		}
	}


	$query = "SELECT Company.CID AS CID, City,State from Company, CompanyLocation where Company.CID=CompanyLocation.CID and Company.UserName = '".$username."';";	
	$response = @mysqli_query($dbc, $query);
//	echo $query;
//	$list = array();
	//echo $query;
	if($response){
		
		while($row = mysqli_fetch_array($response)){
			$arrayrow = array();
			//$arrayrow["username"] = $row["UserName"];
			$list["city"] = $row["City"];
			$list["state"] = $row["State"];
			//echo $arrayrow;
			
		}
		
	//	array_push($list,$arrayrow);
	}
	else{
		echo mysqli_error($dbc);
	}


	$query = "SELECT Company.CID AS CID,UserName,EVPID from Company, CompanyEVP where Company.CID=CompanyEVP.CID and Company.UserName = '".$username."';";	
	$response = @mysqli_query($dbc, $query);
//	echo $query;
	if($response){
		while($row = mysqli_fetch_array($response)){
			$query1 = "SELECT Description from EVP where EVPID ='".$row["EVPID"]."';";
			$response1 = @mysqli_query($dbc, $query1);

			if($response1){
				while($row1 = mysqli_fetch_array($response1)){
					$arrayrow = array();
					$list["evp"] = $row1["Description"];
					//array_push($list, $arrayrow);
				}
			}
		}
	}


	$jsonList = json_encode($list);
	echo $jsonList;
}
elseif($profile == "all"){

	$query = "SELECT Name,IndusID, CTypeID, Size, CompanyURL,UserName,Partner, Email, FoundedYear from Company ;";
	$mainresponse = @mysqli_query($dbc, $query);
	$usrename = "";
	$list = array();
//	echo $query;
	if($response){
		$arrayrow = array();
		while($row = mysqli_fetch_array($mainresponse)){

			$arrayrow["name"] = $row["Name"];
			$arrayrow["size"] = $row["Size"];
			$arrayrow["companyurl"] = $row["CompanyURL"];
			$arrayrow["email"] = $row["Email"];
			$arrayrow["username"] = $row["UserName"];
			$username = $arrayrow["username"];

			$query1 = "SELECT Name from Industry where IndusID ='".$row["IndusID"]."';";
			$response1 = @mysqli_query($dbc, $query1);

			if($response1){
				while($row1 = mysqli_fetch_array($response1)){
					//$arrayrow = array();
					$arrayrow["industry"] = $row1["Name"];

				}
			}

			$query1 = "SELECT Type from CompanyType where CTypeID ='".$row["CTypeID"]."';";
			$response1 = @mysqli_query($dbc, $query1);

			if($response1){
				while($row1 = mysqli_fetch_array($response1)){
					//$arrayrow = array();
					$arrayrow["type"] = $row1["Type"];
				}
			}

			//echo $arrayrow;
			array_push($list,$arrayrow);
			$query = "SELECT Company.CID AS CID,UserName,ImageUrl from Company, CompanyImages where Company.CID=CompanyImages.CID and Company.UserName = '".$username."';";	
			$response = @mysqli_query($dbc, $query);
	//$list = array();
	//echo $query;
			if($response){
		
				while($row = mysqli_fetch_array($response)){
					$arrayrow = array();
			//$arrayrow["username"] = $row["UserName"];
					$arrayrow["image"] = $row["ImageUrl"];
			//echo $arrayrow;
					array_push($list,$arrayrow);
				}
		
		
			}
		else{
			echo mysqli_error($dbc);
		}





		$query = "SELECT Company.CID AS CID,UserName,PID from Company, CompanyPerks where Company.CID=CompanyPerks.CID and Company.UserName = '".$username."';";	
	$response = @mysqli_query($dbc, $query);
//	echo $query;
	if($response){
		while($row = mysqli_fetch_array($response)){
			$query1 = "SELECT Description from Perks where PID ='".$row["PID"]."';";
			$response1 = @mysqli_query($dbc, $query1);

			if($response1){
				while($row1 = mysqli_fetch_array($response1)){
					$arrayrow = array();
					$arrayrow["Perk"] = $row1["Description"];
					array_push($list, $arrayrow);
				}
			}
		}
	}


	$query = "SELECT Company.CID AS CID, City,State from Company, CompanyLocation where Company.CID=CompanyLocation.CID and Company.UserName = '".$username."';";	
	$response = @mysqli_query($dbc, $query);
//	echo $query;
//	$list = array();
	//echo $query;
	if($response){
		
		while($row = mysqli_fetch_array($response)){
			$arrayrow = array();
			//$arrayrow["username"] = $row["UserName"];
			$arrayrow["city"] = $row["City"];
			$arrayrow["state"] = $row["State"];
			//echo $arrayrow;
			array_push($list,$arrayrow);
		}
		
		
	}
	else{
		echo mysqli_error($dbc);
	}


	$query = "SELECT Company.CID AS CID,UserName,EVPID from Company, CompanyEVP where Company.CID=CompanyEVP.CID and Company.UserName = '".$username."';";	
	$response = @mysqli_query($dbc, $query);
//	echo $query;
	if($response){
		while($row = mysqli_fetch_array($response)){
			$query1 = "SELECT Description from EVP where EVPID ='".$row["EVPID"]."';";
			$response1 = @mysqli_query($dbc, $query1);

			if($response1){
				while($row1 = mysqli_fetch_array($response1)){
					$arrayrow = array();
					$arrayrow["evp"] = $row1["Description"];
					array_push($list, $arrayrow);
				}
			}
		}
	}


	$jsonList = json_encode($list);
	echo $jsonList;
		}
		
		
	}
	else{
		echo mysqli_error($dbc);
	}


	

}
// Close connection to the database
mysqli_close($dbc);


?>