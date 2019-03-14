<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>View Names</title>
    </head>
    <body>
	        <?php
			$name = $_GET['prog_name'];
			$version_number = $_GET['version_number'];
			$release_number = $_GET['release_number'];
			
?>
	 <h2>Functional Areas in <?php echo $name; ?> Version <?php echo $version_number; ?> Release <?php echo $release_number; ?></h2>
        <?php
			$id = $_GET['id'];
			$con = mysqli_connect("localhost","root");
			mysqli_select_db($con, "bughound");
			$query = "SELECT * FROM functional_and_prog WHERE progid = '".$id."'";
			$result = mysqli_query($con, $query);
			$rowcount=mysqli_num_rows($result); 
			if ($rowcount == 0) {
				printf("<font size='3'</font>No Functional Areas\n");
			}
			
			else{
				while($row=mysqli_fetch_row($result))
				{
					$area_name = $row[2];
					printf("<p><font size='3'</font>•%s\n</p>", $area_name);
				}
				
			}
        ?>
        </table>

		
        <p><INPUT type="button" value="Add Area" id=button1 name=button1 onclick="addarea()"><INPUT type="button" value="Remove Area" id=button1 name=button1 onclick="removea()"><INPUT type="button" value="Return" id=button1 name=button1 onclick="go_home()">
        <script language=Javascript>
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

            function go_home() {
                var usrname = getQueryVariable("user_name");
                window.location.replace("areas.php?user_name="+usrname);
            }
			
			function addarea(){
				var usrname = getQueryVariable("user_name");
				var prog_name = getQueryVariable("prog_name");
				var version_number = getQueryVariable("version_number");
				var release_number = getQueryVariable("release_number");
				var id = getQueryVariable("id");
				window.location.replace("addarea.php?user_name="+usrname+"&prog_name="+prog_name+"&version_number="+version_number+"&release_number="+release_number+"&id="+id);
			}
			
			function addarea(){
				var usrname = getQueryVariable("user_name");
				var prog_name = getQueryVariable("prog_name");
				var version_number = getQueryVariable("version_number");
				var release_number = getQueryVariable("release_number");
				var id = getQueryVariable("id");
				window.location.replace("addarea.php?user_name="+usrname+"&prog_name="+prog_name+"&version_number="+version_number+"&release_number="+release_number+"&id="+id);
			}
			
			function removea(){
				var usrname = getQueryVariable("user_name");
				var prog_name = getQueryVariable("prog_name");
				var version_number = getQueryVariable("version_number");
				var release_number = getQueryVariable("release_number");
				var id = getQueryVariable("id");
				window.location.replace("removearea.php?user_name="+usrname+"&prog_name="+prog_name+"&version_number="+version_number+"&release_number="+release_number+"&id="+id);
			}
			

		</script>    
    </body>
</html>