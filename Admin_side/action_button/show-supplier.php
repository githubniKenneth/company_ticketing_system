<?php
session_start();
include('../../Includes/connection.php');
?>
<form class="form-inline mb-2 d-flex justify-content-end">
      <div class="">
        <button id="srch_btn_supplier" class="btn btn-primary mr-sm-2 mb-2" type="button">Search</button>
        <input id="srch_input_supplier" class="form-control mr-sm-2 mb-2 align-middle" type="search" placeholder="Search" aria-label="Search">
      </div>
  </form>
<!-- TABLE OF LIST OF DEVICE TYPE  -->
<table class="table" id="table_supplier">
  <thead>
    <th>#</th>
    <th>Supplier</th>
    <th>Date Created</th>
    <th>Status</th>
    <th>Action</th>
  </thead>
  <tbody class="target-search-supplier">
  <?php
  $counter = 0;
    $supplierQuery = "SELECT a.supplier_id, a.supplier_name, a.date_created, a.status
    FROM supplier a";
    $supplierResult = mysqli_query($con, $supplierQuery);
    while ($supplierRow = mysqli_fetch_assoc($supplierResult)) {
      $supplier_id = $supplierRow['supplier_id'];
      $supplier_name = $supplierRow['supplier_name'];
      $date_created = $supplierRow['date_created'];
      $status = $supplierRow['status'] == 0? "InActive" : "Active";
      $statusNum = $supplierRow['status'];
      $counter++;
      ?>
      <tr>
        <td><?php echo $counter;?></td>
        <td class="device_type_td"><?php echo $supplier_name;?></td>
        <td><?php echo $date_created;?></td>
        <td><?php echo $status;?></td>
        <td>
        <button type="button" data-toggle="modal" data-id="<?php echo $supplier_id; ?>" class="editSupplierBtn btn btn-primary">Edit</button>
        </td>
      </tr>
      <?php
    }
    ?>
  </tbody>
</table>
<script src="../js/it_asset/edit-supplier.js"></script>
<script src="../js/it_asset/search-supplier.js"></script>
