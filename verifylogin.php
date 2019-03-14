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
					echo 1;
				}
				
				else if ($row[4] == 0){
					echo 0;
				}
				
				else{
					echo $row[4];
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
		
         echo $_POST["method"]();
?>