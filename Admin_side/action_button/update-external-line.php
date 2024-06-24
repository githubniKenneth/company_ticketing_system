<?php
    session_start();
    include('../../Includes/connection.php');
    date_default_timezone_set('Asia/Manila');
    $current_id = $_SESSION['user_id'];

        if(isset($_POST['updateTelExternalButton']))
        {
          $tel_external_id = $_POST['tel_external_id'];
          $date = date('Y-m-d H:i:s');
          // NEW VALUE
            $tel_external = $_POST['tel_external'];
            $reception_id = $_POST['reception_id'];
            $class_of_service = $_POST['class_of_service'];
            $company_id = $_POST['company_name'];

          // OLD VALUE
          $old_tel_external = $_POST['old_tel_external'];
          $old_reception_id = $_POST['old_reception_id'];
          $old_class_of_service = $_POST['old_class_of_service'];
          $old_company_id = $_POST['old_company_name'];

          if ($tel_external == $old_tel_external && $reception_id == $old_reception_id && $class_of_service == $old_class_of_service && $company_id == $old_company_id) {
            // ACTION IF THE EDIT IS STILL THE SAME INFORMATION
            header('location:'.$siteURL.'Admin_side/external_line.php');
          }
          else {
            // UPDATING THE INFORMATION OF A EXTERNAL TELEPHONE DIRECTORY CHOSEN
              $updateSQL = "UPDATE tel_external_directory SET tel_external = '$tel_external', reception_id = '$reception_id', class_of_service = '$class_of_service',
                            company_id ='$company_id', date_modified = '$date', modified_by = '$current_id'
                            WHERE tel_ex_id = '$tel_external_id'";

              $update = mysqli_query($con, $updateSQL);

              if($update == true)
              {
                // MESSAGE IF UPDATING EXTERNAL TELEPHONE DIRECTORY IS SUCCESSFUL
                $_SESSION['update'] = "<div class='alert alert-success' role='alert'>
                                        External Telephone Updated Successfully.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/external_line.php');
              }
              else {
                // MESSAGE IF UPDATING EXTERNAL TELEPHONE DIRECTORY IS FAILED
                $_SESSION['update'] = "<div class='alert alert-danger' role='alert'>
                                        External Telephone Failed to Update.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/external_line.php');
              }
            }
        }
