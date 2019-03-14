<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>View Functional Areas</title>
    </head>
    <body>
		<h1> Select Functional Area to Edit </h1>
        <?php
			$var = $_GET['user_name'];
			$con = mysqli_connect("localhost","root");
			mysqli_select_db($con, "bughound");
			$query = "SELECT id, department_name FROM functional_area";
			$result = mysqli_query($con, $query); 
			echo "<table border=1 ><th>Functional Areas</th><\n";
			$none = 0;
			while($row=mysqli_fetch_row($result))
			{
				$none=1;
				$id = $row[0];
				$name = $row[1];
				printf("<tr><td><A href=\"updatearea.php?user_name=$var&id=$id\">%s</a></td></tr>\n",$row[1]);
			}
        ?>
        </table>
        <?php
            if($none==0)
				echo "<h3>No matching records found.</h3>\n";
        ?>
		
        <p><INPUT type="button" value="Add Fuctional Area" id=button1 name=button1 onclick="add_area()"> <INPUT type="button" value="Return" id=button1 name=button1 onclick="go_home()">
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
			
			function add_area(){
				var usrname = getQueryVariable("user_name");
                window.location.replace("createarea.php?user_name="+usrname);
			}

		</script>    
    </body>
</html>