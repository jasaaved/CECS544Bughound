<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>View Names</title>
    </head>
    <body>
	<h2>Select Program to see Functional Areas</h2>
        <?php
			$var = $_GET['user_name'];
			$con = mysqli_connect("localhost","root");
			mysqli_select_db($con, "bughound");
			$query = "SELECT name, version_number, release_number, id FROM program";
			$result = mysqli_query($con, $query); 
			echo "<table border=1 ><th>Program Name</th><th> Version Number</Th><th> Release Number</Th>\n";
			$none = 0;
			while($row=mysqli_fetch_row($result))
			{
				$none=1;
				$prog_name = $row[0];
				$version_number = $row[1];
				$release_number = $row[2];
				$id = $row[3];
				printf("<tr><td><A href=\"editareas.php?user_name=$var&prog_name=$prog_name&version_number=$version_number&release_number=$release_number&id=$id\">%s</a></td><td>%s</td><td>%s</td></tr>\n",$row[0],$row[1],$row[2]);
			}
        ?>
        </table>
        <?php
            if($none==0)
				echo "<h3>No matching records found.</h3>\n";
        ?>
		
        <p><INPUT type="button" value="Return" id=button1 name=button1 onclick="go_home()">
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
                window.location.replace("index.php?user_name="+usrname);
            }
			

		</script>    
    </body>
</html>