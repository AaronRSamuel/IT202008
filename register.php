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

if(isset($_REQUEST)){
	echo "<pre>" . var_export($_REQUEST) . "</pre>";
}
?>
