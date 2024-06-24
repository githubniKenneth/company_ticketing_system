<?php
    session_start();
    include('../../Includes/connection.php');
    $current_id = $_SESSION['user_id'];
    date_default_timezone_set('Asia/Manila');
?>


        <?php
        if(isset($_POST['updateTelLocalButton']))
        {
            $tel_local_id = $_POST['tel_local_id'];
            $tel_local = $_POST['tel_local'];
            $old_tel_local = $_POST['old_tel_local'];
            $date = date("Y-m-d H:i:s");

            // SELECT THE LOCAL TELEPHONE DIRECTORY IF ITS EXISTING ALREADY
            $selectSQL = "SELECT tel_local FROM tel_local_directory WHERE tel_local = '$tel_local' AND NOT tel_local_id = '$tel_local_id'";
            $select = mysqli_query($con, $selectSQL);
            $rowCheck = mysqli_num_rows($select);

            if ($rowCheck != 0) {
              // MESSAGE IF LOCAL TELEPHONE DIRECTORY IS EXISTING ALREADY
              $_SESSION['update'] = "<div class='alert alert-danger' role='alert'>
                                      Local Telephone already existing.
                                      </div>";
              header('location:'.$siteURL.'Admin_side/local_line.php');
            } elseif ($old_tel_local == $tel_local) {
              // ACTION IF THE EDIT IS STILL THE SAME INFORMATION
              header('location:'.$siteURL.'Admin_side/local_line.php');
            }
            else {
              // UPDATING THE INFORMATION OF A LOCAL TELEPHONE DIRECTORY CHOSEN
              $updateSQL = "UPDATE tel_local_directory SET tel_local = '$tel_local', date_modified = '$date', modified_by = '$current_id'
                            WHERE tel_local_id ='$tel_local_id'";
              $update = mysqli_query($con, $updateSQL);
              if($update == true)
              {
                // MESSAGE IF UPDATING LOCAL TELEPHONE DIRECTORY IS SUCCESSFUL
                $_SESSION['update'] = "<div class='alert alert-success' role='alert'>
                                        Local Telephone Updated Successfully.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/local_line.php');
              }
              else {
                // MESSAGE IF UPDATING LOCAL TELEPHONE DIRECTORY IS FAILED
                $_SESSION['update'] = "<div class='alert alert-danger' role='alert'>
                                        Local Telephone Failed to Update.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/local_line.php');
              }
            }


      }
?>
