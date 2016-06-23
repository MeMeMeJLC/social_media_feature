<?php
include_once ("MySQLDB.php");
$host = 'localhost';
$dbUser ='root';
$dbPass ='';
$dbName ='image_annotator';

// create a new database object and connect to server
$db = new MySQL( $host, $dbUser, $dbPass, $dbName );
//  drop the database and then create it again
$db->dropDatabase();
$db->createDatabase();
// select the database
$db->selectDatabase();
$sql = "drop table user";
$result = $db->query($sql);
$sql = "drop table image";
$result = $db->query($sql);
$sql = "drop table annotation";
$result = $db->query($sql);


/*create user table*/
$sql = "create table user (userID int not null auto_increment, 
	firstName varchar(30) not null,
	lastName varchar(30) not null,
	primary key(userID))";
$result = $db->query($sql);

/*create image table*/
$sql = "create table image (image_id int not null auto_increment,
	image_location varchar(45) not null,
	primary key(image_id))";
$result = $db->query($sql);

/*create annotation table*/
$sql = "create table annotation(annotation_id int not null auto_increment,
	annotation_comment varchar(40) not null,
	annotation_location int (6) not null,
	userID_fk int not null,
	image_id_fk int not null,
	primary key (annotation_id),
	foreign key (userID_fk) references user (userID),
	foreign key (image_id_fk) references image (image_id)	)";
$result = $db->query($sql);

/*insert user test data*/
$sql  = "insert into user(firstName, lastName) values ('Jeremy', 'Cook')";
$result = $db->query($sql);
$sql  = "insert into user(firstname, lastName) values ('Bill', 'Hicks')";
$result = $db->query($sql);

/*insert image test data*/
$sql = "insert into image(image_location) values ('105')";
$result = $db->query($sql);
$sql = "insert into image(image_location) values ('118')";
$result = $db->query($sql);
$sql = "insert into image(image_location) values ('118')";
$result = $db->query($sql);

/*insert annotation test data*/
$sql = "insert into annotation(annotation_comment, annotation_location, userID_fk, image_id_fk) values ('this is comment 1', 111111, 1, 1)";
$result = $db->query($sql);

?>
<html>
<body>
<br><br>
<a href="main.php">Return To Main Form</a>
</body>
</html>




	

