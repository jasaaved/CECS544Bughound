<!DOCTYPE html>
<html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <head>
        <meta charset="UTF-8">
        <title>Bughound Employees</title>
    </head>
    <body>
        <h1>Bughound</h1>
		<?php
			$var = $_GET['user_name'];
		?>
	<p>
	<h3>
	<A href="addemployee.php?user_name=<?php echo $var; ?>"+><span class=\"linkline\">Add Employee</span></a> 
	<span class="tab"></span></p>
	<A href="viewemployees.php?user_name=<?php echo $var; ?>"><span class=\"linkline\">View/Edit Employees</span></a>
	<span class="tab"></span></p>
	<A href="viewprograms.php?user_name=<?php echo $var; ?>"><span class=\"linkline\">Add/View Programs</span></a>
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
			
			function do_ajax(user_name){
				return theAjax("VerifyUserLevel", user_name);
			}
			
			function theAjax(method, user_name){
				return $.ajax({
					url: 'verifylogin.php',
					type: 'POST',
					data: {method: method, user_name: user_name},
					success: function(data){
						if (data == 5){
							$('body').append('<h1>Only a level 5 user can see this</h1>');
						}

					}
				});
			}
			
			var usrlvl = getQueryVariable("user_name");
			ajax =  do_ajax(usrlvl);

		</script>
    </body>
</html>
