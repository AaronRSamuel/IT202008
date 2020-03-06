<?php
	require ("config.php");
	echo "DBUser: " . $dbuser;
	echo "\n\r";

	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

	try{
	$db= new PDO($connection_string, $dbuser, $dbpass);
	echo "should have connected";
	$stmt = $db->prepare("CREATE TABLE IF NOT EXISTS
			 `UserRoles` (
				 	`id` int auto_increment not null,
 		 			`role_name` varchar(20) not null default 'coustomer',
				PRIMARY KEY (`id`)
				) CHARACTER SET utf8 COLLATE utf8_general_ci"
			);
	$stmt->execute();
	}
	catch(Exception $e){
	echo $e->getMessage();
	exit("It didn't work");
	}
?>
