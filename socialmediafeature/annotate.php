<html>
<body>
<br><br>
	<form method='post' action='annotate.php'>
	Add an annotation: <input type='text' name='comment'></input><br>
	<input type='hidden' id='annotationLocation' name='annotationLocation' value=''></input>
	<input type='submit'></input>
</form>


<br><br>
<h1 id="annotationLocation"></h1>
<a href="profile.php">Return to user profile</a>
<a href="main.php">Return to Main Page</a>
<br><br>
</body>
</html>

<script>	
 
function getAnAnnotationLocation(){
		var x = event.clientX;
		var y = event.clientY;
		var coords = x + '' + y;
		window.alert(coords);
		document.getElementById('annotationLocation').value = coords; 
	}	</script>
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
//$theAnnotationLocation = displayAnImageToAnnotate($image);
getImageAnnotations($db, $theImageID);

if(isset($_POST['comment']) and ($_POST['annotationLocation'])){
	$theComment = $_POST['comment'];
	$theAnnotationLocation = $_POST['annotationLocation'];
	echo "location " . $theAnnotationLocation;
	addAnAnnotation($db, $theImageID, $theUserID, $theComment, $theAnnotationLocation);
	header("Refresh:0");
}



?>



