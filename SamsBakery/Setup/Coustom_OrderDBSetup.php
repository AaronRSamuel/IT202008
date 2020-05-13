<?php
	require ("config.php");
	echo "DBUser: " . $dbuser;
	echo "\n\r";

	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

	try{
	$db= new PDO($connection_string, $dbuser, $dbpass);
	echo "should have connected";
	$stmt = $db->prepare("CREATE TABLE IF NOT EXISTS
			 `Coustom_Order` (
				 	`id` int auto_increment not null,
          `user_id` int not null,
 			 		`phone_number` int not null,
 		 			`comment` varchar(64),
 	 				`date_created` timestamp not null default current_timestamp,
 					`date_due` timestamp,
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
