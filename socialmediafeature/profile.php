<?php
require_once("MyFunctions.php");
include_once "MYSQLDB.php";
$host = 'localhost' ;
$dbUser = 'root' ;
$dbPass = '' ;
$dbName = 'image_annotator' ;
$db = new MySQL( $host, $dbUser , $dbPass , $dbName ) ;
$db->selectDatabase();

/*function isValidForm ( $theImageLocation  ) 
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
		/*$user = addAnImage($db,$theImageLocation);
    }
} */
echo "<h2>Images</h2>";
$images = getImages($db);
displayImages($images);


?>
<html>
<!--<br><br>
<h2>Add Image</h2>
<form action="profile.php" method="post">
	<input type="text" value="ImageLocation" name="theImageLocation"><br><br>
	<button type="submit">Add image</button>
</form>-->

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>




<br><br>
<a href="main.php">Return to Main Page</a>
</html>