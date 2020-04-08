<html>
<body>
  <div>
    <center><form name="coustom" id="coustom" method="POST">
      <label for="phone">Phone Number: </label>
      <input type="int" id="phone" name="phone" placeholder="Enter phone number not dashes"/>
      <label for="comment">Order: </label>
      <input type="text" id="itemnumber" name="comment" placeholder="Enter what you would like"/>
      <input type="submit" value="submit"/>
    </form></center>
  </div>
</body>
</html>

<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$phone = $_POST['phone'];
$comment = $_POST['comment'];
$user = $_SESSION ['user'];
$user_Id = var_dump($user->offsetGet(0));

require("config.php");
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
$db = new PDO($connection_string, $dbuser, $dbpass);

$stmt = $db->prepare(" INSERT INTO `Orders`
      (user_id, phone_number, item_id, comment) VALUES
      (:user_ID, :phone, :item_id, :comment)");
$params = array(":user_ID"=> $user_Id, ":phone"=> $phone, ":item_id" => 33, ":comment" => $comment);
$stmt->execute($params);
echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
 ?>
