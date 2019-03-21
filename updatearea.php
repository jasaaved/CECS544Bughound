<!DOCTYPE html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Area</title>
    </head>
    <body>
		
        <h1>Edit Functional Area</h1>
		<?php
			$var = $_GET['user_name'];
			
			session_start();
			if ($var == NULL ||!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false || $_SESSION['username'] != $var) 
			{
				$message = "Please Login First";
				echo "<script type='text/javascript'>alert('$message');window.location.href='login.php';</script>";
				session_destroy();
				
			} 
			$var_name = $_GET['user_name'];
			$id = $_GET['id'];
			$con = mysqli_connect("localhost","root");
			mysqli_select_db($con, "bughound");
			$query = "SELECT * FROM functional_area WHERE id = '".$id."'";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_row($result);
		?>
        
        <form action="viewareas.php?user_name=<?php echo $var_name; ?>" method="post" onsubmit="return validate(this)">
            <table>
				<tr><td>Functional Area ID:</td><td><input type="Text" name="ID" value="<?php echo $row[0]; ?>" readonly></td></tr>
                <tr><td>Functional Area Name:</td><td><input type="Text" name="name" value="<?php echo $row[1]; ?>"></td></tr>
			
            </table>
            <input type="submit" name="Submit" value="Submit">
			<input type="button" value="Delete Area" id=button1 name=button1 onclick="del(<?php echo $row[0]; ?>)">
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
                    alert ("Functional Area Name field must contain characters");
                    return false;
				}
				ajax =  do_ajax(theform.ID.value, theform.name.value);
				return false;
			}
			function do_ajax(ID, name){
				return theAjax("VerifyUpdateArea", ID, name);
			}
			
			function theAjax(method, ID, name){
				return $.ajax({
					url: 'verifylogin.php',
					type: 'POST',
					data: {method: method, ID: ID, name: name},
					success: function(data){
						if (data == 0){
							alert("Functional Area with that name already exists");
						}
						
						else{
							var usrname = getQueryVariable("user_name");
							document.location.href="viewareas.php?user_name="+usrname;
						}

					}

				});
			}
			
			function del(ID){
				ajax =  do_ajax2(ID);
				return false;
			}
			
			function do_ajax2(ID){
				return theAjax2("VerifyDeleteArea", ID);
			}
			
			function theAjax2(method, ID){
				return $.ajax({
					url: 'verifylogin.php',
					type: 'POST',
					data: {method: method, ID: ID},
					success: function(data){
							var usrname = getQueryVariable("user_name");
							document.location.href="viewareas.php?user_name="+usrname;
					}

				});
			}
			
			function go_home(){
				var usrname = getQueryVariable("user_name");
                window.location.replace("viewareas.php?user_name="+usrname);
            }
</script>
    </body>
</html>