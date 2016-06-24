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

if(isset($_POST['comment'])){
	$theComment = $_POST['comment'];
	$theAnnotationLocation = $_POST['location'];
	addAnAnnotation($db, $theImageID, $theUserID, $theComment, $theAnnotationLocation);
	
}

?>

<html>
<body>
<form method="post" action="annotate.php">
	Add an annotation: <input type="text" name="comment"><br>
	Add a location: <input type="text" name="location"><br>
	<input type="submit">
</form>

</body>
</html>