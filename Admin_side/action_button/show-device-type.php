<?php
session_start();
include('../../Includes/connection.php');
?>
<form class="form-inline mb-2 d-flex justify-content-end">
      <div class="">
        <button id="srch_btn_deviceType" class="btn btn-primary mr-sm-2 mb-2" type="button">Search</button>
        <input id="srch_input_deviceType" class="form-control mr-sm-2 mb-2 align-middle" type="search" placeholder="Search" aria-label="Search">
      </div>
  </form>
<!-- TABLE OF LIST OF DEVICE TYPE  -->
<table class="table" id="table_deviceType">
  <thead>
    <th>#</th>
    <th>Device Type</th>
    <th>Date Created</th>
    <th>Status</th>
    <th>Action</th>
  </thead>
  <tbody class="target-search-deviceType">
  <?php
  $counter = 0;
    $deviceTypeQuery = "SELECT a.device_type_id, a.device_type_name, a.date_created, a.status
    FROM device_type a";
    $deviceTypeResult = mysqli_query($con, $deviceTypeQuery);
    while ($deviceTypeRow = mysqli_fetch_assoc($deviceTypeResult)) {
      $device_type_id = $deviceTypeRow['device_type_id'];
      $device_type_name = $deviceTypeRow['device_type_name'];
      $date_created = $deviceTypeRow['date_created'];
      $status = $deviceTypeRow['status'] == 0? "InActive" : "Active";
      $statusNum = $deviceTypeRow['status'];
      $counter++;
      ?>
      <tr>
        <td><?php echo $counter;?></td>
        <td class="device_type_td"><?php echo $device_type_name;?></td>
        <td><?php echo $date_created;?></td>
        <td><?php echo $status;?></td>
        <td>
        <button type="button" data-toggle="modal" data-id="<?php echo $device_type_id; ?>" class="editDeviceTypeBtn btn btn-primary">Edit</button>
        </td>
      </tr>
      <?php
    }
    ?>
  </tbody>
</table>
<script src="../js/it_asset/edit-device-type.js"></script>
<script src="../js/it_asset/search-device-type.js"></script>
