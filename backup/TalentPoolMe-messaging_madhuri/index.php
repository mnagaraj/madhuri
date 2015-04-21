<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
// Get a connection for the database
require_once('mysql_connect.php');

// Create a query for the database
$query = "SELECT Company.CID AS CID,NAME,ImageUrl from Company, CompanyImages where Company.CID=CompanyImages.CID";



//$data = array('CID'=>$_GET[CID],'NAME'=>$_GET[NAME]);
$CID = $_GET[CID];
$NAME = $_GET[NAME];



if(isset($CID) && isset($NAME)){
	$query .= " "."AND"." "."CID"."=".$CID ." "."AND"." "."NAME"."=".'"'.$NAME.'"'.";";
}
elseif(isset($CID)){
	$query.= " "."AND"." "."CID"."=".$CID.";";
}
elseif (isset($NAME)) {
	$query.= " "."AND"." "."NAME"."=".'"'.$NAME.'"'.";";
}
else{
	$query.=";";
}

//echo $query;
// Get a response from the database by sending the connection
// and the query
$response = @mysqli_query($dbc, $query);


// If the query executed properly proceed
if($response){

/*echo '<table align="left"
cellspacing="5" cellpadding="8">

<tr><td align="left"><b>First Name</b></td>
</tr>';
*/
// mysqli_fetch_array will return a row of data from the query
// until no further data is available

$list = array();
while($row = mysqli_fetch_array($response)){
	$arrayrow = array();
	$arrayrow["CID"]=$row["CID"];
	$arrayrow["NAME"]=$row['NAME'];
	$arrayrow["ImageUrl"]=$row["ImageUrl"];
	array_push($list, $arrayrow);
//echo '<tr><td align="left">'.$row['NAME'].'</td><td align="left">'.$row['CID'].'</td>';
//echo '</tr>';
}
//echo $list;
$jsonList = json_encode($list);
echo $jsonList;

} else {

echo "Couldn't issue database query<br />";

echo mysqli_error($dbc);

}

// Close connection to the database
mysqli_close($dbc);


?>