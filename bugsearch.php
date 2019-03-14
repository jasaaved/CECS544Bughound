<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Bug Search Page</title>
        
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
                                    echo "<option value=$row[0]>$row[1]</option>";
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
        </form>
        
        
        
        
    </body>
    
    
    
    
    
    
    
</html>