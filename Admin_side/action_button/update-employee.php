<?php
    session_start();
    include('../../Includes/connection.php');
    date_default_timezone_set('Asia/Manila');
    $current_id = $_SESSION['user_id'];
?>
        <?php
        if(isset($_POST['updateEmployeeButton']))
        {
            $employee_id = $_POST['employee_id'];
            $date = date('Y-m-d H:i:s');
            // NEW VALUE
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $company_id = $_POST['company_id'];
            $department_id = $_POST['department_id'];
            $tel_local_id = $_POST['tel_local_id'];
            // OLD VALUE
            $old_firstname = $_POST['old_firstname'];
            $old_lastname = $_POST['old_lastname'];
            $old_company_id = $_POST['old_company_id'];
            $old_department_id = $_POST['old_department_id'];
            $old_tel_local_id = $_POST['old_tel_local_id'];

            if ($firstname == $old_firstname && $lastname == $old_lastname && $company_id == $old_company_id && $department_id == $old_department_id && $tel_local_id == $old_tel_local_id) {
              // ACTION IF THE EDIT IS STILL THE SAME INFORMATION
              header('location:'.$siteURL.'Admin_side/employee.php');
            }
            else {
              // UPDATING THE INFORMATION OF A EMPLOYEE CHOSEN
              $updateSQL = "UPDATE employee SET firstname = '$firstname', lastname = '$lastname', company_id = '$company_id',
                            department_id ='$department_id', tel_local_id = '$tel_local_id', date_modified = '$date', modified_by = '$current_id'
                            WHERE employee_id ='$employee_id'";
              $update = mysqli_query($con, $updateSQL);

              if ($tel_local_id != $old_tel_local_id) {
                // UPDATING THE STATUS OF A OLD LOCAL TELEPHONE DIRECTORY
                $updateTelLocalId1SQL = "UPDATE tel_local_directory SET status = 0, date_modified = '$date', modified_by = '$current_id' WHERE tel_local_id = '$old_tel_local_id'";
                $update = mysqli_query($con, $updateTelLocalId1SQL);
                // UPDATING THE STATUS OF A NEW LOCAL TELEPHONE DIRECTORY
                $updateTelLocalId2SQL = "UPDATE tel_local_directory SET status = 1, date_modified = '$date', modified_by = '$current_id' WHERE tel_local_id = '$tel_local_id'";
                $update = mysqli_query($con, $updateTelLocalId2SQL);
              }
              if($update == true)
              {
                // MESSAGE IF UPDATING EMPLOYEE IS SUCCESSFUL
                $_SESSION['update'] = "<div class='alert alert-success' role='alert'>
                                        Employee Updated Successfully.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/employee.php');
              }
              else {
                // MESSAGE IF UPDATING EMPLOYEE IS FAILED
                $_SESSION['update'] = "<div class='alert alert-danger' role='alert'>
                                        Employee Failed to Update.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/employee.php');
              }
        }
      }
        ?>
