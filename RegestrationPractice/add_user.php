<?php

	ini_set('display_errors',1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	require("config.php");
	echo "DBUser: " .  $dbuser;
	echo "\n\r";
	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

	try{
		$db = new PDO($connection_string, $dbuser, $dbpass);
		echo "hopefully connected";
//		$stmt = $db->prepare("INSERT INTO `Users` (email, password) VALUES ('Mask13@clubpenguin.com','sup123')");
		$stmt = $db->prepare("INSERT INTO `Users` (email, password) VALUES (:email, :password)");
    	        $params = array(":email"=> 'Mask13@clubpenguin.com',":password"=> 'sup123');
      	        $stmt->execute($params);
        	echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
		echo var_export($stmt->errorInfo(), true);
	}

	catch(Exception $e){
		echo $e->getMessage();
		echo "error";
	}

?>
