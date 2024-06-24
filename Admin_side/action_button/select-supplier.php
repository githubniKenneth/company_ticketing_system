<?php
session_start();
include('../../Includes/connection.php');
// SHOW DEVICE TYPE
if (isset($_POST['selectVal'])) { //js/select-supplier.js
  $selectVal = $_POST['selectVal'];
  if ($selectVal == "") {
    $query = "SELECT * FROM supplier ORDER BY supplier_name ASC";
    $supplierQuery = $con->query($query);
    ?>
    <option value="">Supplier</option>
    <?php
    while($supplierRow = mysqli_fetch_assoc($supplierQuery)){
        $supplier_id = $supplierRow['supplier_id'];
        $supplier_name = $supplierRow['supplier_name'];
          echo '<option value="'.$supplier_id.'">'.$supplier_name.'</option>';
      }
  } else {
    ?>
    <option value="">Supplier</option>
    <?php
    $query = "SELECT * FROM supplier ORDER BY supplier_name ASC";
    $supplierQuery = $con->query($query);

    while($supplierRow = mysqli_fetch_assoc($supplierQuery)){
        $supplier_id = $supplierRow['supplier_id'];
        $supplier_name = $supplierRow['supplier_name'];

        if ($supplier_id == $selectVal) {
          echo '<option value="'.$supplier_id.'" selected>'.$supplier_name.'</option>';
        }else {
          echo '<option value="'.$supplier_id.'">'.$supplier_name.'</option>';
        }
      }
  }
}
