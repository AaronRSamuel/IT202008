<?php

require ("config.php");
echo "DBUser: " . $dbuser;
echo "\n\r";

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

try{
$db= new PDO($connection_string, $dbuser, $dbpass);
echo "should have connected";
$stmt = $db->prepare("CREATE TABLE `tblproduct` (
  `id` int auto_increment NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL,
  PRIMARY KEY ('id')
) CHARACTER SET utf8_general_ci");
$stmt->execute();
}
catch(Exception $e){
echo $e->getMessage();
exit("It didn't work");
}


try{
$db= new PDO($connection_string, $dbuser, $dbpass);
echo "should have connected";
$stmt = $db->prepare("INSERT INTO `tblproduct`
  (`name`, `code`, `image`, `price`) VALUES
('FinePix Pro2 3D Camera', '3DcAM01', 'product-images/camera.jpg', 1500.00),
('EXP Portable Hard Drive', 'USB02', 'product-images/external-hard-drive.jpg', 800.00),
('Luxury Ultra thin Wrist Watch', 'wristWear03', 'product-images/watch.jpg', 300.00),
('XP 1155 Intel Core Laptop', 'LPN45', 'product-images/laptop.jpg', 800.00)");
$stmt->execute();
}
catch(Exception $e){
echo $e->getMessage();
exit("It didn't work");
}

?>
