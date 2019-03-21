<html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <head>
        <meta charset="UTF-8">
        <title>Add</title>
    </head>
    <body>
        <h1>Add Functional Area</h1>
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
        <form action="viewareas.php?user_name=<?php echo $var; ?>" method="post" onsubmit="return validate(this)">
            <table>
                <tr><td>Functional Area Name:</td><td><input type="Text" name="name"</td></tr>			
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
                    alert ("Functional Area Name field must contain characters");
                    return false;
                }
				
                ajax =  do_ajax(theform.name.value);
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
                window.location.replace("viewareas.php?user_name="+usrname);
            }
			
			function do_ajax(name){
				return theAjax("VerifyCreateArea", name);
			}
			
			function theAjax(method, name){
				return $.ajax({
					url: 'verifylogin.php',
					type: 'POST',
					data: {method: method, name: name},
					success: function(data){
						if (data == 0){
							alert("Functional Area with the same name already exists");
						}
						
						else{
							var usrname = getQueryVariable("user_name");
							document.location.href="viewareas.php?user_name="+usrname;
						}

					}

				});
			}
</script>
    </body>
</html>