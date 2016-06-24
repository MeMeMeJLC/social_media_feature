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

echo "UserID = " . $_SESSION['theUserID'] . ", ImageID= " . $_SESSION['theImageID'];

$image = getAnImage($db, $_SESSION['theImageID']);
displayAnImage($image);
?>