<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Employee Added!</title>
    </head>
    <body>
        <h2>
            <?php
		$id = $_GET['var_name'];
                $name = $_POST['name'];
                $user_name = $_POST['user_name'];
		$password = $_POST['password'];
                $user_level = $_POST['user_level'];
                printf("You have edited employee %s.<p>",$name);
                $con = mysqli_connect("localhost","root");
                mysqli_select_db($con, "bughound");
                $query = "INSERT INTO employee (id, name, user_name, password, user_level) VALUES ('".$id."','".$name."','".$user_name."','".$password."','".$user_level."') ON DUPLICATE KEY UPDATE name=VALUES(name),user_name=VALUES(user_name),password=VALUES(password),user_level=VALUES(user_level)";
                mysqli_query($con, $query);
            ?>
            <p>
            <input type="button" value="Return" id=button1 name=button1 onclick="go_home()">    
        </h2>
        <script language=Javascript>
            function go_home(){
                window.location.replace("index.php");
            }
        </script>
            
    </body>
</html>