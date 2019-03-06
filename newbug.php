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
			$con = mysqli_connect("localhost","root");
			mysqli_select_db($con, "bughound");
			
        ?>
		<div class="bottom-border">
			<h1>New Bug Report Entry Page</h1>
		
			<form action="submitnewbug.php" method="post" onsubmit="return validate(this)">
				Program:
				<select name="program">
					<option value=null></option>
					<?php
						$query = "SELECT * FROM program";
						$result = mysqli_query($con, $query);
						
						while($row=mysqli_fetch_row($result))
						{
							echo "<option value=$row[0]>$row[1]</option>";
						}
					?>
				</select>
				
				Report Type:
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
				
				Severity:
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
					Problem Summary:
					<textarea rows="1" cols="80" name="problem_summary"></textarea>
				
					Reproducible? <input type="checkbox" name="reproducible">
				</div>
				
				<br>
				
				<div class="vertical-center">
					Problem:
					<textarea rows="3" cols="80" name="problem"></textarea>
				</div>
				
				<br>
				
				<div class="vertical-center">
					Suggested Fix:
					<textarea rows="3" cols="80" name="problem_summary"></textarea>
				</div>

				<br>
				
				Reported By:
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
				
				Date: <input type="date" name="date">
				
				<br>
				<br>
				
				
			</div>
			
			<br>
			<br>
			
			Functional Area:
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
			
			
			Assigned To:
			<select name="assigned_to">
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
				Comments:
				<textarea rows="3" cols="80" name="problem"></textarea>
			</div>
			
			<br>
			
			Status:
			<select name="status">
					<option value=null></option>
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
			
			Priority:
			<select name="priority">
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
			
			Resolution:
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
			
			Resolution Version:
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
			
			Resolved by:
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
			
			Date: <input type="date" name="resolved_date">
			
			Tested by:
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
			
			Treat as Deferred? <input type="checkbox" name="treat_as_deferred">
			
			<br>
			<br>
            <input type="submit" name="Submit" value="Submit">
			<!-- <input type="button" value="Reset" id=button1 name=button1 onclick="reset_form()"> -->
			<input type="button" value="Cancel" id=button2 name=button2 onclick="go_home()">
        </form>
	
	    <script language=Javascript>
			function validate(theform) {
                
                return true;
            }
		
            function go_home(){
                window.location.replace("index.php");
            }
        </script>
	
	
	
	</body>







</html>