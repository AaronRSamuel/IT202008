<?php
session_start();
?>
<html>
	<head>
		<title>Home</title>
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
           .spacer {
             margin: 3rem 0 0 -3rem;
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
   <button type="button" onclick="location.href = 'https://web.njit.edu/~as3655/IT202008/SamsBakery/Login.php';"
           class = "button" name="Login"> Login & Logout
   </button>
   <button class = "button" type="button" onclick="location.href = 'https://web.njit.edu/~as3655/IT202008/SamsBakery/profile.php';"
		  name="button"> Profile</button>
		</button>
		<button class = "button" type="button" onclick="location.href = 'https://web.njit.edu/~as3655/IT202008/SamsBakery/custom_order.php';"
			name="button"> Coustom Order</button>
 </header>
  <body>
		<!-- This is how you comment -->
    <div>
        <font size="20">
        <center> Sam's Bakery </center>
        <font size="4">
        <center> Located at: Livingston, New Jersey </center>
    </div>
    <div class= "spacer">
      <br>
    </div>
    <div>
      <font size= "15">
        <center> Menu </center>
    </div>
		<div>
			<form method="post">
				<img src = "https://www.kingarthurflour.com/sites/default/files/styles/featured_image/public/2020-02/the-easiest-loaf-of-bread-youll-ever-bake.jpg?itok=j89yDeId"
				height="42" width="42"/>
				<button type="submit" name="Bread" value = "Bread">Bread</button>
			</form>
			<form method="post">
				<img src = "https://food.fnr.sndimg.com/content/dam/images/food/fullset/2011/4/20/0/PB0709H_Moist-and-Easy-Cornbread_s4x3.jpg.rend.hgtvcom.826.620.suffix/1371597397695.jpeg"
				height="42" width="42"/>
				<button type="submit" name="Corn_Bread" value = "Corn_Bread">Corn Bread</button>
			</form>
		</div>
	</body>
</html>

<?php
require ("config.php");
$user_Id = $_SESSION['id'];
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

if(isset($_POST["Bread"])) {
		$db= new PDO($connection_string, $dbuser, $dbpass);
		$stmt = $db->prepare(" INSERT INTO `Cart`
          (user_id, item_id, item_name, item_price) VALUES
          (:user_ID, :item_id, :item_name, :item_price)");
    $params = array(":user_ID"=> $user_Id, ":item_id" => 2, ":item_name" => "Bread", ":item_price" => 3);
    $stmt->execute($params);
    echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
 }
 if(isset($_POST["Corn_Bread"])) {
 		$db= new PDO($connection_string, $dbuser, $dbpass);
 		$stmt = $db->prepare(" INSERT INTO `Cart`
           (user_id, item_id, item_name, item_price) VALUES
           (:user_ID, :item_id, :item_name, :item_price)");
     $params = array(":user_ID"=> $user_Id, ":item_id" => 1, ":item_name" => "Corn Bread", ":item_price" => 3);
     $stmt->execute($params);
     echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
  }
 ?>
