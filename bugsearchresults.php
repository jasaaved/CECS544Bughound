<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bug Search Results</title>
        
        <style>
            div.vertical-center {
                display:flex;
                align-items:center;
            }

            div.bottom-border{
                border-bottom: 4px solid gray;
            }
            
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 50%;
                margin: 0px auto;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }
            button{
                height:30px; 
                width:100px; 
                margin: -20px -50px; 
                position:relative;
                top:50%; 
                left:50%;
            }
        </style>
    </head>
    
    <body>
        <input type="button" value="Back" id=button2 name=button2 onclick="go_search()">
        <h1 align="center">Bug Search Results</h1>
        
        <?php
            $con = mysqli_connect("localhost","root");
            mysqli_select_db($con, "bughound");
            $username = $_GET['user_name'];
			$var = $_GET['user_name'];
			
			session_start();
			if ($var == NULL ||!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false || $_SESSION['username'] != $var) 
			{
				$message = "Please Login First";
				echo "<script type='text/javascript'>alert('$message');window.location.href='login.php';</script>";
				session_destroy();
				
			}
            
            $program = $_POST['program'];
            $report_type = $_POST['report_type'];
            $severity = $_POST['severity'];
            $reported_by = $_POST['reported_by'];
            $date = $_POST['date'];
            $functional_area = $_POST['functional_area'];
            $assigned_to = $_POST['assigned_to'];
            $status = $_POST['status'];
            $priority = $_POST['priority'];
            $resolution = $_POST['resolution'];
            $resolved_by = $_POST['resolved_by'];
            
            $query = "SELECT * FROM bug_report";
            
            if ($status !== "null")
            {
                $query .= " WHERE status=".$status;
            }
            else
            {
                $query .= " WHERE id>=0";
            }
            
            if ($program !== "null")
            {
                $query .= " AND programId='".$program."'";
            }
            if ($severity !== "null")
            {
                $query .= " AND severity=".$severity;
            }
            if ($report_type !== "null")
            {
                $query .= " AND report_type=".$report_type;
            }
            if ($date !== "")
            {
                $query .= " AND reported_date='".$date."'";
            }
            if ($functional_area !== "null")
            {
                $query .= " AND functional_areaId='".$functional_area."'";
            }
            if ($assigned_to !== "null")
            {
                $query .= " AND assigned_to_employeeId='".$assigned_to."'";
            }
            if ($reported_by !== "null")
            {
                $query .= " AND reported_by_employeeId='".$reported_by."'";
            }
            if ($priority !== "null")
            {
                $query .= " AND priority=".$priority;
            }
            if ($resolution !== "null")
            {
                $query .= " AND resolution=".$resolution;
            }
            if ($resolved_by !== "null")
            {
                $query .= " AND resovled_by_employeeId='".$resolved_by."'";
            }
            
            $query .= ";";
            $results=mysqli_query($con, $query);
            
            if (mysqli_num_rows($results) > 0)
            {
                while($row=mysqli_fetch_row($results))
                {
                    $query = "SELECT * FROM program WHERE id=" . $row[1] . ";";
                    $results2 = mysqli_query($con, $query);
                    $p_row = mysqli_fetch_row($results2);
                    
                    echo "<br>";
                    echo "<div class=\"bottom-border\">";
                    echo "<table style=\"width:50%\">";
                    echo "<tr>";
                    echo "<td>Program: </td>";
                    echo "<td>".$p_row[1] . " v" . $p_row[2]."</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Report Type: </td>";
                    echo "<td>$row[2]</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Severity: </td>";
                    echo "<td>$row[3]</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Problem Summary: </td>";
                    echo "<td>$row[4]</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Reproducible? </td>";
                    if ($row[5] == 1)
                    {
                        echo "<td>Yes</td>";
                    }
                    else
                    {
                        echo "<td>No</td>";
                    }
                    //echo "<td>$row[5]</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Problem: </td>";
                    echo "<td>$row[6]</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Suggested Fix: </td>";
                    echo "<td>$row[7]</td>";
                    echo "</tr>";
                    
                    $query = "SELECT * FROM employee WHERE id=" . $row[8] . ";";
                    $results2 = mysqli_query($con, $query);
                    $rb_row = mysqli_fetch_row($results2);
                    
                    echo "<tr>";
                    echo "<td>Reported By: </td>";
                    echo "<td>$rb_row[1]</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td>Reported Date: </td>";
                    echo "<td>$row[9]</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td>Attachment: </td>";
                    
                    $query = "SELECT * FROM attachment WHERE id=" . $row[10] . ";";
                    if ($results2 = mysqli_query($con, $query))
                    {
                        $at_row = mysqli_fetch_row($results2);
                        echo "<td>$at_row[1]</td>";
                    }
                    
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td>Functional Area: </td>";
                    
                    $query = "SELECT * FROM functional_area WHERE id=" . $row[11] . ";";
                    
                    if ($results2 = mysqli_query($con, $query))
                    {
                        $fa_row = mysqli_fetch_row($results2);
                        echo "<td>$fa_row[1]</td>";
                    }
                    
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td>Assigned To: </td>";
                    
                    $query = "SELECT * FROM employee WHERE id=" . $row[12] . ";";
                    if ($results2 = mysqli_query($con, $query))
                    {
                        $ast_row = mysqli_fetch_row($results2);
                        echo "<td>$ast_row[1]</td>";
                    }
                    
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td>Comments: </td>";
                    echo "<td>$row[13]</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td>Status: </td>";
                    echo "<td>$row[14]</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td>Priority: </td>";
                    echo "<td>$row[15]</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td>Resolution: </td>";
                    echo "<td>$row[16]</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td>Resolution Version: </td>";
                    echo "<td>$row[17]</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td>Resolved By: </td>";
                    
                    $query = "SELECT * FROM employee WHERE id=" . $row[18] . ";";
                    if ($results2 = mysqli_query($con, $query))
                    {
                        $resb_row = mysqli_fetch_row($results2);
                        echo "<td>$resb_row[1]</td>";
                    }
                    
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td>Resolved Date: </td>";
                    echo "<td>$row[19]</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td>Tested By: </td>";
                    
                    $query = "SELECT * FROM employee WHERE id=" . $row[20] . ";";
                    if ($results2 = mysqli_query($con, $query))
                    {
                        $testb_row = mysqli_fetch_row($results2);
                        echo "<td>$testb_row[1]</td>";
                        
                    }
                    
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td>Tested Date: </td>";
                    echo "<td>$row[21]</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td>Treat as Deferred?  </td>";
                    if ($row[22] == 1)
                    {
                        echo "<td>Yes</td>";
                    }
                    else
                    {
                        echo "<td>No</td>";
                    }
                    
                    echo "</tr>";
                    
                    echo "</table>";
                    
                    //$row[4] = mysqli_real_escape_string($con, $row[4]);
                    $row[4] = htmlspecialchars($row[4]);
                    $row[6] = htmlspecialchars($row[6]);
                    $row[7] = htmlspecialchars($row[7]);
                    $row[13] = htmlspecialchars($row[13]);
                    
                    echo "<form action=\"editbug.php?user_name=$username\" method=\"post\" >";
                    echo "<input type=\"hidden\" name=\"bug_id\" value=$row[0]>";
                    echo "<input type=\"hidden\" name=\"program\" value=$row[1]>";
                    echo "<input type=\"hidden\" name=\"report_type\" value=\"$row[2]\">";
                    echo "<input type=\"hidden\" name=\"severity\" value=$row[3]>";
                    echo "<input type=\"hidden\" name=\"problem_summary\" value=\"$row[4]\">";
                    echo "<input type=\"hidden\" name=\"reproducible\" value=$row[5]>";
                    echo "<input type=\"hidden\" name=\"problem\" value=\"$row[6]\">";
                    echo "<input type=\"hidden\" name=\"suggested_fix\" value=\"$row[7]\">";
                    echo "<input type=\"hidden\" name=\"reported_by\" value=\"$row[8]\">";
                    echo "<input type=\"hidden\" name=\"date\"value=$row[9]>";
                    echo "<input type=\"hidden\" name=\"attachment\" value=$row[10]>";
                    echo "<input type=\"hidden\" name=\"functional_area\" value=$row[11]>";
                    echo "<input type=\"hidden\" name=\"assigned_to\" value=$row[12]>";
                    echo "<input type=\"hidden\" name=\"comments\" value=\"$row[13]\">";
                    echo "<input type=\"hidden\" name=\"status\" value=$row[14]>";
                    echo "<input type=\"hidden\" name=\"priority\" value=\"$row[15]\">";
                    echo "<input type=\"hidden\" name=\"resolution\" value=\"$row[16]\">";
                    echo "<input type=\"hidden\" name=\"resolution_version\" value=\"$row[17]\">";
                    echo "<input type=\"hidden\" name=\"resolved_by\" value=$row[18]>";
                    echo "<input type=\"hidden\" name=\"resolved_date\" value=$row[19]>";
                    echo "<input type=\"hidden\" name=\"tested_by\" value=$row[20]>";
                    echo "<input type=\"hidden\" name=\"tested_date\" value=$row[21]>";
                    echo "<input type=\"hidden\" name=\"treat_as_deferred\" value=$row[22]>";
                    
                    echo "<br>";
                    echo "<br>";
                    
                    echo "<button type=\"submit\" name=\"select_bug\" value=\"Submit\">Edit Report</button>";
                    echo "</form>";
                    
                    echo "<br>";
                    echo "<br>";
                    echo "</div>";
                    
                }
            }
            else
            {
                echo "<h2>No Results Found</h2>";
                echo "<input type=\"button\" value=\"Cancel\" id=button2 name=button2 onclick=\"go_home()\"/>";
            }
        ?>
        
        <script language=Javascript>
            function go_home(){
                window.location.replace("index.php?user_name=<?php echo $username?>");
            }
            function go_search(){
                window.location.replace("bugsearch.php?user_name=<?php echo $username?>");
            }
        </script>
        
    </body>
    
    
</html>
