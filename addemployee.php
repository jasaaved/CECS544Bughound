<!DOCTYPE html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add</title>
    </head>
    <body>
        <h1>Add Employee</h1>
		<?php
			$var = $_GET['user_name'];
			
			session_start();
			if ($var == NULL ||!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false || $_SESSION['username'] != $var) 
			{
				$message = "Please Login First";
				echo "<script type='text/javascript'>alert('$message');window.location.href='login.php';</script>";
				session_destroy();
				
			}
		?>
        <form action="viewemployees.php?user_name=<?php echo $var; ?>" method="post" onsubmit="return validate(this)">
            <table>
                <tr><td>Name:</td><td><input type="Text" name="name"</td></tr>
                <tr><td>User Name:</td><td><input type="Text" name="user_name"</td></tr>
				<tr><td>Password:</td><td><input type="Text" name="password"</td></tr>
                <tr><TD class = "select">User Level:         
    </TD>   
    <TD>
       <select name = "user_level">        
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
			<option value="5">5</option>
       </select>
    </TD>        
</TR>				
            </table>
            <input type="submit" name="Submit" value="Submit">
			<input type="button" value="Cancel" id=button1 name=button1 onclick="go_home()">
        </form>
	<p>
	<h3>
	</h3>
	</p>
        <script language=Javascript>
            function validate(theform) {
                if(theform.name.value === ""){
                    alert ("Name field must contain characters");
                    return false;
                }
                if(theform.user_name.value === ""){
                    alert ("User name field must contain characters");
                    return false;
                }
				if(theform.password.value === ""){
                    alert ("Password field must contain characters");
                    return false;
                }
				if(theform.user_level.value === ""){
                    alert ("User level field must contain characters");
                    return false;
                }
				ajax =  do_ajax(theform.name.value, theform.user_name.value, theform.password.value, theform.user_level.value);
				return false;
            }
			function getQueryVariable(variable)
			{
				   var query = window.location.search.substring(1);
				   var vars = query.split("&");
				   for (var i=0;i<vars.length;i++) {
						   var pair = vars[i].split("=");
						   if(pair[0] == variable){return pair[1];}
				   }
				   return(false);
			}
			
			function do_ajax(name, user_name, password, user_level){
				return theAjax("VerifyAddEmployee", name, user_name, password, user_level);
			}
			
			function theAjax(method, name, user_name, password, user_level){
				return $.ajax({
					url: 'verifylogin.php',
					type: 'POST',
					data: {method: method, name: name, user_name: user_name, password: password, user_level: user_level},
					success: function(data){
						if (data == 0){
							alert("Username already exists");
						}
						
						else{
							var usrname = getQueryVariable("user_name");
							document.location.href="viewemployees.php?user_name="+usrname;
						}

					}

				});
			}
			function go_home(){
				var usrname = getQueryVariable("user_name");
                window.location.replace("viewemployees.php?user_name="+usrname);
            }
</script>
    </body>
</html>
