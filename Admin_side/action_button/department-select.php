<?php
include ('../../Includes/connection.php');

    if(isset($_POST["company"]))
    {
        // Capture selected company
        $company_id = $_POST["company"];
        if($company_id == "")
        {
        }
        else
        {
            $departmentSql = "SELECT department_id, department_name, company_id FROM department WHERE company_id=$company_id AND status=0";

            $departmentQuery = mysqli_query($con, $departmentSql);
            $departmentRowCheck = mysqli_num_rows($departmentQuery);
            $departmentList = array();
            if($departmentRowCheck != 0)
            {
                while($departmentRow = mysqli_fetch_assoc($departmentQuery))
                {
                    $departmentList[] = $departmentRow;
                }  
            }
        }
    }
?>    

<!DOCTYPE html>
<html lang="en">
    <body>
        <label for="">Department</label>
            <select name="department_id" id="" class="custom-select" required>
                <option value="">Select Department</option>
                <?php
                    foreach ($departmentList as $department) 
                    {
                        
                        echo "<option value=" .$department['department_id']. ">" .$department['department_name']. "</option>";
                    }
                ?>
            </select>
    </body>
</html>