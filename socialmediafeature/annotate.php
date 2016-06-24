<?php
require_once("MyFunctions.php");
include_once "MYSQLDB.php";
$host = 'localhost' ;
$dbUser = 'root' ;
$dbPass = '' ;
$dbName = 'image_annotator' ;
$db = new MySQL( $host, $dbUser , $dbPass , $dbName ) ;
$db->selectDatabase();
session_start();

echo "UserID = " . $_SESSION['theUserID'] . ", ImageID= " . $theImageID = $_SESSION['theImageID'];
$theUserID = $_SESSION['theUserID'];
$image = getAnImage($db, $theImageID);
displayAnImage($image);
getImageAnnotations($db, $theImageID);
if(isset($_POST['comment'])){
	$theComment = $_POST['comment'];
	$theAnnotationLocation = $_POST['location'];
	addAnAnnotation($db, $theImageID, $theUserID, $theComment, $theAnnotationLocation);
	header("Refresh:0");
}

?>

<html>
<body>
<form method="post" action="annotate.php">
	Add an annotation: <input type="text" name="comment"><br>
	Add a location: <input type="text" name="location"><br>
	<input type="submit">
</form>
<br><br>
<a href="profile.php">Return to user profile</a>
<a href="main.php">Return to Main Page</a>
</body>
</html>