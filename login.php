<!DOCTYPE html>
<html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <head>
        <meta charset="UTF-8">
        <title>Login Bughound</title>
    </head>
    <body>
		<?php
         /* Defining a PHP Function */
		 
		 
         function check_username($user_name) {
			$con = mysqli_connect("localhost","root");
		    mysqli_select_db($con, "bughound");
			$query = "SELECT * FROM employee WHERE user_name = ".$user_name."";
			$result = mysqli_query($con, $query);
			if (empty($result))
				return 0;
			return ;
         }
         
      ?>
        <form action="index.php" method="post" onsubmit="return validate(this)">
            <table>
                <tr><td>User Name:</td><td><input type="Text" name="user_name"</td></tr>
				<tr><td>Password:</td><td><input type="Text" name="password"</td></tr>			
            </table>
            <input type="submit" name="Submit" value="Login">
        </form>
	<p>
	<h3>
	</h3>
	</p>
        <script language=Javascript>
            function validate(theform) {
		
                if(theform.user_name.value === ""){
                    alert ("User name field must contain characters");
                    return false;
                }
				if(theform.password.value === ""){
                    alert ("Password field must contain characters");
                    return false;
                }
				
				ajax =  do_ajax(theform.user_name.value, theform.password.value);
				return false;
            }
			function go_home(){
                window.location.replace("index.php");
            }
			
			function do_ajax(user_name, password){
				return theAjax("VerifyLogin", user_name, password);
			}
			
			function theAjax(method, user_name, password){
				return $.ajax({
					url: 'verifylogin.php',
					type: 'POST',
					data: {method: method, user_name: user_name, password: password},
					success: function(data){
						if (data == 0){
							alert("User name does not exist");
						}
						
						else if (data == 1){
							alert("Password is incorrect");
						}
						
						else{
							document.location.href="index.php?user_name="+user_name;
						}

					}
				});
			}
</script>
    </body>
</html>