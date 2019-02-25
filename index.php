<!DOCTYPE html>
<html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <head>
        <meta charset="UTF-8">
        <title>BugHound Employees</title>
    </head>
    <body>
        <h1>Add/Edit Employees</h1>
	<p>
	<h3>
	<A href="addemployee.php"><span class=\"linkline\">Add Employee</span></a> 
	<span class="tab"></span></p>
	<A href="viewemployees.php"><span class=\"linkline\">View/Edit Employees</span></a> 
	</h3>
	</p>
        <script language=Javascript>
            function validate(theform) {
                if(theform.first.value === ""){
                    alert ("First name field must contain characters");
                    return false;
                }
                if(theform.last.value === ""){
                    alert ("Last name field must contain characters");
                    return false;
                }
                return true;
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
			
			var usrlvl = getQueryVariable("user_level");
			if (usrlvl == 5){
				$('body').append('<h1>Only a level 5 user can see this</h1>');
			}
		</script>
    </body>
</html>
