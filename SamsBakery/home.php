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
   <right> <button class = "button" type="button" name="button"> Cart</button>
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
			<button type="button" name="Bread" onclick="<?php $_SESSION['Items']+="Bread" ?>">Bread</button>
		</div>
		<?php
		require ("config.php");
		$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
		$db= new PDO($connection_string, $dbuser, $dbpass);
		$product_array = $db_handle->runQuery("SELECT * FROM Items");
		if (!empty($product_array)) {
			foreach($product_array as $key=>$value){
		?>
			<div class="product-item">
			<form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div class="product-tile-footer">
			<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			</form>
	</div>
	<?php
		}
	}
	?>
	</body>
</html>
