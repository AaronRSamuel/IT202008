<?php
	require ("config.php");
	echo "DBUser: " . $dbuser;
	echo "\n\r";

	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

	try{
	$db= new PDO($connection_string, $dbuser, $dbpass);
	echo "should have connected";
	$stmt = $db->prepare("CREATE TABLE IF NOT EXISTS
			 `Coustomers` (
				`id` int auto_increment not null,
				`username` varchar(30) not null unique,
				`password` varchar(64) not null,
				`phone number` int not null,
				`spent` int not null default 0,
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
