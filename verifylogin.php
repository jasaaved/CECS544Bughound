<?php
         /* Defining a PHP Function */
		 
         function VerifyLogin() {
			$con = mysqli_connect("localhost","root");
		    mysqli_select_db($con, "bughound");
			$user_name = $_POST['user_name'];
			$password = $_POST['password'];
			$query = "SELECT * FROM employee WHERE user_name = '".$user_name."'";
			$result = mysqli_query($con, $query);
			$rowcount=mysqli_num_rows($result); 
			if ($rowcount == 0) {
				echo 0;
			}
			else {
				$row = mysqli_fetch_row($result);
				if ($row[3] != $password){
					echo -1;
				}
				else if ($row[4] == 0){
					echo 0;
				}
				else{
					echo -1;
				}
			}
		
         }
		 
		 function VerifyUserLevel() {
			$con = mysqli_connect("localhost","root");
		    mysqli_select_db($con, "bughound");
			$user_name = $_POST['user_name'];
			$query = "SELECT * FROM employee WHERE user_name = '".$user_name."'";
			$result = mysqli_query($con, $query);
			$rowcount=mysqli_num_rows($result); 
			if ($rowcount == 0) {
				echo 0;
			}
			else {
				$row = mysqli_fetch_row($result);
				echo $row[4];
			}
		 }
		 
		 function VerifyAddProgram() {
			$con = mysqli_connect("localhost","root");
		    mysqli_select_db($con, "bughound");
			$name = $_POST['name'];
			$version_number = $_POST['version_number'];
			$release_number = $_POST['release_number'];
			$query = "SELECT * FROM program WHERE name = '".$name."' AND version_number = '".$version_number."' AND release_number = '".$release_number."'";
			$result = mysqli_query($con, $query);
			$rowcount=mysqli_num_rows($result); 
			if ($rowcount != 0) {
				echo 0;
			}
			else {
				$query = "INSERT INTO program (name, version_number, release_number) VALUES ('".$name."','".$version_number."','".$release_number."')";
				mysqli_query($con, $query);
				echo 1;
			}
		 }
		 
		 function VerifyAddEmployee() {
			$con = mysqli_connect("localhost","root");
		    mysqli_select_db($con, "bughound");
			$name = $_POST['name'];
            $user_name = $_POST['user_name'];
			$password = $_POST['password'];
            $user_level = $_POST['user_level'];
			$query = "SELECT * FROM employee WHERE user_name = '".$user_name."'";
			$result = mysqli_query($con, $query);
			$rowcount=mysqli_num_rows($result); 
			if ($rowcount != 0) {
				echo 0;
			}
			else {
				$query = "INSERT INTO employee (name, user_name, password, user_level) VALUES ('".$name."','".$user_name."','".$password."','".$user_level."')";
				mysqli_query($con, $query);
				echo 1;
			}
		 }
		 
		 function VerifyEditEmployee() {
			$con = mysqli_connect("localhost","root");
		    mysqli_select_db($con, "bughound");
			$ID = $_POST['ID'];
			$name = $_POST['name'];
            $user_name = $_POST['user_name'];
			$password = $_POST['password'];
            $user_level = $_POST['user_level'];
			$query = "SELECT * FROM employee WHERE user_name = '".$user_name."' AND id <> '".$ID."'";
			$result = mysqli_query($con, $query);
			$rowcount=mysqli_num_rows($result); 
			if ($rowcount != 0) {
				echo 0;
			}
			else {
				$query = "INSERT INTO employee (id, name, user_name, password, user_level) VALUES ('".$ID."','".$name."','".$user_name."','".$password."','".$user_level."') ON DUPLICATE KEY UPDATE name=VALUES(name),user_name=VALUES(user_name),password=VALUES(password),user_level=VALUES(user_level)";
				mysqli_query($con, $query);
				echo 1;
			}
		 }		 

		 function VerifyDeleteEmployee() {
			$con = mysqli_connect("localhost","root");
		    mysqli_select_db($con, "bughound");
			$ID = $_POST['ID'];
			$query = "UPDATE employee SET user_level = 0 WHERE id = '".$ID."'";
			mysqli_query($con, $query);
		 }		
		 
		function VerifyEditProgram() {
			$con = mysqli_connect("localhost","root");
		    mysqli_select_db($con, "bughound");
			$ID = $_POST['ID'];
			$name = $_POST['name'];
            $version_number = $_POST['version_number'];
			$release_number = $_POST['release_number'];;
			$query = "SELECT * FROM program WHERE name = '".$name."' AND id <> '".$ID."' AND version_number = '".$version_number."' AND release_number = '".$release_number."'";
			$result = mysqli_query($con, $query);
			$rowcount=mysqli_num_rows($result); 
			if ($rowcount != 0) {
				echo 0;
			}
			else {
				$query = "INSERT INTO program (id, name, version_number, release_number) VALUES ('".$ID."','".$name."','".$version_number."','".$release_number."') ON DUPLICATE KEY UPDATE name=VALUES(name),version_number=VALUES(version_number),release_number=VALUES(release_number)";
				mysqli_query($con, $query);
				echo 1;
			}
		 }		 

		 function VerifyDeleteProgram() {
			$con = mysqli_connect("localhost","root");
		    mysqli_select_db($con, "bughound");
			$ID = $_POST['ID'];
			$query = "DELETE FROM bug_report WHERE programId = '".$ID."'";
			mysqli_query($con, $query);
			$query = "DELETE FROM program WHERE id = '".$ID."'";
			mysqli_query($con, $query);
		 }

		 function VerifyAddArea() {
			$con = mysqli_connect("localhost","root");
		    mysqli_select_db($con, "bughound");
			$id = $_POST['id'];
            $value= $_POST['value'];
			$text = $_POST['text'];
			$query = "INSERT INTO functional_and_prog (progid, funcname, funcid) VALUES ('".$id."','".$text."','".$value."')";
			mysqli_query($con, $query);
		}	

		 function VerifyRemoveArea() {
			$con = mysqli_connect("localhost","root");
		    mysqli_select_db($con, "bughound");
            $value= $_POST['value'];
			$query = "DELETE FROM functional_and_prog WHERE id = '".$value."'";
			mysqli_query($con, $query);
		}
		 function VerifyCreateArea() {
			$con = mysqli_connect("localhost","root");
		    mysqli_select_db($con, "bughound");
			$name = $_POST['name'];
			$query = "SELECT * FROM functional_area WHERE department_name = '".$name."'";
			$result = mysqli_query($con, $query);
			$rowcount=mysqli_num_rows($result); 
			if ($rowcount != 0) {
				echo 0;
			}
			else {
				$query = "INSERT INTO functional_area (department_name) VALUES ('".$name."')";
				mysqli_query($con, $query);
				echo 1;
			}
		 }
		function VerifyUpdateArea() {
			$con = mysqli_connect("localhost","root");
		    mysqli_select_db($con, "bughound");
			$ID = $_POST['ID'];
			$name = $_POST['name'];
			$query = "SELECT * FROM functional_area WHERE department_name = '".$name."' AND id <> '".$ID."'";
			$result = mysqli_query($con, $query);
			$rowcount=mysqli_num_rows($result); 
			if ($rowcount != 0) {
				echo 0;
			}
			else {
				$query = "INSERT INTO functional_area (id, department_name) VALUES ('".$ID."','".$name."') ON DUPLICATE KEY UPDATE department_name=VALUES(department_name)";
				mysqli_query($con, $query);
				$query = "UPDATE functional_and_prog SET funcname = '".$name."' WHERE funcid = '".$ID."'";
				mysqli_query($con, $query);
				echo 1;
			}
		 }
		 function VerifyDeleteArea() {
			$con = mysqli_connect("localhost","root");
		    mysqli_select_db($con, "bughound");
			$ID = $_POST['ID'];
			$query = "DELETE FROM functional_and_prog WHERE funcid = '".$ID."'";
			mysqli_query($con, $query);
			$query = "UPDATE bug_report SET functional_areaId = NULL WHERE functional_areaId = '".$ID."'";
			mysqli_query($con, $query);
			$query = "DELETE FROM functional_area WHERE id = '".$ID."'";
			mysqli_query($con, $query);
		 }

		function export(){
			$con = mysqli_connect("localhost","root");
		    mysqli_select_db($con, "bughound");
			$database_number = $_POST['database'];
			$format = $_POST['format'];
			if ($database_number == 2 && $format == 1){
					$query = "SELECT * FROM bug_report";
					$result=mysqli_query($con, $query);
					$file = "bugreport.txt";
					$fh = fopen($file, 'a') or die("can't open file");
					
				while($row=mysqli_fetch_array($result)){
					$ID = $row[0];
					$programId = $row[1];
					$report_type = $row[2];
					$severity = $row[3];
					$problem_summary = $row[4];
					$reproducible = $row[5];
					$problem = $row[6];
					$suggested_fix = $row[7];
					$reported_by = $row[8];
					$reported_date = $row[9];
					$attachmentid = $row[10];
					$funct = $row[11];
					$assignto = $row[12];
					$comments = $row[13];
					$status = $row[14];
					$prio = $row[15];
					$res = $row[16];
					$res_version = $row[17];
					$resolved_by = $row[18];
					$resolveddate = $row[19];
					$tested_by = $row[20];
					$testeddate = $row[21];
					$deferred = $row[22];
					$bugs = "Bug Report ID: $ID, Program ID: $programId,  Report Type: $report_type, Severity: $severity, Problem Summary: $problem_summary, Reproducible: $reproducible, Problem: $problem, Suggested Fix: $suggested_fix, Reported By: $reported_by, Reported Date: $reported_date, AttachmentID: $attachmentid, Function Area ID: $funct, Assigned to: $assignto, Comments: $comments, Status: $status, Priority: $prio, Resolution: $res, Resolved Version: $res_version, Resolved By: $resolved_by, Resolved Date: $resolveddate, Tested By: $tested_by,Tested Date: $testeddate, Treat as Deferred: $deferred\n";
					fwrite($fh, $bugs);
				}
				fwrite($fh, "\n");
				fclose($fh);
				
			}
			else if ($database_number == 3 && $format == 1){
					$query = "SELECT * FROM program";
					$result=mysqli_query($con, $query);
					$file = "programs.txt";
					$fh = fopen($file, 'a') or die("can't open file");
					
				while($row=mysqli_fetch_array($result)){
					$ID = $row[0];
					$name = $row[1];
					$version_number = $row[2];
					$release_number = $row[3];
					$functions = "Program ID: $ID, Program Name: $name, Version Number: $version_number, Release Version: $release_number\n";
					fwrite($fh, $functions);
				}
				fwrite($fh, "\n");
				fclose($fh);
				
			}
			else if ($database_number == 4 && $format == 1){
					$query = "SELECT * FROM functional_area";
					$result=mysqli_query($con, $query);
					$file = "functionalareas.txt";
					$fh = fopen($file, 'a') or die("can't open file");
					
				while($row=mysqli_fetch_array($result)){
					$ID = $row[0];
					$name = $row[1];
					$functions = "Function Area ID: $ID, Function Area Name: $name\n";
					fwrite($fh, $functions);
				}
				fwrite($fh, "\n");
				fclose($fh);
				
			}
			else if ($database_number == 5 && $format == 1){
					$query = "SELECT * FROM functional_and_prog";
					$result=mysqli_query($con, $query);
					$file = "areasinprograms.txt";
					$fh = fopen($file, 'a') or die("can't open file");
					
				while($row=mysqli_fetch_array($result)){
					$ID = $row[0];
					$programid = $row[1];
					$functionname = $row[2];
					$functionid = $row[3];
					$functions = "ID: $ID Program ID: $programid, Function Area Name: $functionname, Function ID: $functionid\n";
					fwrite($fh, $functions);
				}
				fwrite($fh, "\n");
				fclose($fh);
				
			}
			else if ($database_number == 6 && $format == 1){
					$query = "SELECT * FROM employee";
					$result=mysqli_query($con, $query);
					$file = "employees.txt";
					$fh = fopen($file, 'a') or die("can't open file");
					
				while($row=mysqli_fetch_array($result)){
					$ID = $row[0];
					$name = $row[1];
					$user_name = $row[2];
					$password = $row[3];
					$user_level = $row[4];
					$functions = "Employee ID: $ID Employee Name: $name, User Name: $user_name, Password: $password, User level: $user_level\n";
					fwrite($fh, $functions);
				}
				fwrite($fh, "\n");
				fclose($fh);
				
			}
			else if ($database_number == 7 && $format == 1){
					$query = "SELECT * FROM attachment";
					$result=mysqli_query($con, $query);
					$file = "attachments.txt";
					$fh = fopen($file, 'a') or die("can't open file");
					
				while($row=mysqli_fetch_array($result)){
					$ID = $row[0];
					$name = $row[1];
					$functions = "Attachment ID: $ID Attachment Name: $name\n";
					fwrite($fh, $functions);
				}
				fwrite($fh, "\n");
				fclose($fh);
				
			}
			
			else if ($database_number == 1 && $format == 1){
					$file = "all.txt";
					$fh = fopen($file, 'a') or die("can't open file");

					
					
				$query = "SELECT * FROM bug_report";
					$result=mysqli_query($con, $query);
					
				while($row=mysqli_fetch_array($result)){
					$ID = $row[0];
					$programId = $row[1];
					$report_type = $row[2];
					$severity = $row[3];
					$problem_summary = $row[4];
					$reproducible = $row[5];
					$problem = $row[6];
					$suggested_fix = $row[7];
					$reported_by = $row[8];
					$reported_date = $row[9];
					$attachmentid = $row[10];
					$funct = $row[11];
					$assignto = $row[12];
					$comments = $row[13];
					$status = $row[14];
					$prio = $row[15];
					$res = $row[16];
					$res_version = $row[17];
					$resolved_by = $row[18];
					$resolveddate = $row[19];
					$tested_by = $row[20];
					$testeddate = $row[21];
					$deferred = $row[22];
					$bugs = "Bug Report ID: $ID, Program ID: $programId,  Report Type: $report_type, Severity: $severity, Problem Summary: $problem_summary, Reproducible: $reproducible, Problem: $problem, Suggested Fix: $suggested_fix, Reported By: $reported_by, Reported Date: $reported_date, AttachmentID: $attachmentid, Function Area ID: $funct, Assigned to: $assignto, Comments: $comments, Status: $status, Priority: $prio, Resolution: $res, Resolved Version: $res_version, Resolved By: $resolved_by, Resolved Date: $resolveddate, Tested By: $tested_by,Tested Date: $testeddate, Treat as Deferred: $deferred\n";
					fwrite($fh, $bugs);
				}
				fwrite($fh, "\n");
				$result=mysqli_query($con, $query);
					
					
				while($row=mysqli_fetch_array($result)){
					$ID = $row[0];
					$name = $row[1];
					$version_number = $row[2];
					$release_number = $row[3];
					$functions = "Program ID: $ID, Program Name: $name, Version Number: $version_number, Release Version: $release_number\n";
					fwrite($fh, $functions);
				}
				fwrite($fh, "\n");
					$query = "SELECT * FROM functional_area";
					$result=mysqli_query($con, $query);
				
					
				while($row=mysqli_fetch_array($result)){
					$ID = $row[0];
					$name = $row[1];
					$functions = "Function Area ID: $ID, Function Area Name: $name\n";
					fwrite($fh, $functions);
				}
				fwrite($fh, "\n");
				
					$query = "SELECT * FROM functional_and_prog";
					$result=mysqli_query($con, $query);

					
				while($row=mysqli_fetch_array($result)){
					$ID = $row[0];
					$programid = $row[1];
					$functionname = $row[2];
					$functionid = $row[3];
					$functions = "ID: $ID Program ID: $programid, Function Area Name: $functionname, Function ID: $functionid\n";
					fwrite($fh, $functions);
				}
				fwrite($fh, "\n");
				
					$query = "SELECT * FROM employee";
					$result=mysqli_query($con, $query);
				
					
				while($row=mysqli_fetch_array($result)){
					$ID = $row[0];
					$name = $row[1];
					$user_name = $row[2];
					$password = $row[3];
					$user_level = $row[4];
					$functions = "Employee ID: $ID Employee Name: $name, User Name: $user_name, Password: $password, User level: $user_level\n";
					fwrite($fh, $functions);
				}
				fwrite($fh, "\n");
				
				$query = "SELECT * FROM attachment";
					$result=mysqli_query($con, $query);

					
				while($row=mysqli_fetch_array($result)){
					$ID = $row[0];
					$name = $row[1];
					$functions = "Attachment ID: $ID Attachment Name: $name\n";
					fwrite($fh, $functions);
				}
				fwrite($fh, "\n");
				

				fclose($fh);
				
			}
			else if ($database_number == 7 && $format == 2){
				$query = "SELECT * FROM attachment";
			    $result=mysqli_query($con, $query);
				$attachmentsArray = array();
				while($row=$result->fetch_assoc()){
					array_push($attachmentsArray, $row);
					
				}
				
				if(count($attachmentsArray)){
					createXMLfileatt($attachmentsArray);
				}

			}
			
			else if ($database_number == 6 && $format == 2){
				$query = "SELECT * FROM employee";
			    $result=mysqli_query($con, $query);
				$employeeArray = array();
				while($row=$result->fetch_assoc()){
					array_push($employeeArray, $row);
					
				}
				
				if(count($employeeArray)){
					createXMLfilee($employeeArray);
				}

			}
			
			else if ($database_number == 5 && $format == 2){
				$query = "SELECT * FROM functional_and_prog";
			    $result=mysqli_query($con, $query);
				$FPArray = array();
				while($row=$result->fetch_assoc()){
					array_push($FPArray, $row);
					
				}
				
				if(count($FPArray)){
					createXMLfileFP($FPArray);
				}

			}
			
			
				
			
		}

		function createXMLfileatt($attachmentsArray){
  
			   $filePath = 'attaments.xml';
			   $dom     = new DOMDocument('1.0', 'utf-8'); 
			   $root      = $dom->createElement('attachments'); 
			   for($i=0; $i<count($attachmentsArray); $i++){
				 
				 $attachmentsId        =  $attachmentsArray[$i]['id'];  
				 $attachmentName      =   $attachmentsArray[$i]['name'];
				   
				 $attachment = $dom->createElement('attachment');
				 $attachment->setAttribute('id', $attachmentsId);
				 $name     = $dom->createElement('name', $attachmentName); 
				 $attachment->appendChild($name); 
 
				 
				 $root->appendChild($attachment);
   }
   $dom->appendChild($root); 
   $dom->save($filePath); 
 }

		function createXMLfilee($employeeArray){
  
			   $filePath = 'employee.xml';
			   $dom     = new DOMDocument('1.0', 'utf-8'); 
			   $root      = $dom->createElement('attachments'); 
			   for($i=0; $i<count($employeeArray); $i++){
				 
				 $employeeId        =  $employeeArray[$i]['id'];  
				 $employeeName      =  $employeeArray[$i]['name'];
				 $employeeUserName =  $employeeArray[$i]['user_name'];
				 $employeePassword = $employeeArray[$i]['password'];
				 $employeelevel = $employeeArray[$i]['user_level'];
				 $employee = $dom->createElement('employee');
				 $employee->setAttribute('id', $employeeId);
				 $name     = $dom->createElement('name', $employeeName); 
				 $employee->appendChild($name); 
				 $username = $dom->createElement('user_name', $employeeUserName);
				 $employee->appendChild($username);
				 $password = $dom->createElement('password', $employeePassword); 
				 $employee->appendChild($password);
				 $level = $dom->createElement('user_level', $employeelevel);
				 $employee->appendChild($password);
				 $root->appendChild($employee);
   }
   $dom->appendChild($root); 
   $dom->save($filePath); 
 }

		function createXMLfileFP($FPArray){
  
			   $filePath = 'FP.xml';
			   $dom     = new DOMDocument('1.0', 'utf-8'); 
			   $root      = $dom->createElement('attachments'); 
			   for($i=0; $i<count($FPArray); $i++){
				 
				 $FPId        =  $FPArray[$i]['id'];  
				 $FPName      =  $FPArray[$i]['name'];
				 $FPUserName =  $FPrray[$i]['user_name'];
				 $employeePassword = $employeeArray[$i]['password'];
				 $employeelevel = $employeeArray[$i]['user_level'];
				 $employee = $dom->createElement('employee');
				 $employee->setAttribute('id', $employeeId);
				 $name     = $dom->createElement('name', $employeeName); 
				 $employee->appendChild($name); 
				 $username = $dom->createElement('user_name', $employeeUserName);
				 $employee->appendChild($username);
				 $password = $dom->createElement('password', $employeePassword); 
				 $employee->appendChild($password);
				 $level = $dom->createElement('user_level', $employeelevel);
				 $employee->appendChild($password);
				 $root->appendChild($employee);
   }
   $dom->appendChild($root); 
   $dom->save($filePath); 
 }  
		
         echo $_POST["method"]();
?>