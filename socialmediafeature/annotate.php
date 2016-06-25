<script>	
 
function getAnAnnotationLocation(){
		var x = event.clientX;
		var y = event.clientY;
		document.getElementById('annotationLocationX').value = x;
		document.getElementById('annotationLocationY').value = y;		
	}	
	
</script>
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

$theImageID = $_SESSION['theImageID'];
$theUserID = $_SESSION['theUserID'];
$image = getAnImage($db, $theImageID);

$imageLocation = getImageLocation($db, $theImageID);
#echo "$imageLocation";
getImageAnnotations($db, $theImageID);
echo "<image src='resources/images/$imageLocation'></image>";	
//displayAnImage($image);
//$theAnnotationLocation = displayAnImageToAnnotate($image);


if(isset($_POST['comment']) and ($_POST['annotationLocationX']) and ($_POST['annotationLocationY'])){
	$theComment = $_POST['comment'];
	$theAnnotationLocationX = " ".$_POST['annotationLocationX'];
	$theAnnotationLocationY = " ".$_POST['annotationLocationY']." ";
	addAnAnnotation($db, $theImageID, $theUserID, $theComment, $theAnnotationLocationX, $theAnnotationLocationY);
	header("Refresh:0");
}



?>


<html>
<body>
<image id="image" src=''></image>
<form method='post' action='annotate.php'>
	Add an annotation:<br> <input type='text' name='comment'></input><br>Then click the location on the image.
	<input type='hidden' id='annotationLocationX' name='annotationLocationX' value=''></input>
	<input type='hidden' id='annotationLocationY' name='annotationLocationY' value=''></input>
	<br><input type='submit'></input>
</form>
<h1 id="annotationLocation"></h1>
<a href="profile.php">Return to user profile</a>
<br><a href="main.php">Return to Main Page</a>
</body>
</html>
