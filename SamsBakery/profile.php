<?php
session_start();
if(isset($_SESSION['id'])){}
else{
  header("Location: https://web.njit.edu/~as3655/IT202008/SamsBakery/home.php");
}

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
    <button class = "button" type="button" onclick="location.href = 'https://web.njit.edu/~as3655/IT202008/SamsBakery/notification.php';"
   	  name="button"> Notifications</button>
  </head>
  <style>
  .button {
     background-color: gray;
     border: none;
     color: white;
     padding: 15px 32px;
     text-align: center;
     text-decoration: none;
     display: inline-block;
     font-size: 16px;
   }
  </style>
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
      <input type="submit" value="Change Password" style="height:50px; width:100px" />
    </form>
  </body>
</html>

<?php
if(        isset($_POST['password'])
        && isset($_POST['newPassword'])
        && isset($_POST['confirm'])
        ){
          require("config.php");
          $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
          $db = new PDO($connection_string, $dbuser, $dbpass);
          $pass = $_POST['newPassword'];
          $conf = $_POST['confirm'];
          $oldpass = $_POST['password'];
          $oldpass = password_hash($oldpass, PASSWORD_BCRYPT);
          if($pass == $conf){
                  $msg = "All good, your password is changed";
          }
          else{
            echo "passwords dont match";
            exit();
          }
          $passhash = password_hash($pass, PASSWORD_BCRYPT);
          try {
              $stmt = $db->prepare("UPDATE `Coustomers`
                      SET password = :password
                      WHERE id= :id ");
              $params = array(":password"=> $passhash, ":id"=> (int)$id);
              $stmt->execute($params);
              echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
            }
        catch(Exception $e){
              echo $e->getMessage();
              exit();
        }
}
?>
