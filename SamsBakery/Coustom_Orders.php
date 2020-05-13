<?php
session_start();
require ("config.php");
if(isset($_SESSION['id'])){
  echo $_SESSION['id'];
}
else{
  header("Location: https://web.njit.edu/~as3655/IT202008/SamsBakery/home.php");
}

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
try{
  $db= new PDO($connection_string, $dbuser, $dbpass);
  $sql = $db->prepare("SELECT user_id, phone_number, comment, date_created from Orders where item_id= '33'");
  $sql->execute();
}
catch(Exception $e){
echo $e->getMessage();
exit("It didn't work");
}
?>

<html lang="en" dir="ltr">
  <head>
    <title></title>
  </head>
  <body>
    <table>
    <thead>
        <tr>
            <th>User ID |</th>
            <th>Phone Number|</th>
            <th>Order|</th>
            <th>Date created|</th>
        </tr>
    </thead>
    <tbody>
        <?php while( $row = $sql->fetch()) : ?>
        <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['phone_number']; ?></td>
            <td><?php echo $row['comment']; ?></td>
            <td><?php echo $row['date_created']; ?></td>
        </tr>
        <?php endwhile ?>
    </tbody>
</table>
<form method = "post">
  <lable for="user_id"> User ID: </lable>
  <input type="int" name="user_id" placeholder = "enter user id"/>
  <lable for="user_id"> Comment: </lable>
  <input type="text" name="comment" placeholder = "enter comment"/>
  <input type="submit" name="submit" id="submit" value="submit"/>
</form>
  </body>
</html>
<?php
if(isset($_POST['submit'])) {
  echo "hi";
  require ("config.php");
  $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
  $db= new PDO($connection_string, $dbuser, $dbpass);
  $sql = $db->prepare("INSERT INTO `Comment`
                  (user_id, comment) VALUES
                  (:user_id, :comment)");
  $params = array(":user_id"=> $_POST['user_id'], ":comment"=>$_POST['comment']);
  $r = $sql->execute($params);
  echo "<pre>" . var_export($r, true) . "</pre>";
  echo "<pre>" . var_export($sql->errorInfo(), true) . "</pre>";
}
 ?>
