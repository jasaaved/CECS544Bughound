<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>View Names</title>
    </head>
    <body>
        <?php
			$con = mysqli_connect("localhost","root");
			mysqli_select_db($con, "bughound");
			$query = "SELECT name, version_number, release_number FROM program";
			$result = mysqli_query($con, $query); 
			echo "<table border=1 ><th>Program Name</th><th> Version Number</Th><th> Release Number</Th>\n";
			$none = 0;
			while($row=mysqli_fetch_row($result))
			{
				$none=1;
				printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>\n",$row[0],$row[1],$row[2]);
			}
        ?>
        </table>
        <?php
            if($none==0)
				echo "<h3>No matching records found.</h3>\n";
        ?>
		
        <p><INPUT type="button" value="Add Program" id=button1 name=button1 onclick="add_program()"> <INPUT type="button" value="Return" id=button1 name=button1 onclick="go_home()">
        <script language=Javascript>

            function go_home() {
                window.location.replace("index.php");
            }
			
			function add_program(){
				window.location.replace("addprogram.php");
			}

		</script>    
    </body>
</html>