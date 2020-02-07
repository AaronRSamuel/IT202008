<html>
	<head>
		<title>My Project - Register</title>
	</head>
	<body>
		<!-- this is how you comment -->
		<form method="POST"/> 
			<lable for="email"> Email:</lable>
			<input type="email" name="email" placeholder = Enter email"/>
			<lable for="password"> Password:<lable/>
			<input type ="password" name= "password"/>
			<lable for ="conf">confirm Password:</lable>
			<input type ="password" name="conf" placeholder = confirm passowrd"/>
			<input type="submit" value="register"/>
		</form>
	</body>
</html>

<?php

if(empty($_REQUEST) == false){
	echo "<REQUEST:pre>" . var_export($_REQUEST, true) . "</pre>";
}
if(empty($_GET) == false){
        echo "<GET:pre>" . var_export($_GET, true) . "</pre>";
}
if(empty($_POST) == false){
        echo "<GET:pre>" . var_export($_POST, true) . "</pre>";
}
if(  isset($_POST['email']) && isset($_POST['password']) && isset($_POST['conf'])){
	$pass = $_POST['password'];
	$conf = $_POST['conf'];
	if($pass == $conf){// check if the password and conf password is the same
		echo "All, good";
	}
	else{
		echo "learn to type";
	}
	$pass = 
	require("config.php");
	$db= new PDO($connection_string, $dbuser, $dbpass);
        echo "should have connected";
        $stmt = $db->prepare("INTSERT INTO `RegisterTest`(
                                `email'
                                `username` varchar(30) not null unique,
                                `pin` int default 0,
                                PRIMARY KEY (`id`)
                                ) CHARACTER SET utf8 COLLATE utf8_general_ci"
                        );	
}
?>
