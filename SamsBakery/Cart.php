<?php
session_start();
$id = $_SESSION['id'];
require ("config.php");
if(isset($_SESSION['id'])){
  echo $_SESSION['id'];
}
else{
  header("Location: https://web.njit.edu/~as3655/IT202008/SamsBakery/home.php");
}

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
$db= new PDO($connection_string, $dbuser, $dbpass);
try{
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
    <form id = "order" method="post">
      <input type="submit" name="order" id="order" value="order"/>
    </form>
  </body>
</html>

<?php
  function order(){
    echo "hi";
    $sql = $db->prepare("SELECT item_id, item_name from Cart where user_id = 3");
    $sql->execute();
    while( $row = $sql->fetch_row()):
      echo $row['item_id'];
      echo $row['item_name'];
      $stmt = $db->prepare("INSERT INTO `Orders`
         (item_id, user_id, comment, date_created) VALUES
         (:item_id, :user_id, :item_name, current_timestamp)");
      $params = array(":item_id" => $row['item_id'], ":user_id"=> $id, ":item_name"=> $row['item_name']);
      $stmt->execute($params);
      echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
    endwhile;
  }
  if(array_key_exists('order',$_POST)){
   order();
  }
?>
