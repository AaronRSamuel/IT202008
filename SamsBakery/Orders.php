<?php
session_start();
require ("config.php");
if(isset($_SESSION['id'])){
  if($_SESSION['id'] == 3){
    echo 'hello admin';
  }
  else{
    header("Location: https://web.njit.edu/~as3655/IT202008/SamsBakery/home.php");
  }
}
else{
  header("Location: https://web.njit.edu/~as3655/IT202008/SamsBakery/home.php");
}


$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
$db= new PDO($connection_string, $dbuser, $dbpass);
try{
  $sql = $db->prepare("SELECT id, user_id, phone_number, item_id, comment, date_created from Orders");
  $sql->execute();
}
catch(Exception $e){
echo $e->getMessage();
exit("It didn't work");
}
?>

<html lang="en" dir="ltr">
  <head>
    <title>Orders</title>
    <button class = "button" onclick="location.href = 'https://web.njit.edu/~as3655/IT202008/SamsBakery/home.php';"
    type="button" name="Home"> Home</button>
  </head>
  <body>
    <table>
    <thead>
        <tr>
            <th>Order ID |</th>
            <th>User ID |</th>
            <th>Phone Number|</th>
            <th>Item ID|</th>
            <th>Item|</th>
            <th>Date created|</th>
        </tr>
    </thead>
    <tbody>
        <?php while( $row = $sql->fetch()) : ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['phone_number']; ?></td>
            <td><?php echo $row['item_id']; ?></td>
            <td><?php echo $row['comment']; ?></td>
            <td><?php echo $row['date_created']; ?></td>
        </tr>
        <?php endwhile ?>
    </tbody>
</table>
<form method="POST">
    <label for="order"> Order ID to Delete</label>
    <input type ="int" id = "order" name= "order" placeholder= "Order ID" int/>
    <input type="submit" name="Delete" id="Delete" value="Delete"/>
</form>
  </body>
</html>

<?php
if(array_key_exists('Delete',$_POST)){
 delete();
}
function delete(){
  require ("config.php");
  $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
  $db= new PDO($connection_string, $dbuser, $dbpass);
  echo "delete";
  $order_id = $_POST['order'];
  $sql = $db->prepare("DELETE FROM `Orders` WHERE id = :id");
  $r = $sql->execute(array(":id"=>$order_id));
  echo "<pre>" . var_export($r, true) . "</pre>";
  echo "<pre>" . var_export($sql->errorInfo(), true) . "</pre>";
}
?>
