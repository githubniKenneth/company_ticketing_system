<?php
session_start();
include('../../Includes/connection.php');

if (isset($_POST['device_type_id'])) {
$device_type_id = $_POST['device_type_id'];
// SELECT THE EXTERNAL TELEPHONE DIRECTORY TO PUT IT TO THE MODAL
    $sql="SELECT device_type_id, device_type_name FROM device_type WHERE device_type_id = '$device_type_id'";
    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $device_type_id = $row['device_type_id'];
            $device_type_name = $row['device_type_name'];

            ?>
            <!-- SHOWING THE EXISTING INFORMATION OF A DEVICE TYPE TO BE EDIT -->
                <input type="hidden" name="device_type_id" class="device_type_id" value="<?php echo $device_type_id; ?>">
                <div class="form-group">
                    <label for="">Device Type</label>
                    <input type="text" name="device_type_name" class="form-control device_type_name" value="<?php echo $device_type_name; ?>" required>
                    <input type="hidden" name="old_device_type_name" class="form-control old_device_type_name" value="<?php echo $device_type_name; ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" id="button" name="updateDeviceTypeBtn" class="updateDeviceTypeBtn btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary edit_device_type_close" data-dismiss="modal">Close</button>
                </div>
            <?php
        }
    } ?>
<script src="../js/it_asset/close-modal.js"></script>
<script src="../js/it_asset/add-device-type.js"></script>
    <?php
    }
?>
