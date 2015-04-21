<?php
// Opens a connection to the database


// Defined as constants so that they can't be changed
DEFINE ('DB_USER', 'talentpoolme');
DEFINE ('DB_PASSWORD', 'TalentPM!2#');
DEFINE ('DB_HOST', 'talentpoolme.czc880no1mux.us-west-2.rds.amazonaws.com');
DEFINE ('DB_NAME', 'TalentPM');

// $dbc will contain a resource link to the database
// @ keeps the error from showing in the browser

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to MySQL: ' .
mysqli_connect_error());
?>