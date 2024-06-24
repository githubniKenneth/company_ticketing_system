<?php
session_start();
include('../../Includes/connection.php');
$current_id = $_SESSION['user_id'];
date_default_timezone_set('Asia/Manila');

if (isset($_POST['supplier_id'])) {
  $supplier_id = mysqli_real_escape_string($con, $_POST['supplier_id']);
  $date = date("Y-m-d H:i:s");
  // NEW SUPPLIER NAME
  $supplier_name = mysqli_real_escape_string($con, $_POST['supplier_name']);
  // OLD SUPPLIER NAME
  $old_supplier_name = mysqli_real_escape_string($con, $_POST['old_supplier_name']);

  // SELECT THE SUPPLIER IF ITS EXISTING ALREADY
  $selectSQL = "SELECT supplier_name FROM supplier WHERE supplier_name = '$supplier_name' AND NOT supplier_id = '$supplier_id'";
  $select = mysqli_query($con, $selectSQL);
  $rowCheck = mysqli_num_rows($select);

  if ($rowCheck != 0) {
    // IF THE EDIT IS EXISTING ALREADY
    echo 1;
  }
  elseif ($supplier_name == $old_supplier_name) {
    // IF THE EDIT IS NOTHING CHANGES
    echo 2;
  }
  else {
    $updateSQL = "UPDATE supplier SET supplier_name = '$supplier_name', date_modified = '$date', modified_by = '$current_id'
                  WHERE supplier_id ='$supplier_id'";
    $update = mysqli_query($con, $updateSQL);
    if ($update == true) {
      echo '<p class="alert alert-success" role="alert"">Edited Successfully</p>';
    }
    else {
      echo '<p class="alert alert-danger" role="alert"">Edited Failed</p>';
    }
  }
}
?>
