<?php
session_start();
include('../../Includes/connection.php');

    if(isset($_POST["itAssetInputVal"])){
      $input = mysqli_real_escape_string($con, $_POST['itAssetInputVal']); //TO ENSURE THAT THE DATA THAT IS SENT TO THE MYSQL SERVER IS SAFE

      // SELECT THE IT ASSET TO PUT IT TO THE TABLE OF IT ASSET FOR ADDING AFTER "SEARCHING"
            $query  = "SELECT a.asset_id, a.device_name, a.brand, a.des_mod_rem, a.status, a.date_acquired, a.warranty_date, a.unit_price,
            b.device_type_name,
            c.supplier_name
            FROM it_asset a
            INNER JOIN device_type b ON a.device_type_id = b.device_type_id
            INNER JOIN supplier c ON a.supplier_id = c.supplier_id
            WHERE a.device_name LIKE '%$input%' OR b.device_type_name  LIKE '%$input%'
            OR a.brand LIKE '%$input%' OR a.des_mod_rem  LIKE '%$input%'
            OR c.supplier_name  LIKE '%$input%' OR a.date_acquired  LIKE '%$input%'
            OR a.warranty_date  LIKE '%$input%' OR a.unit_price  LIKE '%$input%' ";

            $result = mysqli_query($con, $query);
            $counter = 0;
            while($row = mysqli_fetch_array($result)){
              $assetId = $row['asset_id'];
              $device_name = $row['device_name'];
              $device_type_name = $row['device_type_name'];
              $brand = $row['brand'];
              $des_mod_rem = $row['des_mod_rem'];
              $supplier_name = $row['supplier_name'];
              $date_acquired = $row['date_acquired'];
              $warranty_date = $row['warranty_date'];
              $unit_price = $row['unit_price'];
              $status = $row['status'] == 0? "InActive" : "Active";
              $counter++;
              ?>
                      <tr>
                        <td><?php echo $counter ?></td>
                        <td><?php echo $device_name ?></td>
                        <td><?php echo $device_type_name ?></td>
                        <td><?php echo $brand ?></td>
                        <td><?php echo $des_mod_rem ?></td>
                        <td><?php echo $supplier_name ?></td>
                        <td><?php echo $date_acquired ?></td>
                        <td><?php echo $warranty_date ?></td>
                        <td><?php echo $unit_price ?></td>
                        <td><?php echo $status ?></td>
                        <td>
                          <button type="button" data-toggle="modal" data-id="<?php echo $assetId; ?>" class="editAsset btn btn-primary">Edit</button>
                          <button type="button" data-toggle="modal" data-id="<?php echo $assetId; ?>" class="deleteAsset btn btn-danger">Delete</button>
                        </td>
                      </tr>
  <?php          }
          }
?>
<script src="../js/it_asset/edit.js"></script>
<script src="../js/it_asset/confirm-delete.js"></script>
