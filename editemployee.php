<!DOCTYPE html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Employee</title>
    </head>
    <body>
		
        <h1>Edit Employee</h1>
		<?php
			$var = $_GET['var_name'];
			$var_name = $_GET['user_name'];
			$con = mysqli_connect("localhost","root");
			mysqli_select_db($con, "bughound");
			$query = "SELECT * FROM employee WHERE id = $var";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_row($result);
		?>
        
        <form action="viewemployees.php?user_name=<?php echo $var_name; ?>" method="post" onsubmit="return validate(this)">
            <table>
				<tr><td>User ID:</td><td><input type="Text" name="ID" value="<?php echo $row[0]; ?>" readonly></td></tr>
                <tr><td>Name:</td><td><input type="Text" name="name" value="<?php echo $row[1]; ?>"></td></tr>
                <tr><td>User Name:</td><td><input type="Text" name="user_name" value="<?php echo $row[2]; ?>"></td></tr>
				<tr><td>Password:</td><td><input type="Text" name="password" value="<?php echo $row[3]; ?>"></td></tr>
                                <tr><TD class = "select">User Level:         
    </TD>   
    <TD>
       <select name = "user_level">
			<option value="<?php echo $row[4]; ?>"selected disabled hidden><?php echo $row[4]; ?></option>	   
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
			<option value="5">5</option>
       </select>
    </TD>        
</TR>				
            </table>
            <input type="submit" name="Submit" value="Next">
			<input type="button" value="Delete User" id=button1 name=button1 onclick="del(<?php echo $row[0]; ?>)">
			<input type="button" value="Cancel" id=button1 name=button1 onclick="go_home()">
        </form>
		
	<p>
	<h3>
	</h3>
	</p>
        <script language=Javascript>
			function getQueryVariable(variable){
				   var query = window.location.search.substring(1);
				   var vars = query.split("&");
				   for (var i=0;i<vars.length;i++) {
						   var pair = vars[i].split("=");
						   if(pair[0] == variable){return pair[1];}
				   }
				   return(false);
			}
			
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
				ajax =  do_ajax(theform.ID.value, theform.name.value, theform.user_name.value, theform.password.value, theform.user_level.value);
				return false;
            }
			function do_ajax(ID, name, user_name, password, user_level){
				return theAjax("VerifyEditEmployee", ID, name, user_name, password, user_level);
			}
			
			function theAjax(method, ID, name, user_name, password, user_level){
				return $.ajax({
					url: 'verifylogin.php',
					type: 'POST',
					data: {method: method, ID: ID, name: name, user_name: user_name, password: password, user_level: user_level},
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
			
			function del(ID){
				alert(ID);
				ajax =  do_ajax2(ID);
				return false;
			}
			
			function do_ajax2(ID){
				return theAjax2("VerifyDeleteEmployee", ID);
			}
			
			function theAjax2(method, ID){
				return $.ajax({
					url: 'verifylogin.php',
					type: 'POST',
					data: {method: method, ID: ID},
					success: function(data){
							var usrname = getQueryVariable("user_name");
							document.location.href="viewemployees.php?user_name="+usrname;
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