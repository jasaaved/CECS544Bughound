<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Bug Search Page</title>
        
    </head>
    <body>
        <?php
			$var = $_GET['user_name'];
			
			session_start();
			if ($var == NULL ||!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false || $_SESSION['username'] != $var) 
			{
				$message = "Please Login First";
				echo "<script type='text/javascript'>alert('$message');window.location.href='login.php';</script>";
				session_destroy();
				
			} 
            $con = mysqli_connect("localhost","root");
            mysqli_select_db($con, "bughound");
            $username = $_GET['user_name'];
        ?>
        
        <h1>Bug Search Page</h1>
        
        <form action="bugsearchresults.php?user_name=<?php echo $username; ?>" method="post" onsubmit="return validate(this)">
            	<label for="program">Program:</label>
                <select name="program">
                    <option value=null></option>
                    <?php
                            $query = "SELECT * FROM program";
                            $result = mysqli_query($con, $query);

                            while($row=mysqli_fetch_row($result))
                            {
                                    echo "<option value=$row[0]>$row[1] v" . $row[3] . "." . $row[2] . "</option>";
                            }
                    ?>
                </select>
                
                <label for="report_type">Report Type:</label>
                <select name="report_type">
                    <option value=null></option>
                    <?php
                        $query = "SELECT TRIM(TRAILING ')' FROM TRIM(LEADING '(' FROM TRIM(LEADING 'enum' FROM column_type))) column_type FROM information_schema.columns WHERE table_name = 'bug_report' AND column_name = 'report_type'";

                        if ($result = mysqli_query($con, $query))
                        {
                            $row=mysqli_fetch_row($result);
                            $enum=explode(',',$row[0]);

                            for ($i=0; $i < sizeOf($enum); $i++)
                            {
                                $str = str_replace('\'', '', $enum[$i]);
                                $val = $i+1;
                                echo "<option value=$val>$str</option>";
                            }
                        }
                    ?>
                </select>
                
                <label for="severity">Severity:</label>
                <select name="severity">
                        <option value=null></option>
                        <?php
                                $query = "SELECT TRIM(TRAILING ')' FROM TRIM(LEADING '(' FROM TRIM(LEADING 'enum' FROM column_type))) column_type FROM information_schema.columns WHERE table_name = 'bug_report' AND column_name = 'severity'";

                                if ($result = mysqli_query($con, $query))
                                {
                                        $row=mysqli_fetch_row($result);
                                        $enum=explode(',',$row[0]);

                                        for ($i=0; $i < sizeOf($enum); $i++)
                                        {
                                                $str = str_replace('\'', '', $enum[$i]);
                                                $val = $i+1;
                                                echo "<option value=$val>$str</option>";
                                        }
                                }
                        ?>

                </select>
                
                <br>
                <br>
                                
                        <label for="functional_area">Functional Area:</label>
			<select name="functional_area">
                            <option value=null></option>
                            <?php
                                    $query = "SELECT * FROM functional_area";
                                    $result = mysqli_query($con, $query);

                                    while($row=mysqli_fetch_row($result))
                                    {
                                            echo "<option value=$row[0]>$row[1]</option>";
                                    }
                            ?>
			</select>
                        
                        <label for="assigned_to">Assigned To:</label>
                        <select name="assigned_to">
                            <option value=null></option>
                            <?php
                                $query = "SELECT * FROM employee";
                                $result = mysqli_query($con, $query);

                                while($row=mysqli_fetch_row($result))
                                {
                                    echo "<option value=$row[0]>$row[1]</option>";
                                }
                            ?>
			</select>
                        
                        <br>
                        <br>
                        
                        <label for="status">Status:</label>
			<select name="status">
                            <option value=null></option>
                            <?php
                                $query = "SELECT TRIM(TRAILING ')' FROM TRIM(LEADING '(' FROM TRIM(LEADING 'enum' FROM column_type))) column_type FROM information_schema.columns WHERE table_name = 'bug_report' AND column_name = 'status'";

                                if ($result = mysqli_query($con, $query))
                                {
                                    $row=mysqli_fetch_row($result);
                                    $enum=explode(',',$row[0]);

                                    for ($i=0; $i < sizeOf($enum); $i++)
                                    {
                                            $str = str_replace('\'', '', $enum[$i]);
                                            $val = $i+1;
                                            if($str === "Open")
                                            {
                                                echo "<option value=$val selected>$str</option>";
                                            }
                                            else
                                            {
                                                echo "<option value=$val>$str</option>";
                                            }
                                            
                                    }
                                }
                            ?>
			</select>
                        
                        <label for="priority">Priority:</label>
                        <select name="priority">
                            <option value=null></option>
                            <?php
                                $query = "SELECT TRIM(TRAILING ')' FROM TRIM(LEADING '(' FROM TRIM(LEADING 'enum' FROM column_type))) column_type FROM information_schema.columns WHERE table_name = 'bug_report' AND column_name = 'priority'";

                                if ($result = mysqli_query($con, $query))
                                {
                                        $row=mysqli_fetch_row($result);
                                        $enum=explode(',',$row[0]);

                                        for ($i=0; $i < sizeOf($enum); $i++)
                                        {
                                                $str = str_replace('\'', '', $enum[$i]);
                                                $val = $i+1;
                                                echo "<option value=$val>$str</option>";
                                        }
                                }
                            ?>
			</select>
                        
                        <label for="resolution">Resolution:</label>
			<select name="resolution">
                            <option value=null></option>
                            <?php
                                $query = "SELECT TRIM(TRAILING ')' FROM TRIM(LEADING '(' FROM TRIM(LEADING 'enum' FROM column_type))) column_type FROM information_schema.columns WHERE table_name = 'bug_report' AND column_name = 'resolution'";

                                if ($result = mysqli_query($con, $query))
                                {
                                    $row=mysqli_fetch_row($result);
                                    $enum=explode(',',$row[0]);

                                    for ($i=0; $i < sizeOf($enum); $i++)
                                    {
                                            $str = str_replace('\'', '', $enum[$i]);
                                            $val = $i+1;
                                            echo "<option value=$val>$str</option>";
                                    }
                                }
                            ?>
			</select>
                        
                        <br>
                        <br>
                        
                        <label for="reported_by">Reported By:</label>
                        <select name="reported_by">
                            <option value=null></option>
                            <?php
                                $query = "SELECT * FROM employee";
                                $result = mysqli_query($con, $query);

                                while($row=mysqli_fetch_row($result))
                                {
                                        echo "<option value=$row[0]>$row[1]</option>";
                                }
                            ?>
                        </select>
                        
                        <label for="date">Report Date:</label><input type="date" name="date">
                        
                        <label for="resolved_by">Resolved By:</label>
			<select name="resolved_by">
                            <option value=null></option>
                            <?php
                                $query = "SELECT * FROM employee";
                                $result = mysqli_query($con, $query);

                                while($row=mysqli_fetch_row($result))
                                {
                                    echo "<option value=$row[0]>$row[1]</option>";
                                }
                            ?>
			</select>
                        
                        <br>
                        <br>
                        
                        <input type="submit" name="Submit" value="Submit"/>
			<input type="reset" value="Reset"/>
			<input type="button" value="Cancel" id=button2 name=button2 onclick="go_home()"/>
        </form>
        
        <script language=Javascript>
            function go_home(){
                window.location.replace("index.php?user_name=<?php echo $username?>");
            }
            
        </script>
        
        
    </body>
    
    
    
    
    
    
    
</html>