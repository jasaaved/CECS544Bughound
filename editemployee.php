<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add</title>
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
        
        <form action="submitemployeeedit.php?user_name=<?php echo $var_name; ?>&var_name=<?php echo $var; ?>" method="post" onsubmit="return validate(this)">
            <table>
                <tr><td>Name:</td><td><input type="Text" name="name" value="<?php echo $row[1]; ?>"></td></tr>
                <tr><td>User Name:</td><td><input type="Text" name="user_name" value="<?php echo $row[2]; ?>"></td></tr>
				<tr><td>Password:</td><td><input type="Text" name="password" value="<?php echo $row[3]; ?>"></td></tr>
                <tr><td>User Level:</td><td><input type="Text" name="user_level" value="<?php echo $row[4]; ?>"></td></tr>				
            </table>
            <input type="submit" name="Submit" value="Next">
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
                return true;
            }
			function go_home(){
                window.location.replace("index.php?<?php echo $var_name; ?>");
            }
</script>
    </body>
</html>