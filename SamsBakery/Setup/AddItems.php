<<?php
require ("config.php");
echo "DBUser: " . $dbuser;
echo "\n\r";

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

try{
$db= new PDO($connection_string, $dbuser, $dbpass);
echo "should have connected";
$stmt = $db->prepare("INSERT INTO `Items`
        (newItem) VALUES
        (:item_name)");
        $newItem = "Everything Bagel";
$stmt->execute();
}
catch(Exception $e){
echo $e->getMessage();
exit("It didn't work");
}
?>
