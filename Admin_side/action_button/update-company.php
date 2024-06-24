<?php 
    session_start();
    include('../../Includes/connection.php');


    if(isset($_POST['updateCompany']))
    {
        $company_id = $_POST['company_id'];
        $status = $_POST['status'];

        $updateSQL = "UPDATE company SET status = '$status' WHERE company_id='$company_id'";
            
        $update = mysqli_query($con, $updateSQL);

        if($update == true)
        {
            $_SESSION['update'] = "<div class='alert alert-success' role='alert'>
                                    Company Updated Successfully.
                                    </div>";
            header('location:'.$siteURL.'Admin_side/company.php');
        }
        else
        {

            $_SESSION['update'] = "<div class='alert alert-danger' role='alert'>
                                    Company Failed to Update.
                                    </div>";
            header('location:'.$siteURL.'Admin_side/company.php');
        }
    }


