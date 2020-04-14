<html>
<body>
  <div>
    <center><form name="new_item" id="new_item" method="POST">
      <label for="name">Name: </label>
      <input type="text" id="name" name="name" placeholder="Enter item name"/>
      <label for="comment">pricer: </label>
      <input type="int" id="price" name="price" placeholder="Enter price"/>
      <label for="photo">photo URL: </label>
      <input type="text" id="photo" name="photo" placeholder="Enter photo URL"/>
      <label for="listLoc">location: </label>
      <input type="int" id="listLoc" name="listLoc" placeholder="Enter list location(number)"/>
      <input type="submit" value="submit"/>
    </form></center>
  </div>
</body>
</html>

<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(        isset($_POST['name'])
        && isset($_POST['price'])
        && isset($_POST['listLoc'])
        && isset($_POST['photo'])
        ){
require("config.php");
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

try{
$db= new PDO($connection_string, $dbuser, $dbpass);
echo "should have connected";
$stmt = $db->prepare("INSERT INTO
  `tblproduct` (name, code, image, price)
  VALUES (:name, :code, :image, :price) ");
  $name = $_POST['name'];
  $code = $_POST['listLoc'];
  $image = $_POST['photo'];
  $price = $_POST['price'];
  $params = array(":name"=> $name, ":code"=> $code,":photo"=> $image,":image"=> $image);
  $stmt->execute($params);
  echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
}
catch(Exception $e){
echo $e->getMessage();
exit("It didn't work");
}
}
 ?>
