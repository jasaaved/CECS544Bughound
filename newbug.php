<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>New Bug Page</title>
		
		<style>
			div.vertical-center {
			  display:flex;
			  align-items:center;
			}
			
			div.bottom-border{
				border-bottom: 2px solid gray;
			}
		</style>
    </head>
	<body>
		<?php
			$var = $_GET['user_name'];
			
			session_start();
			if ($var == NULL ||!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false || $_SESSION['username'] != $var) 
			{
				$message = "Please Login First";
				echo "<script type='text/javascript'>alert('$message');window.location.href='login.php';</script>";
				session_destroy();
				
			} 
			$con = mysqli_connect("localhost","root");
			mysqli_select_db($con, "bughound");
                        $username = $_GET['user_name']
                ?>
		<div class="bottom-border">
			<h1>New Bug Report Entry Page</h1>
		
			<form action="submitnewbug.php?user_name=<?php echo $username; ?>" method="post" enctype="multipart/form-data" onsubmit="return validate(this)">
				
				<label for="program">Program:</label>
				<select name="program">
					<option value=null></option>
					<?php
						$query = "SELECT * FROM program";
						$result = mysqli_query($con, $query);
						
						while($row=mysqli_fetch_row($result))
						{
							echo "<option value=$row[0]>$row[1] v" . $row[3] . "." . $row[2] . "</option>";
						}
					?>
				</select>
				
				<label for="report_type">Report Type:</label>
				<select name="report_type">
					<option value=null></option>
					<?php
						$query = "SELECT TRIM(TRAILING ')' FROM TRIM(LEADING '(' FROM TRIM(LEADING 'enum' FROM column_type))) column_type FROM information_schema.columns WHERE table_name = 'bug_report' AND column_name = 'report_type'";
						
						if ($result = mysqli_query($con, $query))
						{
							$row=mysqli_fetch_row($result);
							$enum=explode(',',$row[0]);
							
							for ($i=0; $i < sizeOf($enum); $i++)
							{
								$str = str_replace('\'', '', $enum[$i]);
								$val = $i+1;
								echo "<option value=$val>$str</option>";
							}
						}
					?>
				</select>
				
				<label for="severity">Severity:</label>
				<select name="severity">
					<option value=null></option>
					<?php
						$query = "SELECT TRIM(TRAILING ')' FROM TRIM(LEADING '(' FROM TRIM(LEADING 'enum' FROM column_type))) column_type FROM information_schema.columns WHERE table_name = 'bug_report' AND column_name = 'severity'";
						
						if ($result = mysqli_query($con, $query))
						{
							$row=mysqli_fetch_row($result);
							$enum=explode(',',$row[0]);
							
							for ($i=0; $i < sizeOf($enum); $i++)
							{
								$str = str_replace('\'', '', $enum[$i]);
								$val = $i+1;
								echo "<option value=$val>$str</option>";
							}
						}
					?>
				
				</select>
				
				<br>
				<br>
				
				
				<div class="vertical-center">
					<label for="problem_summary">Problem Summary:</label>
					<textarea rows="1" cols="80" name="problem_summary"></textarea>
                                        
                                        <input type="hidden" value="0" name="reproducible">
					<label for="reproducible">Reproducible?</label><input type="checkbox" value="1" name="reproducible">
				</div>
				
				<br>
				
				<div class="vertical-center">
					<label for="problem">Problem:</label>
					<textarea rows="3" cols="80" name="problem"></textarea>
				</div>
				
				<br>
				
				<div class="vertical-center">
					<label for="suggested_fix">Suggested Fix:</label>
					<textarea rows="3" cols="80" name="suggested_fix"></textarea>
				</div>
				

				<br>
				
				<label for="reported_by">Reported By:</label>
				<select name="reported_by">
					<option value=null></option>
					<?php
						$query = "SELECT * FROM employee";
						$result = mysqli_query($con, $query);
						
						while($row=mysqli_fetch_row($result))
						{
							echo "<option value=$row[0]>$row[1]</option>";
						}
					?>
				</select>
				
				<label for="date">Date:</label><input type="date" name="date">
				
				<br>
				<br>
				
				
			</div>
			
			<br>
			
			<label for="functional_area">Functional Area:</label>
			<select name="functional_area">
					<option value=null></option>
					<?php
						$query = "SELECT * FROM functional_area";
						$result = mysqli_query($con, $query);
						
						while($row=mysqli_fetch_row($result))
						{
							echo "<option value=$row[0]>$row[1]</option>";
						}
					?>
			</select>
			
                        <label for="assigned_to">Assigned To:</label>
			<?php
                            $username = $_GET['user_name'];
                            $query = "SELECT * FROM employee WHERE user_name='".$username."';";
                            
                            $result = mysqli_query($con, $query);
                            $row = mysqli_fetch_row($result);
                            $user_level = $row[4];
                            
                            if ($user_level !== '5')
                            {
                                echo "<select name=\"assigned_to\" disabled>";
                            }
                            else
                            {
                                echo "<select name=\"assigned_to\">";
                            }
                        ?>
                            <option value=null></option>
                            <?php
                                $query = "SELECT * FROM employee";
                                $result = mysqli_query($con, $query);

                                while($row=mysqli_fetch_row($result))
                                {
                                    echo "<option value=$row[0]>$row[1]</option>";
                                }
                            ?>
			</select>
			
			<br>
			<br>
			
			<div class="vertical-center">
				<label for="comments">Comments:</label>
				<textarea rows="3" cols="80" name="comments"></textarea>
			</div>
			
			<br>
			
			<label for="status">Status:</label>
			<select name="status">
					<?php
						$query = "SELECT TRIM(TRAILING ')' FROM TRIM(LEADING '(' FROM TRIM(LEADING 'enum' FROM column_type))) column_type FROM information_schema.columns WHERE table_name = 'bug_report' AND column_name = 'status'";
						
						if ($result = mysqli_query($con, $query))
						{
							$row=mysqli_fetch_row($result);
							$enum=explode(',',$row[0]);
							
							for ($i=0; $i < sizeOf($enum); $i++)
							{
								$str = str_replace('\'', '', $enum[$i]);
								$val = $i+1;
								echo "<option value=$val>$str</option>";
							}
						}
					?>
			</select>
			
			<label for="priority">Priority:</label>
                        
                        <?php
                            if ($user_level !== '5')
                            {
                                echo "<select name=\"priority\" disabled>";
                            }
                            else
                            {
                                echo "<select name=\"priority\">";
                            }
                            
                        ?>
                            <option value=null></option>
                            <?php
                                    $query = "SELECT TRIM(TRAILING ')' FROM TRIM(LEADING '(' FROM TRIM(LEADING 'enum' FROM column_type))) column_type FROM information_schema.columns WHERE table_name = 'bug_report' AND column_name = 'priority'";

                                    if ($result = mysqli_query($con, $query))
                                    {
                                            $row=mysqli_fetch_row($result);
                                            $enum=explode(',',$row[0]);

                                            for ($i=0; $i < sizeOf($enum); $i++)
                                            {
                                                    $str = str_replace('\'', '', $enum[$i]);
                                                    $val = $i+1;
                                                    echo "<option value=$val>$str</option>";
                                            }
                                    }
                            ?>
			</select>
			
			<label for="resolution">Resolution:</label>
			<select name="resolution">
					<option value=null></option>
					<?php
						$query = "SELECT TRIM(TRAILING ')' FROM TRIM(LEADING '(' FROM TRIM(LEADING 'enum' FROM column_type))) column_type FROM information_schema.columns WHERE table_name = 'bug_report' AND column_name = 'resolution'";
						
						if ($result = mysqli_query($con, $query))
						{
							$row=mysqli_fetch_row($result);
							$enum=explode(',',$row[0]);
							
							for ($i=0; $i < sizeOf($enum); $i++)
							{
								$str = str_replace('\'', '', $enum[$i]);
								$val = $i+1;
								echo "<option value=$val>$str</option>";
							}
						}
					?>
			</select>
			
			<label for="resolution_version">Resolution Version:</label>
			<select name="resolution_version">
					<option value=null></option>
					<?php
						$query = "SELECT TRIM(TRAILING ')' FROM TRIM(LEADING '(' FROM TRIM(LEADING 'enum' FROM column_type))) column_type FROM information_schema.columns WHERE table_name = 'bug_report' AND column_name = 'resolution_version'";
						
						if ($result = mysqli_query($con, $query))
						{
							$row=mysqli_fetch_row($result);
							$enum=explode(',',$row[0]);
							
							for ($i=0; $i < sizeOf($enum); $i++)
							{
								$str = str_replace('\'', '', $enum[$i]);
								$val = $i+1;
								echo "<option value=$val>$str</option>";
							}
						}
					?>
			</select>
			
			<br>
			<br>
			
			<label for="resolved_by">Resolved By:</label>
			<select name="resolved_by">
					<option value=null></option>
					<?php
						$query = "SELECT * FROM employee";
						$result = mysqli_query($con, $query);
						
						while($row=mysqli_fetch_row($result))
						{
							echo "<option value=$row[0]>$row[1]</option>";
						}
					?>
			</select>
			
			<label for="resolved_date">Resolved Date:</label><input type="date" name="resolved_date">
			
			<label for="tested_by">Tested By:</label>
			<select name="tested_by">
					<option value=null></option>
					<?php
						$query = "SELECT * FROM employee";
						$result = mysqli_query($con, $query);
						
						while($row=mysqli_fetch_row($result))
						{
							echo "<option value=$row[0]>$row[1]</option>";
						}
					?>
			</select>
			
			<label for="tested_date">Tested Date:</label><input type="date" name="tested_date">
			
			<br>
			<br>
			
			<label for="attachment">Attachment:</label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                        <input id="attachment" name="file_name[]" type="file" multiple/>
			
                        <input type="hidden" value="0" name="treat_as_deferred"/>
			<label for="treat_as_deferred">Treat as Deferred?</label><input type="checkbox" value="1" name="treat_as_deferred">
			
			<br>
			<br>
            <input type="submit" name="Submit" value="Submit"/>
			<input type="reset" value="Reset"/>
			<input type="button" value="Cancel" id=button2 name=button2 onclick="go_home()"/>
        </form>
	
	    <script language=Javascript>
			function validate(theform) {
				if(theform.program.value === "null"){
					alert ("Must select a program");
					return false;
				}
				if(theform.report_type.value === "null"){
					alert ("Must select a report type");
					return false;
				}
				if(theform.severity.value === "null"){
					alert ("Must select a severity");
					return false;
				}
				if(theform.problem_summary.value === ""){
					alert ("Problem Summary field must contain charaters");
					return false;
				}
				if(theform.problem.value === ""){
                    alert ("Problem field must contain charaters");
                    return false;
                }
                if(theform.reported_by.value === "null"){
                    alert ("Reported by field must not be empty");
                    return false;
				}
				if(theform.date.value === ""){
                    alert ("Must select a valid date");
                    return false;
				}
				
                return true;
            }
		
                function go_home(){
                window.location.replace("index.php?user_name=<?php echo $username?>");
            }
        </script>
	
	</body>

</html>