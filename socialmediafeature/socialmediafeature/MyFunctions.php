<?php


	function run() {
		echo "MyFunctions runs here<br>";
	}
	
	function getAUser($db, $theUserID){
		$sql = "select * from user where userID=$theUserID";
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
	
	function getusersIDs($db){
		$sql = "select userID from user";
		$result = $db->query($sql);  
		#echo "<br />there were " . $result->size() . " rows <br />";
		return $result;	
	}
	
	function getImages($db){
		$sql = "select * from image";
		$result = $db->query($sql);
		echo "<br />there were " . $result->size() . " rows <br />";
		return $result;	
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
		$sql = "select * from user where lastName='$theLastName'";
		$result = $db->query($sql);
		displayAUser($result);
	}
	
	function addAnImage($db, $theImageLocation){
		$sql = "insert into image (image_location) values ($theImageLocation)";
		$result = $db->query($sql);
		echo "added new image";
		$sql = "select * from image where image_location='$theImageLocation'";
		$result = $db->query($sql);
		displayAnImage($result);
	}
	
	function addAnAnnotation($db,$theAnnotationComment, $theAnnotationLocation, $theUserIDFK, $theImageIDFK){
		$sql = "insert into annotation (annotation_comment, annotation_location, userID_fk, image_id_fk) 
		values ('$theAnnotationComment', $theAnnotationLocation, $theUserIDFK, $theImageIDFK)";
		$result = $db->query($sql);
		echo "added new annotation";
		$sql = "select * from annotation where annotation_comment='$theAnnotationComment' and 
		annotation_location='$theAnnotationLocation'";
		$result = $db->query($sql);
		displayAnAnnotation($result);
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
		echo "<table border=1><tr><td>image id</td><td>image location</td></tr>";
		$aRow = $image->fetch();
		$outputLine = "<tr><td>$aRow[image_id]</td>";
		$outputLine .= "<td>$aRow[image_location]</td></tr>";
		echo $outputLine."</table><br>";
	}
	
	function displayImages($images){
		echo "<table border=1><tr><td>Image ID</td><td>Image Location</td></tr>";
		while ( $aRow =  $images->fetch() )
		{
			$outputLine = "<tr><td>$aRow[image_id]</td>";
			$outputLine .= "<td>$aRow[image_location]</td>";
			echo $outputLine;
		}
		echo "</table>";
	}
	
	function displayAnAnnotation($annotation){
		echo "<table border=1><tr><td>Annotation ID</td><td>Annoation Comment</td>
		<td>Annotation Location</td><td>User ID</td><td>Image ID</td></tr>";
		while ( $aRow =  $annotation->fetch() )
		{
			$outputLine = "<tr><td>$aRow[annotation_id]</td>";
			$outputLine .= "<td>$aRow[annotation_comment]</td>";
			$outputLine .= "<td>$aRow[annotation_location]</td>";
			$outputLine .= "<td>$aRow[userID_fk]</td>";
			$outputLine .= "<td>$aRow[image_id_fk]</td>";
			echo $outputLine;
		}
		echo "</table>";
	}
	
	function displayAnnotations($annotations){
		echo "<table border=1><tr><td>Annotation ID</td> <td>Annotation Comment</td> <td>Annotation Location</td> <td>User ID</td> <td>Image ID</td></tr>";
		while ( $aRow =  $annotations->fetch() )
		{
			$outputLine = "<tr><td>$aRow[annotation_id]</td>";
			$outputLine .= "<td>$aRow[annotation_comment]</td>";
			$outputLine .= "<td>$aRow[annotation_location]</td>";
			$outputLine .= "<td>$aRow[userID_fk]</td>";
			$outputLine .= "<td>$aRow[image_id_fk]</td></tr>";
			echo $outputLine;
		}
		echo "</table>";
	}
	
	function displaySelectUsers($db){
		$options = "<select>";
		$users = getusers($db);
		while ($aRow = $users->fetch() ){
			$thisRow = $aRow['userID'];	
			$thisRow = $aRow['userID'];	
			$options .= "<option value=$thisRow>$thisRow</option>";				
		}
		$options .= "</select>";

	}


