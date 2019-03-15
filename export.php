<!DOCTYPE html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Export</title>
    </head>
    <body>

        <h1>Export Database Data</h1>
			
         <form action="index.php?user_name=<?php echo $var; ?>" method="post" onsubmit="return validate(this)">
            <table>
            <tr><TD class = "select",>Database Tables:         
    </TD>   
    <TD>
       <select name = "Database">        
            <option value="1">All</option>
            <option value="2">Bug Reports</option>
            <option value="3">Programs</option>
            <option value="4">Functional Areas</option>
			<option value="5">Functional Areas in Programs</option>
			<option value="6">Employees</option>
			<option value="7">Attachments</option>
       </select>
    </TD>        
</TR>
           <tr><TD class = "select" id="format">Format:         
    </TD>   
    <TD>
       <select name = "Format">        
            <option value="1">ASCII</option>
            <option value="2">XML</option>
 
       </select>
    </TD>        
</TR>					
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
				ajax =  do_ajax(theform.Database.value, theform.Format.value);
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
			
			function do_ajax(database, format){
				return theAjax("Export", database, format);
			}
			
			function theAjax(method, database, format){
				return $.ajax({
					url: 'verifylogin.php',
					type: 'POST',
					data: {method: method, database:database, format:format},
					success: function(data){
						alert("File has been downloaded, check your folder");

					}

				});
			}
			function go_home(){
				var usrname = getQueryVariable("user_name");
				window.location.replace("index.php?user_name="+usrname);
            }
</script>
    </body>
</html>