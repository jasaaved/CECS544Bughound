<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <title>Bug Submitted</title>
	</head>
	
	<body>
		<h1>Bug Submitted</h1>
		<?php
			function build_query()
                        {
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
                            $attachments = $_POST['file_name'];
                            $treat_as_deferred = $_POST['treat_as_deferred'];

                            $insert = "INSERT INTO bug_report (programId, report_type, severity, problem_summary, reproducible, problem, suggested_fix, reported_by_employeeId, reported_date";
                            
                            $values = ") VALUES ('".$program."','".$report_type."','".$severity."','".$problem_summary."','".$reproducible."','".$problem."','".$suggested_fix."','".$reported_by."', '".$date."'";
                        
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
                            
                            $query = $insert . $values . ")";
                            
                            return $query;
                        }
		
                        
			$query = build_query();
                        #echo $query;
                        
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
	</body>


</html>