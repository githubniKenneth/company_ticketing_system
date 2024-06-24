<?php
session_start();
include('../../Includes/connection.php');
// SHOW DEVICE TYPE
if (isset($_POST['selectVal2'])) { //js/select-device-type.js

  $selectVal = $_POST['selectVal2'];

  if ($selectVal == "") {
    $query = "SELECT * FROM device_type ORDER BY device_type_name ASC";
    $deviceQuery = $con->query($query);
    ?>
    <option value="">Device Type</option>
    <?php
    while($deviceRow = mysqli_fetch_assoc($deviceQuery)){
        $device_type_id = $deviceRow['device_type_id'];
        $device_type_name = $deviceRow['device_type_name'];
          echo '<option value="'.$device_type_id.'">'.$device_type_name.'</option>';
      }
  } else {
    $query = "SELECT * FROM device_type ORDER BY device_type_name ASC";
    $deviceQuery = $con->query($query);
    ?>
    <option value="">Device Type</option>
    <?php
    while($deviceRow = mysqli_fetch_assoc($deviceQuery)){
        $device_type_id = $deviceRow['device_type_id'];
        $device_type_name = $deviceRow['device_type_name'];

        if ($device_type_id == $selectVal) {
          echo '<option value="'.$device_type_id.'" selected>'.$device_type_name.'</option>';
        }else {
          echo '<option value="'.$device_type_id.'">'.$device_type_name.'</option>';
        }
      }
  }

}
