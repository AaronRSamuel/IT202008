<?php
session_start();
echo $_SESSION['id'];
?>

<html>
  <head>
    <title> Profile </title>
    <button class = "button" onclick="location.href = 'https://web.njit.edu/~as3655/IT202008/SamsBakery/home.php';"
    type="button" name="Home"> Home</button>
    <button class = "button" onclick="location.href = 'https://web.njit.edu/~as3655/IT202008/SamsBakery/Logout.php';"
    type="button" name="Logout" > Logout</button>
    <button class = "button" type="button" onclick="location.href = 'https://web.njit.edu/~as3655/IT202008/SamsBakery/Cart.php';"
 		  name="button"> Cart</button>
  </head>
  <body>
    <form method="post">
      <label for="pass">Current Password:
			<input type="password" id="pass" name="password" placeholder="Enter curent password"/>
      <br>
      <label for="pass">New Password: </label>
			<input type="password" id="newPass" name="newPassword" placeholder="Enter new password"/>
      <br>
      <lable for ="conf"> Confirm Password:</lable>
      <input type ="password" id= "conf" name="confirm" placeholder = Confirm passowrd/>
      <br>
      <input type="submit" value="Register" style="height:50px; width:100px" />
    </form>
  </body>
</html>

<?php
if(        isset($_POST['password'])
        && isset($_POST['newPassword'])
        && isset($_POST['confirm'])
        ){
          $pass = $_POST['newPassword'];
          $conf = $_POST['confirm'];
          if($pass == $conf){
                  //echo "All good, 'registering user'";
                  $msg = "All good, your registered";
          }
          else{

                  exit();
          }
          $pass = password_hash($pass, PASSWORD_BCRYPT);
          require("config.php");
          $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
          try {
              $db = new PDO($connection_string, $dbuser, $dbpass);
              $stmt = $db->prepare("UPDATE `Coustomers`where id='$id'
                      (password) VALUES
                      (:password)");
      $params = array(":password"=> $pass);
      $stmt->execute($params);
      echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
      }
      catch(Exception $e){
              echo $e->getMessage();
              exit();
      }
}
?>
