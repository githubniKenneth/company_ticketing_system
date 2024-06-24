<?php
include ('../../Includes/connection.php');

    if(isset($_POST["deviceType"]))
    {
        $deviceType = $_POST["deviceType"];
        $employee_id = $_POST["employeeId"];
        if($deviceType == "")
        {
          // NOTHING TO SHOW
        }
        else
        {
          // SELECT ALL THE DEVICE THAT HAS A DEVICE TYPE ID CHOSEN FROM THE IT ASSET
          $assetQuery = "SELECT a.asset_id, a.device_name, a.brand, a.des_mod_rem, a.serial_number,
          b.device_type_name
          FROM it_asset a
          INNER JOIN device_type b ON a.device_type_id = b.device_type_id
          WHERE a.status = 0 AND a.device_type_id = '$deviceType'
          ORDER BY b.device_type_name ASC";
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
        }
    }
?>

<script>
// REMOVING THE IT ASSET AFTER CLICKING THE ADD BUTTON FROM THE LIST
  $(document).ready(function() {
      $('.addItAsset').click(function(){
          let employeeId = $(this).data('employee');
          let itAssetId = $(this).data('itasset');
          $(this).closest('tr').remove();
          // alert(itAssetId);
          $.ajax({
              url: 'action_button/set-employee-asset.php',
              type: 'post',
              data: { itAssetId: itAssetId, employeeId : employeeId },
              success: function(response){
                  $('.assign-itAsset-access').html(response);
              }
          });
      });
  });
</script>
