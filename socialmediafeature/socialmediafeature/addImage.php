<?php
require_once("MyFunctions.php");
include_once "MYSQLDB.php";
$host = 'localhost' ;
$dbUser = 'root' ;
$dbPass = '' ;
$dbName = 'image_annotator' ;
$db = new MySQL( $host, $dbUser , $dbPass , $dbName ) ;
$db->selectDatabase();

function isValidForm ( $theImageLocation  ) 
{
    $result = true;
    if ( $theImageLocation == "" )
    {
       $result = false;
       print "Please enter a first name and last name";
    }
return $result;
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    // grab the variables from the form
    $theImageLocation = $_POST["theImageLocation"];
    
    if ( isValidForm ( $theImageLocation )  )
    {
       // specify where to save the session variables
        session_save_path("./");
        session_start();
      // register the session variables and load the next page
        $_SESSION["theImageLocation"] = $theImageLocation ;
        /*header ("Location:searchProductsA.php")*/ ;
		$image = addAnImage($db,$theImageLocation);
    }
} 
?>
<html>
<h2>Add Image</h2>
<form action="addImage.php" method="post">
	<input type="text" value="ImageLocation" name="theImageLocation"><br><br>
	<button type="submit" value="Search for user">Add image</button>
</form>



<br><br>
<a href="main.php">Return to Main Page</a>
</html>