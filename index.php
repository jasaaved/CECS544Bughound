<!DOCTYPE html>
<html>
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
</script>
    </body>
</html>
