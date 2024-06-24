<?php
session_start();
include ('../../Includes/connection.php');
$current_id = $_SESSION['user_id'];
date_default_timezone_set('Asia/Manila');
$error = 0;
$count = 1;
if (isset($_POST['addItAsset'])) {
  for ($count = 0; $count < count($_POST["device_name"]); $count ++) {

    $device_name = $_POST["device_name"][$count];
    $device_type = $_POST["device_type"][$count];
    $brand = $_POST["brand"][$count];
    $des_mod_rem = $_POST["des_mod_rem"][$count];
    $serial_number = $_POST["serial_number"][$count];
    $product_number = $_POST["product_number"][$count];
    $supplier = $_POST["supplier"][$count];
    $date_acquired = $_POST["date_acquired"][$count];
    $warranty_date = $_POST["warranty_date"][$count];
    $unit_price = $_POST["unit_price"][$count];
    $employee_id = $_POST["employee"][$count];
    $date_created = date('Y-m-d H:i:s');

    // SELECT IF SERIAL NUMBER OR PRODUCT NUMBER IS THE SAME
    $serCheck="SELECT a.serial_number
                FROM it_asset a
                WHERE a.serial_number = '$serial_number'";

    $resultQuery = mysqli_query($con, $serCheck);
    $resultCheckSerPro = mysqli_num_rows($resultQuery);
    if ($resultCheckSerPro != 0) {
      $error++;
      // MESSAGE IF THE SERIAL NUMBER OR PRODUCT NUMBER ALREADY BEEN EXISTING
      if (count($_POST["device_name"]) == 1) {
        $_SESSION['serial_product'] = "<div class='alert alert-danger' role='alert'>
                            Serial number of ".$device_name." already taken.
                            </div>";
        header('location:'.$siteURL.'Admin_side/it_asset.php');
      }
    } elseif ($resultCheckSerPro == 0) { //SERIAL NUMBER IS UNIQUE
      // INSERTING NEW IT ASSET
      $sql = "INSERT INTO it_asset (device_type_id, device_name, brand, des_mod_rem, serial_number, product_number, supplier_id, date_acquired, warranty_date, unit_price, date_created, user_id)
              VALUES ('$device_type', '$device_name', '$brand', '$des_mod_rem', '$serial_number', '$product_number', '$supplier', '$date_acquired', '$warranty_date', '$unit_price', '$date_created', '$current_id')";
      $query = mysqli_query($con, $sql);

            if ($query == true && $employee_id != "") {
              // SELECT ASSET ID TO INSERT TO EMPLOYEE ASSET
              $assetIdCheck="SELECT asset_id FROM it_asset WHERE serial_number = '$serial_number'";
                          $assetIdquery = mysqli_query($con, $assetIdCheck);

                          while ($rowAssetId = mysqli_fetch_assoc($assetIdquery)) {
                            $count++;
                            $assetId = $rowAssetId['asset_id'];
                            // INSERTING NEW EMPLOYEE ASSET IF THE IT ASSET ASSIGNED IT TO SOMEONE
                            $sqlEmployeeAsset = "INSERT INTO employee_asset (employee_id, asset_id, date_created, user_id)
                                                VALUES ('$employee_id', '$assetId', '$date_created', '$current_id')";
                            $queryEmployeeAsset = mysqli_query($con, $sqlEmployeeAsset);
                            // UPDATE THE IT ASSET TO 1(USED) ASSIGNED TO THE EMPLOYEE
                            $assetIdUpdate="UPDATE it_asset SET status = 1 WHERE asset_id = '$assetId'";
                                        $assetIdUpdated = mysqli_query($con, $assetIdUpdate);
                            // MESSAGE IF ADDING NEW IT ASSET IS SUCCESSFUL AND ASSIGNING TO THE EMPLOYEE
                            $_SESSION['additAsset'] = "<div class='alert alert-success' role='alert'>
                                                ".$count." IT Asset Adding Successful and error is ".$error.".
                                                </div>";
                            header('location:'.$siteURL.'Admin_side/it_asset.php');
                          }
                }
            elseif ($query == true) {
              // MESSAGE IF ADDING NEW IT ASSET IS SUCCESSFUL
              $count++;
              $_SESSION['additAsset'] = "<div class='alert alert-success' role='alert'>
                                  ".$count." IT Asset Adding Successful and error is ".$error.".
                                  </div>";
              header('location:'.$siteURL.'Admin_side/it_asset.php');
            }
            elseif ($query != true) {
              // MESSAGE IF ADDING NEW IT ASSET IS FAILED
              $count++;
              $_SESSION['additAsset'] = "<div class='alert alert-danger' role='alert'>
                                  ".$count." IT Asset Adding Failed.
                                  $count++;
                                  </div>";
              header('location:'.$siteURL.'Admin_side/it_asset.php');
            }
    }
  }
}
