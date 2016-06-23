<?php
require_once("MyFunctions.php");
include_once "MYSQLDB.php";
$host = 'localhost' ;
$dbUser = 'root' ;
$dbPass = '' ;
$dbName = 'image_annotator' ;
$db = new MySQL( $host, $dbUser , $dbPass , $dbName ) ;
$db->selectDatabase();

echo "<h2>register new user</h2>";
function isValidForm ( $theFirstName, $theLastName  ) 
{
    $result = true;
    if ( $theFirstName == "" or $theLastName == "" )
    {
       $result = false;
       print "Please enter a first name and last name";
    }
return $result;
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    // grab the variables from the form
    $theFirstName = $_POST["theFirstName"];
    $theLastName = $_POST["theLastName"];
    
    if ( isValidForm ( $theFirstName, $theLastName )  )
    {
       // specify where to save the session variables
        session_save_path("./");
        session_start();
      // register the session variables and load the next page
        $_SESSION["theFirstName"] = $theFirstName ;
        $_SESSION["theLastName"] = $theLastName ;
        /*header ("Location:searchProductsA.php")*/ ;
		$user = addAUser($db,$theFirstName, $theLastName);
    }
} 


?>
<html>
<form action="registerNewUser.php" method="post">
	<input type="text" value="First Name" name="theFirstName"><br><br>
	<input type="text" value="Last Name" name="theLastName"><br><br>
	<button type="submit" value="Search for user">Register new user</button>
</form>

<br /><br />
<a href="login.php">Return To Login Form</a><br>
<a href="main.php">Return To Main Menu</a>

</html>