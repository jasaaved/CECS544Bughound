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
                    
                }
            }
            else
            {
                echo "<h2>No Results Found</h2>";
            }
        ?>
        
        
        
    </body>
    
    
</html>
