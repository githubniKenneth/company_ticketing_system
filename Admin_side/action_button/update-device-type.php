<?php
session_start();
include('../../Includes/connection.php');
$current_id = $_SESSION['user_id'];
date_default_timezone_set('Asia/Manila');

if (isset($_POST['device_type_id'])) {
  $device_type_id = mysqli_real_escape_string($con, $_POST['device_type_id']);
  $date = date("Y-m-d H:i:s");
  // NEW DEVICE TYPE NAME
  $device_type_name = mysqli_real_escape_string($con, $_POST['device_type_name']);
  // OLD DEVICE TYPE NAME
  $old_device_type_name = mysqli_real_escape_string($con, $_POST['old_device_type_name']);

  // SELECT THE LOCAL TELEPHONE DIRECTORY IF ITS EXISTING ALREADY
  $selectSQL = "SELECT device_type_name FROM device_type WHERE device_type_name = '$device_type_name' AND NOT device_type_id = '$device_type_id'";
  $select = mysqli_query($con, $selectSQL);
  $rowCheck = mysqli_num_rows($select);

  if ($rowCheck != 0) {
    echo 1;
  }
  elseif ($device_type_name == $old_device_type_name) {
    echo 2;
  }
  else {
    $updateSQL = "UPDATE device_type SET device_type_name = '$device_type_name', date_modified = '$date', modified_by = '$current_id'
                  WHERE device_type_id ='$device_type_id'";
    $update = mysqli_query($con, $updateSQL);
    if ($update == true) {
      echo '<p class="alert alert-success" role="alert"">Device Type Edited Successfully</p>';
    }
    else {
      echo '<p class="alert alert-danger" role="alert"">Device Type Edited Failed</p>';
    }
  }
}
?>
