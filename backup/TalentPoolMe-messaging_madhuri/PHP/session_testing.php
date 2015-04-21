<?php
// Start the session
session_start();
if(!isset($_SESSION['username'])
header("Location: loginpage.php");
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Set session variables
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";
echo "Session variables are set.";
?>

</body>
</html>