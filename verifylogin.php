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
		 
		 
		 
		
         echo $_POST["method"]();
?>