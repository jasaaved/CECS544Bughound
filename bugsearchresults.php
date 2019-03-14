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
                border-bottom: 2px solid gray;
            }
        </style>
    </head>
    
    <body>
        <form action="editbug.php?user_name=<?php echo $username; ?>" method="post" >
        <?php
            $con = mysqli_connect("localhost","root");
            mysqli_select_db($con, "bughound");
            $username = $_GET['user_name'];
            
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
            
            $query = "SELECT * FROM bug_report WHERE status=".$status;
            
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
            echo $query;
            $results=mysqli_query($con, $query);
            
            if (mysqli_num_rows($results) > 0)
            {
                while($row=mysqli_fetch_row($results))
                {
                    $query = "SELECT * FROM program WHERE id=" . $program . ";";
                    $results = mysqli_query($con, $query);
                    $p_row = mysqli_fetch_row($results);
                    $program = $p_row[1] . " v" . $p_row[2];
                    
                    echo "<div class=\".bottom-border\">";
                    echo "<table style=\"width:100%\">";
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
                    echo "<td>$row[5]</td>";
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
                    echo "<td>$$status</td>";
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
                    echo "<td>$row[22]</td>";
                    echo "</tr>";
                    
                    echo "</table>";
                    
                    echo "</div>";
                }
            }
            else
            {
                echo "<h2>No Results Found</h2>";
            }
        ?>
        
        
            
        </form>
        
    </body>
    
    
</html>
