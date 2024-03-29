<?php
session_start();
 ?>
<html>
	<head>
		<title>My Project - Login</title>
	</head>
  <style>
      body{
           background-color: black;
           background-image: url('https://static.dezeen.com/uploads/2012/02/dezeen_Baker-D-Chirico-by-March-Studio-1a.jpg');
           height: 100%;
           background-position: center;
           background-repeat: no-repeat;
           background-size: cover;
           color: white;
           }
					 .button {
              background-color: gray; /* Green */
              border: none;
              color: white;
              padding: 15px 32px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 16px;
            }
 </style>
	<header>
		<div align = "right">
			<button class = "button" onclick="location.href = 'https://web.njit.edu/~as3655/IT202008/SamsBakery/Logout.php';"
			type="button" name="Logout" > Logout</button>
      <button class = "button" onclick="location.href = 'https://web.njit.edu/~as3655/IT202008/SamsBakery/register.php';"
			type="button" name="Register" > Register</button>
			<button class = "button" onclick="location.href = 'https://web.njit.edu/~as3655/IT202008/SamsBakery/home.php';"
			type="button" name="Home"> Home</button>
		</div>
	<body>
		<!-- This is how you comment -->
    <div>
        <font size="6">
        <center> Welcome Back! </center>
		</div>

    <center><form name="loginform" id="myForm" method="POST">
			<label for="email">Email: </label>
			<input type="email" id="email" name="email" placeholder="Enter Email"/>
			<label for="pass">Password: </label>
			<input type="password" id="pass" name="password" placeholder="Enter password"/>
			<input type="submit" value="Login"/>
		</form></center>
	</body>
</html>
<?php
  ini_set('display_errors',1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);


  if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){
  	$pass = $_POST['password'];
  	$email = $_POST['email'];

  	//let's hash it
  	//$pass = password_hash($pass, PASSWORD_BCRYPT);
  	//echo "<br>$pass<br>";
  	//it's hashed
  	require("config.php");
  	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
  	try {
  		$db = new PDO($connection_string, $dbuser, $dbpass);
  		$stmt = $db->prepare("SELECT id, email, password from `Coustomers` where email = :email LIMIT 1");

          $params = array(":email"=> $email);
          $stmt->execute($params);
  		$result = $stmt->fetch(PDO::FETCH_ASSOC);
  		echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
  		if($result){
  			$userpassword = $result['password'];
  			if(password_verify($pass, $userpassword)){
  				$id = $result['id'];
  				//echo "You logged in with id of " . $id;
  				$stmt = $db->prepare("SELECT r.id, r.role_name from `Roles` r JOIN `UserRoles` ur on r.id = ur.role_id where ur.user_id = :id");
  				$stmt->execute(array(":id"=>$id));
  				$roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
  				if(!$roles){
  					$roles = array();
  				}
  				$user = array(
  					"id" => $id,
  					"email"=>$result['email'],
  					"roles"=> $roles);
  				$_SESSION['user'] = $user;
					$_SESSION['id'] = $id;
  				echo "Session: <pre>" . var_export($_SESSION, true) . "</pre>";
  			}
  			else{
  				echo "Failed to login, invalid password";
  			}
  		}
  		else{
  			echo "Invalid email";
  		}
  	}
  	catch(Exception $e){
  		echo $e->getMessage();
  		exit();
  	}
  }
?>
