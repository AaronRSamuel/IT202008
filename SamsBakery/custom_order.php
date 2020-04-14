<html>
<body>
  <div>
    <center><form name="coustom" id="coustom" method="POST">
      <label for="phone">Phone Number: </label>
      <input type="int" id="phone" name="phone" placeholder="Enter phone number not dashes"/>
      <label for="comment">Order: </label>
      <input type="text" id="comment" name="comment" placeholder="Enter what you would like"/>
      <input type="submit" value="submit"/>
    </form></center>
  </div>
</body>
</html>

<?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
try{
if(isset($_POST['phone']) && isset($_POST['comment'])){
$phone = $_POST['phone'];
$comment = $_POST['comment'];
$user_Id = $_SESSION['id'];

require("config.php");
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
$db = new PDO($connection_string, $dbuser, $dbpass);

$stmt = $db->prepare(" INSERT INTO `Orders`
      (user_id, phone_number, item_id, comment) VALUES
      (:user_ID, :phone, :item_id, :comment)");
$params = array(":user_ID"=> $user_Id, ":phone"=> $phone, ":item_id" => 33, ":comment" => $comment);
$stmt->execute($params);
}
}
catch(Exception $e){
  echo $e->getMessage();
  exit();
}
?>
