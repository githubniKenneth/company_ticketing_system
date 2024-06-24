<?php
session_start();
include('../../Includes/connection.php');

    $employeeID = $_GET['employeeId'];
    $telLocalId = $_GET['telLocalId'];
    // DELETE EMPLOYEE PERMANENTLY
    $deleteEmployeeSQL = "DELETE FROM employee WHERE employee_id ='$employeeID'";
    $delete4 = mysqli_query($con, $deleteEmployeeSQL);
    if ($delete4 == true) {
      // SELECT EMPLOYEE ASSET TO DELETE THE ASSET FROM THE EMPLOYEE ASSET
      $selectemployeeSQL = "SELECT employee_id, asset_id FROM employee_asset WHERE employee_id ='$employeeID'";
      $select = mysqli_query($con, $selectemployeeSQL);
      $checkSelect = mysqli_num_rows($select);
      if ($checkSelect != 0) {
        while($row = mysqli_fetch_array($select)){
          $employee_id = $row['employee_id'];
          $asset_id = $row['asset_id'];
          // UPDATE ALL THE IT ASSET OF THE EMPLOYEE TO 0 OR UNUSED
          $updateItAssetSQL = "UPDATE it_asset SET status = 0 WHERE asset_id ='$asset_id'";
          $update3 = mysqli_query($con, $updateItAssetSQL);
          // DELETE ALL THE EMPLOYEE ASSET TO THE EMPLOYEE ASSET TABLE IN THE DATABASE
            $deleteEmployeeAssetSQL = "DELETE FROM employee_asset WHERE employee_id ='$employeeID'";
            $delete3 = mysqli_query($con, $deleteEmployeeAssetSQL);
          // UPDATE ALL THE LOCAL TELEPHONE OF THE EMPLOYEE TO 0 OR UNUSED
          if ($telLocalId != "") {
            $updateTelLocalSQL = "UPDATE tel_local_directory SET status = 0 WHERE tel_local_id ='$telLocalId'";
            $update2 = mysqli_query($con, $updateTelLocalSQL);
            // MESSAGE IF THE DELETE OF EMPLOYEE SUCCESSFUL
            $_SESSION['delete_employee'] = "<div class='alert alert-success' role='alert'>
                                    Employee Deleted Successfully.
                                    </div>";
            header('location:'.$siteURL.'Admin_side/employee.php');
          }
            // MESSAGE IF THE DELETE OF EMPLOYEE SUCCESSFUL
            $_SESSION['delete_employee'] = "<div class='alert alert-success' role='alert'>
                                    Employee Deleted Successfully.
                                    </div>";
            header('location:'.$siteURL.'Admin_side/employee.php');

        }
      }
      elseif ($telLocalId != "") {
        $updateTelLocalSQL = "UPDATE tel_local_directory SET status = 0 WHERE tel_local_id ='$telLocalId'";
        $update2 = mysqli_query($con, $updateTelLocalSQL);
        // MESSAGE IF THE DELETE OF EMPLOYEE SUCCESSFUL
        $_SESSION['delete_employee'] = "<div class='alert alert-success' role='alert'>
                                Employee Deleted Successfully.
                                </div>";
        header('location:'.$siteURL.'Admin_side/employee.php');
      }
      else {
        // MESSAGE IF THE DELETE OF EMPLOYEE SUCCESSFUL
        $_SESSION['delete_employee'] = "<div class='alert alert-success' role='alert'>
                                Employee Deleted Successfully.
                                </div>";
        header('location:'.$siteURL.'Admin_side/employee.php');
      }
      }  else
          {
            // MESSAGE IF THE DELETE OF EMPLOYEE FAILED
              $_SESSION['delete_employee'] = "<div class='alert alert-danger' role='alert'>
                                      Employee Failed to Delete.
                                      </div>";
              header('location:'.$siteURL.'Admin_side/employee.php');
          }

?>
