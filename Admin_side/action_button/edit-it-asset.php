<?php
session_start();
include('../../Includes/connection.php');

$assetId = $_POST['assetId'];
// SELECT THE IT ASSET TO PUT IT TO THE MODAL
    $sql="SELECT a.asset_id, a.device_name, a.device_type_id, a.brand, a.des_mod_rem, a.date_acquired, a.warranty_date, a.unit_price, a.supplier_id,
                b.device_type_name,
                c.supplier_name
                FROM it_asset a
                INNER JOIN device_type b ON a.device_type_id = b.device_type_id
                INNER JOIN supplier c ON a.supplier_id = c.supplier_id
                WHERE a.asset_id = '$assetId'";

    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $asset_id = $row['asset_id'];
            $device_name = $row['device_name'];
            $device_type_id = $row['device_type_id'];
            $device_type_name = $row['device_type_name'];
            $brand = $row['brand'];
            $des_mod_rem = $row['des_mod_rem'];
            $supplier_id = $row['supplier_id'];
            $date_acquired = $row['date_acquired'];
            $warranty_date = $row['warranty_date'];
            $unit_price = $row['unit_price'];
            ?>
            <!-- SHOWING THE EXISTING INFORMATION OF A IT ASSET TO BE EDIT -->
                <form action="action_button/update-it-asset.php" method="POST">
                <input type="hidden" name="asset_id" value="<?php echo $asset_id; ?>">
                <div class="form-group">
                    <label for="">Device Name</label>
                    <input type="text" name="device_name" class="form-control" value="<?php echo $device_name; ?>" required>
                    <input type="hidden" name="old_device_name" class="form-control" value="<?php echo $device_name; ?>">
                </div>
                <div class="form-group">
                    <label>Device Type:</label>
                      <!-- SELECTING THE EXISTING DEVICE TYPE AND ALL THE LIST OF DEVICE TYPE -->
                        <select name="device_type_name" class="custom-select" required>
                            <?php
                                $device_typeSql = "SELECT device_type_id, device_type_name FROM device_type";
                                $device_typeQuery = mysqli_query($con, $device_typeSql);
                                $device_typeRowCheck = mysqli_num_rows($device_typeQuery);

                                if($device_typeRowCheck != 0){
                                    while($device_typeRow = mysqli_fetch_assoc($device_typeQuery)){
                                        $newdevice_type_id = $device_typeRow['device_type_id'];
                                        $device_type_name = $device_typeRow['device_type_name'];
                                                ?>
                                        <option value="<?php echo $newdevice_type_id; ?>" <?php if ($newdevice_type_id == $device_type_id) echo 'selected="selected"'?>> <?php echo $device_type_name; ?> </option>
                                                <?php
                                        }
                                    }
                                ?>
                        </select>
                        <input type="hidden" name="old_device_type_name" class="form-control" value="<?php echo $device_type_id; ?>">
                </div>
                <div class="form-group">
                    <label for="">Brand</label>
                    <input type="text" name="brand" class="form-control" value="<?php echo $brand; ?>" required>
                    <input type="hidden" name="old_brand" class="form-control" value="<?php echo $brand; ?>">
                </div>
                <div class="form-group">
                    <label for="">Description/Model/Remarks</label>
                    <input type="text" name="des_mod_rem" class="form-control" value="<?php echo $des_mod_rem; ?>" required>
                    <input type="hidden" name="old_des_mod_rem" class="form-control" value="<?php echo $des_mod_rem; ?>">
                </div>
                <div class="form-group">
                    <label>Supplier:</label>
                      <!-- SELECTING THE EXISTING DEVICE TYPE AND ALL THE LIST OF DEVICE TYPE -->
                        <select name="supplier" class="custom-select" required>
                            <?php
                                $supplierSql = "SELECT supplier_id, supplier_name FROM supplier";
                                $supplierQuery = mysqli_query($con, $supplierSql);
                                $supplierRowCheck = mysqli_num_rows($supplierQuery);

                                if($supplierRowCheck != 0){
                                    while($supplierRow = mysqli_fetch_assoc($supplierQuery)){
                                        $newsupplier_id = $supplierRow['supplier_id'];
                                        $supplier_name = $supplierRow['supplier_name'];
                                                ?>
                                        <option value="<?php echo $newsupplier_id; ?>" <?php if ($newsupplier_id == $supplier_id) echo 'selected="selected"'?>> <?php echo $supplier_name; ?> </option>
                                                <?php
                                        }
                                    }
                                ?>
                        </select>
                        <input type="hidden" name="old_supplier" class="form-control" value="<?php echo $supplier_id; ?>">
                </div>
                <div class="form-group">
                    <label for="">Date Acquired</label>
                    <input type="date" name="date_acquired" class="form-control" value="<?php echo $date_acquired; ?>" required>
                    <input type="hidden" name="old_date_acquired" class="form-control" value="<?php echo $date_acquired; ?>">
                </div>
                <div class="form-group">
                    <label for="">Warranty Date</label>
                    <input type="date" name="warranty_date" class="form-control" value="<?php echo $warranty_date; ?>" required>
                    <input type="hidden" name="old_warranty_date" class="form-control" value="<?php echo $warranty_date; ?>">
                </div>
                <div class="form-group">
                    <label for="">Unit Price</label>
                    <input type="text" name="unit_price" class="form-control" value="<?php echo $unit_price; ?>" required>
                    <input type="hidden" name="old_unit_price" class="form-control" value="<?php echo $unit_price; ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" id="button" name="updateAssetButton" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
            <?php
        }
    }
?>
