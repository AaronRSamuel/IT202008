<html>
	<head>
		<title>My Project - Register</title>
	</head>
	<body>
		<!-- this is how you comment -->
		<form>
			<input type="text" name="myFirstInput"/>
			<input type="submit" value="click it?"/>
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
?>
