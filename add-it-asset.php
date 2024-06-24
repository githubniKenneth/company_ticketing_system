<?php
include ('Includes/connection.php');
if (isset($_POST["device_name"])) {
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

    $sql = "INSERT INTO it_asset (device_type_id, device_name, brand, des_mod_rem, serial_number, product_number, supplier, date_acquired, warranty_date, unit_price, user_id)
            VALUES ('$device_type', '$device_name', '$brand', '$des_mod_rem', '$serial_number', '$product_number', '$supplier', '$date_acquired', '$warranty_date', '$unit_price')";

    $query = mysqli_query($con, $sql);
    if ($query == true) {
      $_SESSION['add'] = "<div class='alert alert-success' role='alert'>
                          IT Asset Added Successfully.
                          </div>";
      header('location:'.$siteURL.'Admin_side/it_asset.php');
    }
    else
    {
        $_SESSION['add'] = "<div class='alert alert-success' role='alert'>
                            IT Asset Company Failed.
                            </div>";
        header('location:'.$siteURL.'Admin_side/it_asset.php');
    }
  }
}
