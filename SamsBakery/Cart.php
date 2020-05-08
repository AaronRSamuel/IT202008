<?php
session_start();
echo $_SESSION['id'];
require ("config.php");

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
try{
  $db= new PDO($connection_string, $dbuser, $dbpass);
  echo "should have connected";
  $sql = $db->prepare("SELECT item_name, item_price, from Orders where user_id= $_SESSION['id']");
  $sql->execute();
}
catch(Exception $e){
echo $e->getMessage();
exit("It didn't work");
}
?>
<html lang="en">
  <head>
    <title></title>
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
    $sql = $db->prepare("INSERT INTO Order SELECT item_name, item_price, from Cart where user_id= '$_SESSION['id']''");
  }
?>
