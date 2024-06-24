<?php
session_start();
include('../../Includes/connection.php');

    if(isset($_POST["deviceTypeInputVal"])){
      $input = mysqli_real_escape_string($con, $_POST['deviceTypeInputVal']); //TO ENSURE THAT THE DATA THAT IS SENT TO THE MYSQL SERVER IS SAFE

      // SELECT THE SUPPLIER TO PUT IT TO THE TABLE OF DEVICE TYPE FOR ADDING AFTER "SEARCHING"
            $query  = "SELECT a.device_type_id, a.device_type_name, a.date_created, a.status
            FROM device_type a
            WHERE a.device_type_name LIKE '%$input%' OR a.date_created  LIKE '%$input%'";

            $result = mysqli_query($con, $query);
            $counter = 0;
            while($row = mysqli_fetch_array($result)){
              $device_type_id = $row['device_type_id'];
              $device_type_name = $row['device_type_name'];
              $date_created = $row['date_created'];
              $status = $row['status'] == 0? "InActive" : "Active";
              $counter++;
              ?>
                      <tr>
                        <td><?php echo $counter ?></td>
                        <td><?php echo $device_type_name ?></td>
                        <td><?php echo $date_created ?></td>
                        <td><?php echo $status ?></td>
                        <td>
                          <button type="button" data-toggle="modal" data-id="<?php echo $device_type_id; ?>" class="editDeviceTypeBtn btn btn-primary">Edit</button>
                        </td>
                      </tr>
  <?php          }
          }
?>
<script src="../js/it_asset/edit-device-type.js"></script>
