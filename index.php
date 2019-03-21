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
			
			session_start();
			if ($var == NULL ||!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false || $_SESSION['username'] != $var) 
			{
				$message = "Please Login First";
				echo "<script type='text/javascript'>alert('$message');window.location.href='login.php';</script>";
				session_destroy();
				
			} 
	
			
		?>
	<p>
	<h3>
	<A href="newbug.php?user_name=<?php echo $var; ?>"><span class=\"linkline\">Create New Bug Report</span></a> 
	<span class="tab"></span></p>
	<A href="bugsearch.php?user_name=<?php echo $var; ?>"><span class=\"linkline\">Bug Search</span></a>
        <span class="tab"></span></p>
	</h3>
	</p>
        
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
							var usrlvl = getQueryVariable("user_name");			
							var view_edit_link = "viewemployees.php?user_name="+usrlvl;
							var programs_link = "viewprograms.php?user_name="+usrlvl;
							var areas_link = "areas.php?user_name="+usrlvl;
							var main_areas_link = "viewareas.php?user_name="+usrlvl;
							var export_link = "export.php?user_name="+usrlvl;
							var database_maintenance = "http://localhost/phpmyadmin/db_structure.php?server=1&db=bughound";
							$('body').append('<h2>Admin Control:</h2>');
							$('<h3><a href="'+view_edit_link+'"><span class=\"linkline\">View/Add/Edit Employee</span></a></h3>').appendTo($('body'));
							$('<h3><a href="'+programs_link+'"><span class=\"linkline\">View/Add/Edit Programs</span></a></h3>').appendTo($('body'));
							$('<h3><a href="'+main_areas_link+'"><span class=\"linkline\">View/Add/Edit Functional Areas</span></a></h3>').appendTo($('body'));
							$('<h3><a href="'+areas_link+'"><span class=\"linkline\">Add/Remove Functional Areas From Programs</span></a></h3>').appendTo($('body'));
							$('<h3><a href="'+export_link+'"><span class=\"linkline\">Export</span></a></h3>').appendTo($('body'));
							$('<h3><a target="_blank" href="'+database_maintenance+'"><span class=\"linkline\">Database Maintenance</span></a></h3>').appendTo($('body'));
							
							
						}

					}
				});
			}
			
			var usrlvl = getQueryVariable("user_name");
			ajax =  do_ajax(usrlvl);

		</script>
    </body>
</html>
