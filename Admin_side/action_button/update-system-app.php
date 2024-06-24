<?php 
    session_start();
    include('../../Includes/connection.php');
    $current_id = $_SESSION['user_id'];
    date_default_timezone_set('Asia/Manila');
?>

        <?php
        if(isset($_POST['updateApp']))
        {
            $sa_id = $_POST['sa_id'];
            $status = $_POST['status'];
            $date = date('Y-m-d H:i:s');
    
            $updateSQL="UPDATE system_application 
                        SET sa_status='$status', sa_modified_by='$current_id', sa_modified_date='$date'
                        WHERE sa_id='$sa_id'";
            // $updateSQL = "UPDATE system_application SET sa_status = '1' WHERE  sa_id= '1'";
            $update = mysqli_query($con, $updateSQL);

            if($update == true)
            {
                $_SESSION['update'] = "<div class='alert alert-success' role='alert'>
                                        Application Updated Successfully.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/system-applications.php');
            }
            else
            {
                $_SESSION['update'] = "<div class='alert alert-danger' role='alert'>
                                        Application Failed to Update.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/system-applications.php');
            }
        }
        ?>


