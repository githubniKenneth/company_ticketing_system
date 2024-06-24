<?php
    session_start();
    include('../../Includes/connection.php');
    date_default_timezone_set('Asia/Manila');
    $current_id = $_SESSION['user_id'];
?>


        <?php
        if(isset($_POST['updateAssetButton']))
        {
            $asset_id = $_POST['asset_id'];
            $date = date('Y-m-d H:i:s');
            // NEW VALUE
            $device_name = $_POST['device_name'];
            $device_type_name = $_POST['device_type_name'];
            $brand = $_POST['brand'];
            $des_mod_rem = $_POST['des_mod_rem'];
            $supplier = $_POST['supplier'];
            $date_acquired = $_POST['date_acquired'];
            $warranty_date = $_POST['warranty_date'];
            $unit_price = $_POST['unit_price'];

            // OLD VALUE
            $old_device_name = $_POST['old_device_name'];
            $old_device_type_name = $_POST['old_device_type_name'];
            $old_brand = $_POST['old_brand'];
            $old_des_mod_rem = $_POST['old_des_mod_rem'];
            $old_supplier = $_POST['old_supplier'];
            $old_date_acquired = $_POST['old_date_acquired'];
            $old_warranty_date = $_POST['old_warranty_date'];
            $old_unit_price = $_POST['old_unit_price'];


            if ($device_name == $old_device_name && $device_type_name == $old_device_type_name && $brand == $old_brand && $des_mod_rem == $old_des_mod_rem && $supplier == $old_supplier && $date_acquired == $date_acquired && $warranty_date == $old_warranty_date && $unit_price == $old_unit_price) {
              // ACTION IF THE EDIT IS STILL THE SAME INFORMATION
              header('location:'.$siteURL.'Admin_side/it_asset.php');
            }
            else {
              // UPDATING THE INFORMATION OF A IT ASSET CHOSEN
              $updateSQL = "UPDATE it_asset SET device_name = '$device_name', device_type_id = '$device_type_name',
                            brand = '$brand', des_mod_rem = '$des_mod_rem', supplier_id = '$supplier',
                            date_acquired = '$date_acquired', warranty_date = '$warranty_date', unit_price = '$unit_price', date_modified = '$date', modified_by = '$current_id'
                            WHERE asset_id ='$asset_id'";
              $update = mysqli_query($con, $updateSQL);


              if($update == true)
              {
                // MESSAGE IF UPDATING IT ASSET IS SUCCESSFUL
                $_SESSION['update'] = "<div class='alert alert-success' role='alert'>
                                        IT Asset Updated Successfully.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/it_asset.php');
              }
              else {
                // MESSAGE IF UPDATING IT ASSET IS FAILED
                $_SESSION['update'] = "<div class='alert alert-danger' role='alert'>
                                        IT Asset Failed to Update.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/it_asset.php');
              }

        }
      }
        ?>
