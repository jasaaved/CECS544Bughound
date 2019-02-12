<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add</title>
    </head>
    <body>
        <h1>Add Employee</h1>
        <form action="submitemployeeinfo.php" method="post" onsubmit="return validate(this)">
            <table>
                <tr><td>Name:</td><td><input type="Text" name="name"</td></tr>
                <tr><td>User Name:</td><td><input type="Text" name="user_name"</td></tr>
				<tr><td>Password:</td><td><input type="Text" name="password"</td></tr>
                <tr><td>User Level:</td><td><input type="Text" name="user_level"</td></tr>				
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
                window.location.replace("index.php");
            }
</script>
    </body>
</html>
