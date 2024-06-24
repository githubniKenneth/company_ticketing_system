<?php 
    session_start();
    include('../../Includes/connection.php');


    if(isset($_POST['updateDepartment']))
    {
        $department_id = $_POST['department_id'];
        $status = $_POST['status'];

        $updateSQL = "UPDATE department SET status = $status WHERE department_id='  $department_id'";
        //  
            
        $update = mysqli_query($con, $updateSQL);

        if($update == true)
        {
            $_SESSION['update'] = "<div class='alert alert-success' role='alert'>
                                    Department Updated Successfully.
                                    </div>";
            header('location:'.$siteURL.'Admin_side/department.php');
        }
        else
        {

            $_SESSION['update'] = "<div class='alert alert-danger' role='alert'>
                                    Failed to Update Department.
                                    </div>";
            header('location:'.$siteURL.'Admin_side/department.php');
        }
    }
    ?>
    


