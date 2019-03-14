<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>View Names</title>
    </head>
    <body>
        <?php
			$con = mysqli_connect("localhost","root");
			$var = $_GET['user_name'];
			mysqli_select_db($con, "bughound");
			$query = "SELECT id, name FROM employee";
			$result = mysqli_query($con, $query); 
			echo "<table border=1 ><th>EMP ID</th><th> Name</Th>\n";
			$none = 0;
			while($row=mysqli_fetch_row($result))
			{
				$none=1;
				$id=$row[0];
				$var_name;
				printf("<tr><td><A href=\"editemployee.php?user_name=$var&var_name=$id\">%d</a></td><td>%s</td></tr>\n",$row[0], $row[1]);
			}
        ?>
        </table>
        <?php
            if($none==0)
				echo "<h3>No matching records found.</h3>\n";
        ?>
		<p><INPUT type="button" value="Add Employee" id=button1 name=button1 onclick="add()">
        <INPUT type="button" value="Return" id=button1 name=button1 onclick="go_home()">
		
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
			
			function add(){
				var usrname = getQueryVariable("user_name");
                window.location.replace("addemployee.php?user_name="+usrname);
			}

		</script>    
    </body>
</html>