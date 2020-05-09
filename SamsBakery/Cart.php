<?php
session_start();
$id = $_SESSION['id'];
require ("config.php");

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
try{
  $db= new PDO($connection_string, $dbuser, $dbpass);
  echo "should have connected";
  $query = "SELECT item_name, item_price from Cart WHERE user_id = 3";
  $sql = $db->prepare($query);
  $sql->execute();
}
catch(Exception $e){
echo $e->getMessage();
exit("It didn't work");
}
?>
<html lang="en">
  <head>
    <title> Cart </title>
    <button class = "button" onclick="location.href = 'https://web.njit.edu/~as3655/IT202008/SamsBakery/home.php';"
    type="button" name="Home"> Home</button>
    <button class = "button" onclick="location.href = 'https://web.njit.edu/~as3655/IT202008/SamsBakery/Logout.php';"
    type="button" name="Logout" > Logout</button>
    <button class = "button" type="button" onclick="location.href = 'https://web.njit.edu/~as3655/IT202008/SamsBakery/profile.php';"
    name="button"> Profile</button>
  </head>
  <style>
  table, th, td {
    border: 1px solid black;
  }
  </style>
  <body>
    <table id = "Cart">
      <thread>
      <tr>
        <th>Item</th>
        <th>Price</th>
      </tr>
    </thread>
    <tbody>
      <?php while( $row = $sql->fetch()) : ?>
      <tr>
          <td><?php echo $row['item_name']; ?></td>
          <td><?php echo $row['item_price']; ?></td>
      </tr>
      <?php endwhile ?>
    </tbody>
  </table>
    <form id = "order">
      <input type="submit" value="order"/>
    </form>
  </body>
</html>

<?php
  if($_POST['order']){
    $sql = $db->prepare("SELECT item_id from Cart where user_id= :id");
    while( $row = $sql->fetch()) :
      $stmt = $db->prepare("INSERT INTO `Order`
         (item_id) VALUES
         (:item_id)");
      $params = array(":item_id" => $row['item_id']);
      $stmt->execute($params);
    endwhile;
  }
  echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
?>
