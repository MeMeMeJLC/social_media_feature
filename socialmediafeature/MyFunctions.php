


<?php

	
	function getAUser($db, $theUserID){
		$sql = "select * from user where userID='$theUserID'";
		$result = $db->query($sql); 
		echo "<br />there were ". $result->size() ."rows <br />";
		return $result;	
	}
	
	function getusers($db){
		$sql = "select * from user";
		$result = $db->query($sql);  
		echo "<br />there were " . $result->size() . " rows <br />";
		return $result;	
	}

	function getAnImage($db, $theImageID){
		$sql = "select * from image where image_ID=$theImageID";
		$result = $db->query($sql); 

		return $result;	
	}
	
	function getImageLocation($db, $theImageID){
		$sql = "select image_location from image where image_ID=$theImageID";
		$result = $db->query($sql);
		
		return "105.png"/*$result*/;
	}
	
	function getImages($db){
		$sql = "select * from image";
		$result = $db->query($sql);
		echo "<br />there were " . $result->size() . " rows <br />";
		return $result;	
	}
	
	function getImageAnnotations($db, $theImageID){
		$sql = "select * from annotation where image_id_fk = $theImageID";
		$result = $db->query($sql);
		//displayAnnotations($result);
		displayAnnotationsImages($result);
	}
	
	function getAnnotations($db){
		$sql = "select * from annotation";
		$result = $db->query($sql);
		echo "<br />there were " . $result->size() . " rows <br />";
		return $result;	
	}
	
	
	function addAUser($db, $theFirstName, $theLastName){
		$sql = "insert into user (firstName, lastName) values ('$theFirstName', '$theLastName')";
		$result = $db->query($sql);
		echo "<br>added new user<br>";
		$sql = "select * from user where lastName='$theLastName' and firstName='$theFirstName'";
		$result = $db->query($sql);
		displayAUser($result);
	}
	
	function addAnImage($db, $theImageLocation){
		$sql = "insert into image (image_location) values ('$theImageLocation')";
		$result = $db->query($sql);
		echo "added new image";
		$sql = "select * from image where image_location='$theImageLocation'";
		$result = $db->query($sql);
		displayAnImage($result);
	}

	function addAnAnnotation($db, $theImageID, $theUserID, $theComment, $theAnnotationLocationX,  $theAnnotationLocationY){
		$host = 'localhost' ;
$dbUser = 'root' ;
$dbPass = '' ;
$dbName = 'image_annotator';
		$theComment = htmlentities($theComment);#xss attack proof
		$theComment = mysqli_real_escape_string(mysqli_connect( $host, $dbUser , $dbPass , $dbName ) ,$theComment); #sql injection prevention, need to fix mysql class to be mysqli , doesnt work with $db or MYSL class
		
		$sql = "insert into annotation (annotation_comment, annotation_location_x, annotation_location_y, userID_fk, image_id_fk) values ('$theComment', $theAnnotationLocationX,$theAnnotationLocationY, $theUserID, $theImageID)";
		$result = $db->query($sql);
		echo "added new comment";
		$sql = "select * from annotation where image_id_fk='$theImageID'";
		$result = $db->query($sql);
	}
	
	function displayusers($users){
		echo "<table border=1><tr><td>user ID</td><td>First Name</td><td>Last Name</td></tr>";
		while ( $aRow =  $users->fetch() )
		{
			$outputLine = "<tr><td>$aRow[userID]</td>";
			$outputLine .= "<td>$aRow[firstName]</td>";
			$outputLine .= "<td>$aRow[lastName]</td>
			</tr>";
			echo $outputLine;
		}
		echo "</table>";
	}
	
	function displayAUser($user){
		echo "<table border=1><tr><td>user ID</td><td>first name</td><td>last name</td></tr>";
		$aRow = $user->fetch();
		$outputLine = "<tr><td>$aRow[userID]</td>";
		$outputLine .= "<td>$aRow[firstName]</td>";
		$outputLine .= "<td>$aRow[lastName]</td></tr>";
		echo $outputLine."</table><br>";
	}
	
	function displayAnImage(
	$image){
		$aRow = $image->fetch();
		echo "<image src='resources/images/$aRow[image_location]' onclick='getAnAnnotationLocation(event)'></image>";
	}
	


	
	function displayImages($images){
		echo "<table border=1><tr><td>Image ID</td><td>Image Location</td><td>image</td><td>Annotate</td></tr>";
		while ( $aRow =  $images->fetch() )
		{
			$outputLine = "<tr><td>$aRow[image_id]</td>";
			$outputLine .= "<td>$aRow[image_location]</td>";
			$outputLine .= "<td><img src='resources/images/$aRow[image_location]'</td>";
			$outputLine .= "<td>
			<form method='post' action='profile.php'>
				<input type='submit' value='$aRow[image_id]' name='image'>
			</form></td></tr>"; //link to image id
			echo $outputLine;
		}
		echo "</table>";
	}

	function displayAnnotationsImages($annotations){
		while ($aRow = $annotations->fetch()){
			$x = $aRow['annotation_location_x']."px";
			$y = $aRow['annotation_location_y']."px";
			$id = $aRow['annotation_id'];
			$comment = $aRow['annotation_comment'];
			;$_POST['commentForDisplay'] = $comment; 
			

		/*echo "<image id='$id' src='resources/icon.png' style='position:fixed; margin-left:$x; margin-top:$y;' onclick='displayAnnotationInATable($id)'></image>";*/
		echo "<image id='$id' src='resources/icon.png' style='position:fixed; margin-left:$x; margin-top:$y;' onclick='showUser($id)'></image>";
		}				
	}


	
	function displayAnnotations($annotations){
		echo "<table border=1><tr><td>Annotation ID</td> <td>Annotation Comment</td> <td>Annotation Location X</td><td>Annotation Location Y</td> <td>User ID</td> <td>Image ID</td></tr>";
		while ( $aRow =  $annotations->fetch() )
		{
			$outputLine = "<tr><td>$aRow[annotation_id]</td>";
			$outputLine .= "<td>$aRow[annotation_comment]</td>";
			$outputLine .= "<td>$aRow[annotation_location_x]</td>";
			$outputLine .= "<td>$aRow[annotation_location_y]</td>";
			$outputLine .= "<td>$aRow[userID_fk]</td>";
			$outputLine .= "<td>$aRow[image_id_fk]</td></tr>";
			echo $outputLine;
		}
		echo "</table>";	
	}
	
?>	
<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","getuser.php?q="+str,true);
        xmlhttp.send();
    }
}

	function displayAnnotationInATable(id){
		console.log("javascript running " + id);
		if (id == ""){
			console.log("if");
			document.getElementById("anno").innerHTML = "empty";
			return;
		} else {
			console.log("else");
			if (window.XMLHttpRequest){
				console.log("else-if")
				xmlhttp = new XMLHttpRequest();
			}
			xmlhttp.onreadystatechange = function(){
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
					console.log("else-if-if");
					document.getElementById("anno"),innerHTML = xmlhttp.responseText;
				}
			};
			xmlhttp.open("GET","showcomment.php?thing="+id,true);
			xmlhttp.send();
		}
	}
</script>