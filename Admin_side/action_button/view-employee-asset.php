<?php
include ('../../Includes/connection.php');

    if(isset($_POST["employee_id"]))
    {
      $employee_id = $_POST["employee_id"];
?>
<div class="remove-itAsset-access">

</div>
<table class="table" id="table_viewEmployeeAsset">
  <thead>
    <th>#</th>
    <th>Device Type</th>
    <th>Device Name</th>
    <th>Brand</th>
    <th>Description/Model/Remarks</th>
    <th>Action</th>
  </thead>
  <tbody>
    <?php
    $assetQuery = "SELECT c.device_type_name, b.device_name, b.brand, b.des_mod_rem, a.asset_id
    FROM employee_asset a
    INNER JOIN it_asset b ON a.asset_id = b.asset_id
    INNER JOIN device_type c ON b.device_type_id = c.device_type_id
    WHERE a.employee_id = '$employee_id'
    ORDER BY b.device_type_id ASC";
    $counter = 0;
    $assetResult = mysqli_query($con, $assetQuery);
    while($row = mysqli_fetch_array($assetResult)){

      $asset_id = $row['asset_id'];
      $device_type_name = $row['device_type_name'];
      $device_name = $row['device_name'];
      $brand = $row['brand'];
      $des_mod_rem = $row['des_mod_rem'];
      $counter++;
?>
    <tr>
      <td><?php echo $counter;?></td>
      <td><?php echo $device_type_name;?></td>
      <td><?php echo $device_name;?></td>
      <td><?php echo $brand;?></td>
      <td><?php echo $des_mod_rem;?></td>
      <td>
        <button type="button" data-toggle="modal" data-employee="<?php echo $employee_id; ?>" data-itasset="<?php echo $asset_id; ?>" class="removeItAsset btn btn-danger">Remove</button>
      </td>
    </tr>


<?php       }
      ?>
</tbody>
</table>
<?php
}
?>
<script src="../js/employee_asset/remove-it-asset.js"></script>
