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
  $sql = $db->prepare("SELECT comment from Comment WHERE user_id = :id");
  $sql->execute(array(":id"=>$id));
  echo "<pre>" . var_export($sql->errorInfo(), true) . "</pre>";
}
catch(Exception $e){
echo $e->getMessage();
exit("It didn't work");
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Notifications</title>
    <button class = "button" onclick="location.href = 'https://web.njit.edu/~as3655/IT202008/SamsBakery/home.php';"
    type="button" name="Home"> Home</button>
    <button class = "button" onclick="location.href = 'https://web.njit.edu/~as3655/IT202008/SamsBakery/Logout.php';"
    type="button" name="Logout" > Logout</button>
    <button class = "button" type="button" onclick="location.href = 'https://web.njit.edu/~as3655/IT202008/SamsBakery/profile.php';"
    name="button"> Profile</button>
  </head>
  <body>
    <table id = "Comments">
      <thread>
      <tr>
        <th>Comments</th>
      </tr>
    </thread>
    <tbody>
      <?php while( $row = $sql->fetch()) : ?>
      <tr>
          <td><?php echo $row['comment']; ?></td>
      </tr>
      <?php endwhile ?>
    </tbody>
  </body>
</html>
