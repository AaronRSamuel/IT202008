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
  $sql = $db->prepare("SELECT item_name, item_id, item_price from Cart WHERE user_id = :id");
  $sql->execute(array(":id"=>$id));
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
          <?php  $total = $total + (int)$row['itme_price']; ?>
      </tr>
      <?php endwhile ?>
    </tbody>
  </table>
    <form id = "order" method="post">
      <input type="submit" name="order" id="order" value="order"/>
    </form>
    <form id = "Clear Order" method="post">
      <input type="submit" name="clear" id="clear" value="clear"/>
    </form>
  </body>
</html>

<?php
  function order(){
    try{
      $id = $_SESSION['id'];
      require ("config.php");
      $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
      $db= new PDO($connection_string, $dbuser, $dbpass);
      echo "hi";
      $sql = $db->prepare("SELECT item_name, item_id, item_price from `Cart` WHERE user_id = :id");
      $r = $sql->execute(array(":id"=>$id));
      echo "<pre>" . var_export($r, true) . "</pre>";
      while( $row = $sql->fetch()){
        echo $row['item_id'];
        echo $row['item_name'];
        $stmt = $db->prepare("INSERT INTO `Orders`
            (item_id, user_id, comment, date_created) VALUES
            (:item_id, :user_id, :item_name, current_timestamp)");
        $params = array(":item_id" => $row['item_id'], ":user_id"=> $id, ":item_name"=> $row['item_name']);
        $r = $stmt->execute($params);
        echo "<pre>" . var_export($r, true) . "</pre>";
        echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
    }
    }
    catch(Exception $e){
    echo $e->getMessage();
    exit("It didn't work");
    }
    clear();
  }
  function clear(){
    try{
      $id = $_SESSION['id'];
      require ("config.php");
      $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
      $db= new PDO($connection_string, $dbuser, $dbpass);
      echo "clear!";
      $sql = $db->prepare("DELETE FROM `Cart` WHERE user_id = :id");
      $r = $sql->execute(array(":id"=>$id));
      echo "<pre>" . var_export($r, true) . "</pre>";
      echo "<pre>" . var_export($sql->errorInfo(), true) . "</pre>";
    }
    catch(Exception $e){
      echo $e->getMessage();
      exit("It didn't work");
    }
  }
  if(isset($_POST["order"])) {
   order();
  }
  if(isset($_POST["clear"])) {
   clear();
  }
?>
