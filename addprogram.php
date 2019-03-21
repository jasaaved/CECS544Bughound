<!DOCTYPE html>
<html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <head>
        <meta charset="UTF-8">
        <title>Add</title>
    </head>
    <body>
        <h1>Add Program</h1>
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
        <form action="viewprograms.php?user_name=<?php echo $var; ?>" method="post" onsubmit="return validate(this)">
            <table>
                <tr><td>Program:</td><td><input type="Text" name="name"</td></tr>
                <tr><td>Version Number:</td><td><input type="Text" name="version_number"</td></tr>
				<tr><td>Release Number:</td><td><input type="Text" name="release_number"</td></tr>				
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
                    alert ("Program name must contain characters");
                    return false;
                }
                if(theform.version_number.value === ""){
                    alert ("Version Number field must contain characters");
                    return false;
                }
				if(theform.release_number.value === ""){
                    alert ("Release Number field must contain characters");
                    return false;
                }
				
                ajax =  do_ajax(theform.name.value, theform.version_number.value, theform.release_number.value);
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
			function go_home(){
				var usrname = getQueryVariable("user_name");
                window.location.replace("viewprograms.php?user_name="+usrname);
            }
			
			function do_ajax(name, version_number, release_number){
				return theAjax("VerifyAddProgram", name, version_number, release_number);
			}
			
			function theAjax(method, name, version_number, release_number){
				return $.ajax({
					url: 'verifylogin.php',
					type: 'POST',
					data: {method: method, name: name, version_number: version_number, release_number: release_number},
					success: function(data){
						if (data == 0){
							alert("Program with same Release and Version Number  already exists");
						}
						
						else{
							var usrname = getQueryVariable("user_name");
							document.location.href="viewprograms.php?user_name="+usrname;
						}

					}

				});
			}
</script>
    </body>
</html>