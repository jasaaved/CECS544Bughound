<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <title>Bug Submitted</title>
	</head>
	
	<body>
		<h1>Bug Submitted</h1>
		<?php
					$var = $_GET['user_name'];
			
					session_start();
					if ($var == NULL ||!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false || $_SESSION['username'] != $var) 
					{
						$message = "Please Login First";
						echo "<script type='text/javascript'>alert('$message');window.location.href='login.php';</script>";
						session_destroy();
						
					} 
                    $username = $_GET['user_name'];
                    function build_query()
                    {
                        $con = mysqli_connect("localhost","root");
                        if ($con->connect_error) {
                            die("Connection failed: " . $con->connect_error);
                        } 
                        mysqli_select_db($con, "bughound");
                        
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

                        $insert = "INSERT INTO bug_report (programId, report_type, severity, problem_summary, reproducible, problem, reported_by_employeeId, reported_date";

                        $values = ") VALUES ('".$program."','".$report_type."','".$severity."','".$problem_summary."','".$reproducible."','".$problem."','".$reported_by."', '".$date."'";

                        
                        if ($attachment !== "")
                        {
                            $att_query = "INSERT INTO attachment (file_name) VALUES ('" . mysqli_real_escape_string($con, basename($attachment)) . "');";
                            
                            if (!mysqli_query($con, $att_query)) {
                                echo "Error: " . $att_query . "<br>" . $con->error;
                            }

                            $att_query = "SELECT id FROM attachment WHERE file_name='" . mysqli_real_escape_string($con, basename($attachment)) . "';";
                            $result = mysqli_query($con, $att_query);
                            $row=mysqli_fetch_row($result);

                            $insert .= ", attachmentId";
                            $values .= ",'".$row[0]."'";
                            
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
                        if ($suggested_fix !== "")
                        {
                            $insert .= ", suggested_fix";
                            $values .= ",'".$suggested_fix."'";
                        }
                        if ($functional_area !== "null")
                        {
                            $insert .= ", functional_areaId";
                            $values .= ",'".$functional_area."'";
                        }
                        if ($assigned_to !== "null")
                        {
                            $insert .= ", assigned_to_employeeId";
                            $values .= ",'".$assigned_to."'";
                        }
                        if ($comments !== "")
                        {
                            $insert .= ", comments";
                            $values .= ",'".$comments."'";
                        }
                        if ($status !== "null")
                        {
                            $insert .= ", status";
                            $values .= ",'".$status."'";
                        }
                        if ($priority !== "null")
                        {
                            $insert .= ", priority";
                            $values .= ",'".$priority."'";
                        }
                        if ($resolution !== "null")
                        {
                            $insert .= ", resolution";
                            $values .= ",'".$resolution."'";
                        }
                        if ($resolution_version !== "null")
                        {
                            $insert .= ", resolution_version";
                            $values .= ",'".$resolution_version."'";
                        }
                        if ($resolved_by !== "null")
                        {
                            $insert .= ", resolved_by_employeeId";
                            $values .= ",'".$resolved_by."'";
                        }
                        if ($resolved_date !== "")
                        {
                            $insert .= ", resolved_date";
                            $values .= ",'".$resolved_date."'";
                        }
                        if ($tested_by !== "null")
                        {
                            $insert .= ", tested_by_employeeId";
                            $values .= ",'".$tested_by."'";
                        }
                        if ($tested_date !== "")
                        {
                            $insert .= ", tested_date";
                            $values .= ",'".$tested_date."'";
                        }
                        if ($treat_as_deferred != 0)
                        {
                            $insert .= ", treat_as_deferred";
                            $values .= ",'".$treat_as_deferred."'";
                        }

                        $query = $insert . $values . ");";

                        return $query;
                    }


                    $query = build_query();

                    $con = mysqli_connect("localhost","root");
                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    } 
                    mysqli_select_db($con, "bughound");

                    if (mysqli_query($con, $query)) {
                        echo "New records created successfully";
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