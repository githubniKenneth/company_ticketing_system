<?php
include ('../../Includes/connection.php');

    if(isset($_POST["employee_id"]))
    {

      $employee_id = $_POST["employee_id"];
?>
<div class="assign-itAsset-access">
  <!-- TARGET DIV FOR ERROR/SUCCESSFUL MESSAGES -->
</div>
<!-- TABLE FOR AVAILABLE IT ASSET TO BE ADDED IN EMPLOYEE -->
    <table class="table" id="table_addEmployeeAsset">
      <thead>
        <th>#</th>
        <th>Device Type</th>
        <th>Device Name</th>
        <th>Brand</th>
        <th>Description/Model/Remarks</th>
        <th>Serial Number</th>
        <th>Action</th>
      </thead>
      <tbody class="target-search-additAsset">
        <?php
        $assetQuery = "SELECT a.asset_id, a.device_name, a.brand, a.des_mod_rem, a.serial_number,
        b.device_type_name
        FROM it_asset a
        INNER JOIN device_type b ON a.device_type_id = b.device_type_id
        WHERE a.status = 0
        ORDER BY b.device_type_id ASC";
        $counter = 0;
        $assetResult = mysqli_query($con, $assetQuery);
        while($row = mysqli_fetch_array($assetResult)){
          $asset_id = $row['asset_id'];
          $device_type_name = $row['device_type_name'];
          $device_name = $row['device_name'];
          $brand = $row['brand'];
          $des_mod_rem = $row['des_mod_rem'];
          $serial_number = $row['serial_number'];
          $counter++;
?>
        <tr>
          <td><?php echo $counter;?></td>
          <td><?php echo $device_type_name;?></td>
          <td><?php echo $device_name;?></td>
          <td><?php echo $brand;?></td>
          <td><?php echo $des_mod_rem;?></td>
          <td><?php echo $serial_number;?></td>
          <td>
            <button type="button" data-toggle="modal" data-employee="<?php echo $employee_id; ?>" data-itasset="<?php echo $asset_id; ?>" class="addItAsset btn btn-success">Add</button>
          </td>
        </tr>
<?php       }
          ?>
</tbody>
    </table>
<?php } ?>
<script src="../js/employee_asset/adding-employee.asset.js"></script>
