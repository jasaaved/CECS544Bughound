<!DOCTYPE html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add</title>
    </head>
    <body>
		        <?php
			$name = $_GET['prog_name'];
			$version_number = $_GET['version_number'];
			$release_number = $_GET['release_number'];
			
?>
        <h1>Add Area to <?php echo $name; ?> Version <?php echo $version_number; ?> Release <?php echo $release_number; ?></h1>
			
 
			<?php
		    $id = $_GET['id'];
			$con = mysqli_connect("localhost","root");
			mysqli_select_db($con, "bughound");
			$query = "SELECT * FROM functional_and_prog WHERE progid = '".$id."'";
			$result = mysqli_query($con, $query);
			if(mysqli_num_rows($result)){
				$select= '<select id="select">';
				while($row=mysqli_fetch_array($result)){
					$select.='<option value="'.$row[0].'">'.$row[2].'</option>';
				}
			}
			$select.='</select>';
			echo $select;
		?>
	<p>
	<input type="button" value="Remove" id=button1 name=button1 onclick="removef()"><input type="button" value="Cancel" id=button1 name=button1 onclick="go_home()">
	<h3>
	</h3>
	</p>
        <script language=Javascript>
            function removef() {
				var $sel = $("#select");
				var value = $sel.val();
				ajax =  do_ajax(value);
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
			
			function do_ajax(value){
				return theAjax("VerifyRemoveArea", value);
			}
			
			function theAjax(method, value){
				return $.ajax({
					url: 'verifylogin.php',
					type: 'POST',
					data: {method: method, value: value},
					success: function(data){
						var usrname = getQueryVariable("user_name");
						var prog_name = getQueryVariable("prog_name");
						var version_number = getQueryVariable("version_number");
						var release_number = getQueryVariable("release_number");
						var id = getQueryVariable("id");
						window.location.replace("editareas.php?user_name="+usrname+"&prog_name="+prog_name+"&version_number="+version_number+"&release_number="+release_number+"&id="+id);
					}

				});
			}
			function go_home(){
				var usrname = getQueryVariable("user_name");
				var prog_name = getQueryVariable("prog_name");
				var version_number = getQueryVariable("version_number");
				var release_number = getQueryVariable("release_number");
				var id = getQueryVariable("id");
				window.location.replace("editareas.php?user_name="+usrname+"&prog_name="+prog_name+"&version_number="+version_number+"&release_number="+release_number+"&id="+id);
            }
</script>
    </body>
</html>