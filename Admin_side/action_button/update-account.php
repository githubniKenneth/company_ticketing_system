<?php 
    session_start();
    include('../../Includes/connection.php');
?>


        <?php
        if(isset($_POST['updateButton']))
        {
            $user_id = $_POST['userID'];
            $userType = $_POST['userTypes'];
            $company_id = $_POST['companyName'];
            $department_id = $_POST['department_id'];
            
            
                $updateSQL = "UPDATE user SET account_type='$userType',company_id='$company_id',department_id='$department_id' WHERE user_id='$user_id'";
                // $updateSQL = "UPDATE user SET account_type = '0' WHERE username= 'gg'";
                $update = mysqli_query($con, $updateSQL);



            if($update == true)
            {
                $_SESSION['update'] = "<div class='alert alert-success' role='alert'>
                                        Account Updated Successfully.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/pendingAccounts.php');
            }
            else
            {

                $_SESSION['update'] = "<div class='alert alert-danger' role='alert'>
                                        Account Failed to Update.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/pendingAccounts.php');
            }
        }
        ?>



