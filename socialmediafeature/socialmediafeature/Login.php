<?php
require_once("MyFunctions.php");
include_once "MYSQLDB.php";
$host = 'localhost' ;
$dbUser = 'root' ;
$dbPass = '' ;
$dbName = 'image_annotator' ;
$db = new MySQL( $host, $dbUser , $dbPass , $dbName ) ;
$db->selectDatabase();

echo "Login";
function isValidForm ( $theUserID  ) 
{
    $result = true;
    if ( $theUserID == ""  )
    {
       $result = false;
       print "Please enter a word or words for your search";
    }
return $result;
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    // grab the variables from the form
    $theUserID = $_POST["theUserID"];
    //echo $theWords;
    if ( isValidForm ( $theUserID )  )
    {
       // specify where to save the session variables
        session_save_path("./");
        session_start();
      // register the session variables and load the next page
        $_SESSION["theUserID"] = $theUserID ;
        /*header ("Location:searchProductsA.php")*/ ;
		$user = getAUser($db,$theUserID);
		displayAUser($user);
    }
}  
?>

<form action="login.php" method="post">
	<input type="text" name="theUserID">
		<?php
			echo "in select php";
			echo displaySelectUsers($db);
		?>
	<button type="submit" value="Search for user">Login User In</button>
</form>
<a href="registerNewUser.php">Register new user<a>

<html>
<body>
<br><br>
<a href="main.php">Return To Main Form</a>
</body>
</html>