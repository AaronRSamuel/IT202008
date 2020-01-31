<?php
//this is check_db.php
ini_set('display_errors', 1);
ini_set('display_startup_error',1);
error_reporting(E_ALL);

require ("config.php");
echo "DBUser: " . $dbuser;
echo "\n\r";

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

try{
	$db= new PDO($connection_string, $dbuser, $dbpass);
	echo "should have connected";
	$stmt = $db->prepare("CREATE TABLE IF NOT EXISTS
			 `Test` (
				`id` int auto_increment not null,
				`username` varchar(30) not null unique,
				`pin` int default 0,
				PRIMARY KEY (`id`)
				) CHARACTER SET utf8 COLLATE utf8_general_ci"
			);
	$stmt->execute();
	//echo var_export($stmt->errorInfo(), true);
	//	$stmt->errorInfo(), true) . ",/pre>";
	$stmt = $db->prepare("INSERT INTO `Test`
		(username, pin) VALUES
		(:username, :pin)");
	//$stmt->bindValue(":username", 'Bob');
	//$stmt->bindValue(":pin",1234):
		//or this
	$params = array(":username"=>'Bob', ":pin"=> 1234);
	$stmt->execute($params);
	echo "<pre>" . var_export(
		$stmt->errorInfo(),true) . "</pre>";
	$stmt = $db->prepare("SELECT id, username
				FROM `Test` WHERE id = :id");
	
	//$r = $stmt->execute();
	//$results = $stmt->fetchAll(PDO:FETCH_ASSOC);
	//echo "<pre>" . var_export(
	//	$r, true) . "</pre>";
	//echo "<pre>" . var_export(
	//$results, true) . "</pre>";
	
	$r = $stmt->execute(array(":id"=>1));
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
	echo "<pre>" . var_export($r, true) . "</pre>";
	echo "<pre>" . var_export($results, true) . "</pre>";
	echo "<pre>" . var_export($stmt->errorInfo(), true) .
		"</pre>";

	$stmt = $db->prepare("UPDATE `Test`
			SET username = :username
			WHERE id = :id");
	$r = $stmt->execute(array(":username"=>'Bobby',
			":id"=> 1));
	echo "<pre>" . var_export($r, true) . "</pre>";
	echo "<pre>" . var_export($stmt->errorInfo(), true) .
		"</pre>";
}
catch(Exception $e){
	echo $e->getMessage();
	exit("It didn't work");
}

?>
