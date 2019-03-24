<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <title>Bug Submitted</title>
	</head>
	
	<body>
		<h1>Bug Submitted</h1>
		<?php
                    $username = $_GET['user_name'];
					$var = $_GET['user_name'];
			
					session_start();
					if ($var == NULL ||!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false || $_SESSION['username'] != $var) 
					{
						$message = "Please Login First";
						echo "<script type='text/javascript'>alert('$message');window.location.href='login.php';</script>";
						session_destroy();
						
					} 
                    function build_query()
                    {
                        $con = mysqli_connect("localhost","root");
                        if ($con->connect_error) {
                            die("Connection failed: " . $con->connect_error);
                        } 
                    
                        $bug_id = $_POST['bug_id'];
                        $program = $_POST['program'];
                        $report_type = $_POST['report_type'];
                        $severity = $_POST['severity'];
                        $problem_summary = $_POST['problem_summary'];
                        $reproducible = $_POST['reproducible'];
                        $problem = $_POST['problem'];
                        $suggested_fix = $_POST['suggested_fix'];
                        $reported_by = $_POST['reported_by'];
                        $date = $_POST['date'];
                        $functional_area = $_POST['functional_area'];
                        $assigned_to = $_POST['assigned_to'];
                        $comments = $_POST['comments'];
                        $status = $_POST['status'];
                        $priority = $_POST['priority'];
                        $resolution = $_POST['resolution'];
                        $resolution_version = $_POST['resolution_version'];
                        $resolved_by = $_POST['resolved_by'];
                        $resolved_date = $_POST['resolved_date'];
                        $tested_by = $_POST['tested_by'];
                        $tested_date = $_POST['tested_date'];
                        $attachment = $_FILES['file_name']['name'];
                        $treat_as_deferred = $_POST['treat_as_deferred'];
                        
                        $problem_summary = mysqli_real_escape_string($con, $problem_summary);
                        $problem = mysqli_real_escape_string($con, $problem);
                        $suggested_fix = mysqli_real_escape_string($con, $suggested_fix);
                        $comments = mysqli_real_escape_string($con, $comments);
                        
                        $update = "UPDATE bug_report SET programId='".$program."', report_type='".$report_type."', severity='".$severity."', problem_summary='".$problem_summary."', reproducible='".$reproducible."', problem='".$problem."', reported_by_employeeId='".$reported_by."', reported_date='".$date."'";
                        $where = " WHERE id='" . $bug_id . "';";
                        
                        $update .= ", suggested_fix='".$suggested_fix."'";
                        $update .= ", functional_areaId=".$functional_area."";
                        $update .= ", assigned_to_employeeId='".$assigned_to."'";
                        $update .= ", comments='".$comments."'";
                        $update .= ", status='".$status."'";
                        $update .= ", priority='".$priority."'";
                        $update .= ", resolution='".$resolution."'";
                        $update .= ", resolution_version='".$resolution_version."'";
                        $update .= ", resolved_by_employeeId='".$resolved_by."'";
                            
                        if($attachment !== "")
                        {
                            mysqli_select_db($con, "bughound");
                            
                            $att_query = "INSERT INTO attachment (file_name) VALUES ('" . mysqli_real_escape_string($con, basename($attachment)) . "');";
                            
                            if (!mysqli_query($con, $att_query)) {
                                echo "Error: " . $att_query . "<br>" . $con->error;
                            }

                            $att_query = "SELECT id FROM attachment WHERE file_name='" . mysqli_real_escape_string($con, basename($attachment)) . "';";
                            $result = mysqli_query($con, $att_query);
                            $row=mysqli_fetch_row($result);

                            $update .= ", attachmentId='".$row[0]."'";
                            
                            define ('SITE_ROOT', realpath(dirname(__FILE__)));
                            
                            $uploaddir = SITE_ROOT . "/Attachments/" . $row[0] . "/";
                            if (!is_dir($uploaddir))
                            {
                                mkdir($uploaddir);
                            }
                            
                            $uploadfile = $uploaddir . basename($attachment);
                            echo '<pre>';
                            if (move_uploaded_file($_FILES['file_name']['tmp_name'], $uploadfile)) {
                                echo "File is valid, and was successfully uploaded.\n";
                            } else {
                                echo "Possible file upload attack!\n";
                            }
                            print "</pre>";
                        }
                        
                            if ($resolved_date !== "")
                            {
                                $update .= ", resolved_date='".$resolved_date."'";
                            }
                            
                            $update .= ", tested_by_employeeId='".$tested_by."'";
                            
                            if ($tested_date !== "")
                            {
                                $update .= ", tested_date='".$tested_date."'";
                            }
                            
                            $update .= ", treat_as_deferred='".$treat_as_deferred."'";

                        $query = $update . $where;

                        return $query;
                    }


                    $query = build_query();
                   // echo $query;

                    $con = mysqli_connect("localhost","root");
                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    } 
                    mysqli_select_db($con, "bughound");

                    if (mysqli_query($con, $query)) {
                        echo "Records updated successfully";
                    } else {
                        echo "Error: " . $query . "<br>" . $con->error;
                    }
                ?>
                <form action="index.php?user_name=<?php echo $username?>" method="post">
                    <input type="Submit" value="Return to Home">
                </form>
            
	</body>
        <script language=Javascript>
                function go_home(){
                window.location.replace("index.php?user_name=<?php echo $username?>");
            }
        </script>

</html>