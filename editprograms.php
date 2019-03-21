<!DOCTYPE html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Programs</title>
    </head>
    <body>
		
        <h1>Edit Programs</h1>
		<?php
			$prog_name = $_GET['prog_name'];
			$version_number = $_GET['version_number'];
			$release_number = $_GET['release_number'];
			$var = $_GET['user_name'];
			
			session_start();
			if ($var == NULL ||!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false || $_SESSION['username'] != $var) 
			{
				$message = "Please Login First";
				echo "<script type='text/javascript'>alert('$message');window.location.href='login.php';</script>";
				session_destroy();
				
			}
			$con = mysqli_connect("localhost","root");
			mysqli_select_db($con, "bughound");
			$query = "SELECT * FROM program WHERE name = '".$prog_name."' AND version_number = '".$version_number."' AND release_number = '".$release_number."'";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_row($result);
		?>
        
        <form action="viewemployees.php?user_name=<?php echo $var_name; ?>" method="post" onsubmit="return validate(this)">
            <table>
				<tr><td>Program ID:</td><td><input type="Text" name="ID" value="<?php echo $row[0]; ?>" readonly></td></tr>
                <tr><td>Program Name:</td><td><input type="Text" name="name" value="<?php echo $row[1]; ?>"></td></tr>
                <tr><td>Version Number:</td><td><input type="Text" name="VersionNumber" value="<?php echo $row[2]; ?>"></td></tr>
				<tr><td>Release Number:</td><td><input type="Text" name="ReleaseNumber" value="<?php echo $row[3]; ?>"></td></tr>				
            </table>
            <input type="submit" name="Submit" value="Submit">
			<input type="button" value="Delete Program" id=button1 name=button1 onclick="del(<?php echo $row[0]; ?>)">
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
                    alert ("Program Name field must contain characters");
                    return false;
                }
                if(theform.VersionNumber.value === ""){
                    alert ("Version Number field must contain characters");
                    return false;
                }
				if(theform.ReleaseNumber.value === ""){
                    alert ("Release Number field must contain characters");
                    return false;
                }

				ajax =  do_ajax(theform.ID.value, theform.name.value, theform.VersionNumber.value, theform.ReleaseNumber.value);
				return false;
            }
			function do_ajax(ID, name, version_number, release_number){
				return theAjax("VerifyEditProgram", ID, name, version_number, release_number);
			}
			
			function theAjax(method, ID, name, version_number, release_number){
				return $.ajax({
					url: 'verifylogin.php',
					type: 'POST',
					data: {method: method, ID: ID, name: name, version_number: version_number, release_number: release_number},
					success: function(data){
						if (data == 0){
							alert("Program already exists");
						}
						
						else{
							var usrname = getQueryVariable("user_name");
							document.location.href="viewprograms.php?user_name="+usrname;
						}

					}

				});
			}
			
			function del(ID){
				ajax =  do_ajax2(ID);
				return false;
			}
			
			function do_ajax2(ID){
				return theAjax2("VerifyDeleteProgram", ID);
			}
			
			function theAjax2(method, ID){
				return $.ajax({
					url: 'verifylogin.php',
					type: 'POST',
					data: {method: method, ID: ID},
					success: function(data){
							var usrname = getQueryVariable("user_name");
							document.location.href="viewprograms.php?user_name="+usrname;
					}

				});
			}
			
			function go_home(){
				var usrname = getQueryVariable("user_name");
                window.location.replace("viewprograms.php?user_name="+usrname);
            }
</script>
    </body>
</html>