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
 </style>
  <body>
  </body>
</html>
<?php
session_start();
session_unset();
session_destroy();
echo "You have been logged out";
echo var_export($_SESSION, true);
//get session cookie and delete/clear it for this session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
	//clones then destroys since it makes it's lifetime
	//negative (in the past)
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
?>
