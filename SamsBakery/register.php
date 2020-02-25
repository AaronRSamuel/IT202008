<html>
        <head>
                <title>SamsBakery - Register</title>
                <style>
		                body{
			                   background-color: black;
  			                 background-image: url('https://media1.giphy.com/media/7Fg2pybimEBPdekrzX/giphy.gif');
                         height: 100%;
                         background-position: center;
                         background-repeat: no-repeat;
                         background-size: cover;
                         color: white;
		                     }
		           </style>
               <script>
                        function verifyEmail(form){
                                let ee = document.getElementById("email_error");
                                if(form.email.value.trim().length == 0){
                                        ee.innerText= "please enter correct email";
                                        return false;
                                }
                                else{
                                        ee.innerText = " ";
                                        return true;
                                }
                        }
                        function findFormsOnLand(){
                                let myForm = document.forms.regform;
                                let mySameForm = document.getelementById("myForm");
                                console.log("Form by name", myForm);
                                console.log("Form by id", mySameForm);
                        }
                        function verifyPasswords(form){
                                let pe = document.getElementById("password_error");
                                if(form.password.value != form.confirm.value){
                                        //alert("made a typo");
                                        pe.innerText = "Password doesnt match try again";
                                        return false;
                                }
                                pe.innerText= "";
                                return true;
                        }
                </script>
        </head>
        <body>
                <!-- this is how you comment -->
                <!-- " style = url("")" is how you set a background -->
                <form name="regform" id="myForm" method="POST" onsubmit="return doValidations(this)">
                                <!-- onsubmit= "return doValidations(this)" -->
                        <font size="6">
                        <div>
                                <lable for="email"> Email: </lable>
                                <input type="email" name="email" placeholder = Enter email/>
                                <span id="email_error"></span>
                        </div>
                        <div>
                                <lable for="password"> Password:<lable/>
                                <input type ="password" id="password" name= "password" placeholder = Password passowrd/>
                        </div>
                        <div>
                                <lable for ="conf"> Confirm Password:</lable>
                                <input type ="password" id= "conf" name="confirm" placeholder = Confirm passowrd/>
                        </div>
                        </font>
                        <div>
                                <di>&nbsp;</di>
                                <input type="submit" value="Register" style="height:50px; width:100px" />
                        </div>
            </form>
        </body>
</html>
<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(        isset($_POST['email'])
        && isset($_POST['password'])
        && isset($_POST['confirm'])
        ){                                                                                                                                    $pass = $_POST['password'];
        $conf = $_POST['confirm'];
        if($pass == $conf){
                //echo "All good, 'registering user'";
                $msg = "All good, your registered";
        }
        else{

                exit();
        }
        //let's hash it
        $pass = password_hash($pass, PASSWORD_BCRYPT);
        echo "<br>$pass<br>";
        //it's hashed
        require("config.php");
        $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try {
                $db = new PDO($connection_string, $dbuser, $dbpass);
                $stmt = $db->prepare("INSERT INTO `Coustomers`
                        (email, password, role) VALUES
                        (:email, :password, :role)");
                $email = $_POST['email'];
                $role = 'coustomer';
        $params = array(":email"=> $email, ":password"=> $pass, ":role"=> $role);
        $stmt->execute($params);
        echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
        }
        catch(Exception $e){
                echo $e->getMessage();
                exit();
        }
}
?>
