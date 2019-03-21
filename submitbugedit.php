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
                        $attachment = "";
                        $treat_as_deferred = $_POST['treat_as_deferred'];
                        
                        $update = "UPDATE bug_report SET programId='".$program."', report_type='".$report_type."', severity='".$severity."', problem_summary=\"".$problem_summary."\", reproducible='".$reproducible."', problem=\"".$problem."\", reported_by_employeeId='".$reported_by."', reported_date='".$date."'";
                        $where = " WHERE id='" . $bug_id . "';";
                        

                            $update .= ", suggested_fix=\"".$suggested_fix."\"";
                            $update .= ", functional_areaId=".$functional_area."";
                            $update .= ", assigned_to_employeeId='".$assigned_to."'";
                            $update .= ", comments=\"".$comments."\"";
                            $update .= ", status='".$status."'";
                            $update .= ", priority='".$priority."'";
                            $update .= ", resolution='".$resolution."'";
                            $update .= ", resolution_version='".$resolution_version."'";
                            $update .= ", resolved_by_employeeId='".$resolved_by."'";
                            $update .= ", resolved_date='".$resolved_date."'";
                            $update .= ", tested_by_employeeId='".$tested_by."'";
                            $update .= ", tested_date='".$tested_date."'";
                        
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