<?php
session_start();
include ('../Includes/adminSidebar.php');

// SHOW EMPLOYEE LIST
function fill_unit_select_box_employee($con){
  $outEmployee;
  $queryEmployee = "SELECT employee_id, CONCAT(firstname, ' ', lastname) AS employee_name FROM employee ORDER BY employee_name ASC";
  $employeeQuery = $con->query($queryEmployee);

  while($employeeRow = mysqli_fetch_assoc($employeeQuery)){
      $employee_id = $employeeRow['employee_id'];
      $employee_name = $employeeRow['employee_name'];

      $outEmployee = '<option value="'.$employee_id.'">'.$employee_name.'</option>';
      echo $outEmployee;
    }
}
?>

<h2 class="my-5">IT Asset</h2>
<?php
// MESSAGES AFTER SUBMISSION
if(isset($_SESSION['delete_it_asset']))
{
    echo $_SESSION['delete_it_asset'];
    unset($_SESSION['delete_it_asset']);
}
if(isset($_SESSION['additAsset']))
{
    echo $_SESSION['additAsset'];
    unset($_SESSION['additAsset']);
}
if(isset($_SESSION['addDeviceType']))
{
    echo $_SESSION['addDeviceType'];
    unset($_SESSION['addDeviceType']);
}
if(isset($_SESSION['update']))
{
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}
if(isset($_SESSION['serial_product']))
{
    echo $_SESSION['serial_product'];
    unset($_SESSION['serial_product']);
}
if(isset($_SESSION['addSupplier']))
{
    echo $_SESSION['addSupplier'];
    unset($_SESSION['addSupplier']);
}
?>
<link rel="stylesheet" href="../CSS/it_asset.css">
<div class="d-flex justify-content-end mb-2">
  <!-- ADD IT ASSET BUTTON -->
  <div class="form-inline d-flex justify-content-end mb-2">
      <button type="button" data-toggle="modal" data-target="#addSupplier" data-backdrop="static" class="btn btn-success mr-2">Add Supplier</button>
  </div>
  <!-- ADD DEVICE TYPE BUTTON -->
  <div class="form-inline d-flex justify-content-end mb-2">
      <button type="button" data-toggle="modal" data-target="#addDeviceType" class="btn btn-success mr-2">Add Device Type</button>
  </div>
  <!-- ADD IT ASSET BUTTON -->
  <div class="form-inline d-flex justify-content-end mb-2">
      <button type="button" data-toggle="modal" data-target="#addItAsset" data-backdrop="static" class="btn btn-success mr-2">Add IT Asset</button>
  </div>
</div>
<!-- SEARCH BAR FOR IT ASSET TABLE -->
<form class="form-inline mb-2 d-flex justify-content-end">
      <div class="">
        <button id="search_itAsset_btn" class="btn btn-primary mr-sm-2 mb-2" type="button">Search</button>
        <input id="itAsset_search" class="form-control mr-sm-2 mb-2 align-middle" type="search" placeholder="Search" aria-label="Search">
      </div>
  </form>
  <!-- TABLE LIST OF IT ASSET -->
<table class="table" id="table_itAsset">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Device Name</th>
        <th scope="col">Device Type</th>
        <th scope="col">Brand</th>
        <th scope="col">Description/Model/Remarks</th>
        <th scope="col">Supplier</th>
        <th scope="col">Date Acquired</th>
        <th scope="col">Warranty Date</th>
        <th scope="col">Status</th>
        <th scope="col">Unit Price</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody class="target-search-itAsset">
      <?php
      $counter = 0;
          $query = "SELECT a.asset_id, a.brand, a.des_mod_rem, a.serial_number, a.product_number,
          c.supplier_name, a.date_acquired, a.warranty_date, a.unit_price, a.device_name, a.date_created, b.device_type_name, a.status
          FROM it_asset a
          INNER JOIN device_type b ON a.device_type_id = b.device_type_id
          INNER JOIN supplier c ON a.supplier_id = c.supplier_id
          ORDER BY b.device_type_name ASC;";

          $result = mysqli_query($con, $query);
          while($row = mysqli_fetch_array($result)){
            $assetId = $row['asset_id'];
            $device_type_name = $row['device_type_name'];
            $brand = $row['brand'];
            $des_mod_rem = $row['des_mod_rem'];
            $serial_number = $row['serial_number'];
            $supplier_name = $row['supplier_name'];
            $date_acquired = $row['date_acquired'];
            $warranty_date = $row['warranty_date'];
            $unit_price = $row['unit_price'];
            $device_name = $row['device_name'];
            $assetStatus = $row['status'] == 0 ? "InActive" : "Active";
            $counter++;
              ?>
                <tr>
                      <td class="font-weight-bold"><?php echo $counter;?></td>
                      <td><?php echo $device_name;?></td>
                      <td><?php echo $device_type_name;?></td>
                      <td><?php echo $brand;?></td>
                      <td><?php echo $des_mod_rem;?></td>
                      <td><?php echo $supplier_name;?></td>
                      <td><?php echo $date_acquired;?></td>
                      <td><?php echo $warranty_date;?></td>
                      <td><?php echo $assetStatus;?></td>
                      <td><?php echo $unit_price;?></td>
                      <td>
                      <button type="button" data-toggle="modal" data-id="<?php echo $assetId; ?>" class="editAsset btn btn-primary">Edit</button>
                      <button type="button" data-toggle="modal" data-id="<?php echo $assetId; ?>" class="deleteAsset btn btn-danger">Delete</button>
                      </td>
                  </tr>
                  <?php
          }
?>
    </tbody>
</table>

<!-- ADD SUPPLIER MODAL -->
<div class="modal" id="addSupplier" tabindex="-1" aria-labelledby="addSupplierModal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <div class="d-flex align-items-center">
                  <h5 class="modal-title mr-2">Add Supplier</h5>
                  <button type="button" class="show_supplier btn btn-info btn-sm">Show</button>
                </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="msg_edit_supplier">
              </div>
              <!-- LIST OF SUPPLIER MODAL INSIDE THE ADD DEVICE TYPE MODAL -->
              <div class="modal fade" id="showSupplier" tabindex="-1" aria-labelledby="showSupplierModal" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">List of Supplier</h5>
                              <button type="button" class="close close_show_supplier" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body showSupplier_body">

                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-body">
                  <!-- Add Device Type modal.php -->
                  <form action="action_button/add-supplier.php" method="POST">
                      <div>
                          <div class="form-group">
                              <label for="">Supplier</label>
                              <input type="text" name="supplier" class="form-control" placeholder="Enter Supplier" required>
                          </div>
                      <div class="modal-footer">
                          <button type="submit" name="addSupplier" class="btn btn-primary">Save Changes</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- EDIT IT SUPPLIER MODAL INSIDE THE ADD SUPPLIER MODAL -->
<div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Supplier</h5>
                <button type="button" class="close edit_supplier_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body target-modal-editSupplier">

            </div>
        </div>
    </div>
</div>
<!-- ADD DEVICE TYPE MODAL -->
<div class="modal" id="addDeviceType" tabindex="-1" aria-labelledby="addDeviceTypeModal" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <div class="d-flex align-items-center">
                  <h5 class="modal-title mr-2" id="addDeviceTypeModalLabel">Add Device Type</h5>
                  <button type="button" class="show_device_type btn btn-info btn-sm">Show</button>
                </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="msg_edit_device_type">
              </div>
              <!-- LIST OF DEVICE TYPE MODAL INSIDE THE ADD DEVICE TYPE MODAL -->
              <div class="modal fade" id="showDeviceType" tabindex="-1" aria-labelledby="showDeviceTypeModal" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="showDeviceTypeModal">List Of Device Type</h5>
                              <button type="button" class="close close_show_device_type" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body showDeviceType_body">

                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-body">
                  <!-- Add Device Type modal.php -->
                  <form action="action_button/add-device-type.php" method="POST">
                      <div id="device_name_title">
                          <div class="form-group">
                              <label for="">Device Type Name</label>
                              <input type="text" name="device_type_name" class="form-control" placeholder="Enter Device name" required>
                          </div>
                      <div class="modal-footer">
                          <button type="submit" name="addDeviceType" class="btn btn-primary">Save Changes</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- EDIT IT DEVICE TYPE MODAL INSIDE THE ADD DEVICE TYPE MODAL -->
<div class="modal fade" id="editDeviceTypeModal" tabindex="-1" aria-labelledby="editDeviceTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDeviceTypeModalLabel">Edit Device Type</h5>
                <button type="button" class="close edit_device_type_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body target-modal-editDeviceType">

            </div>
        </div>
    </div>
</div>
<!-- EDIT IT ASSET MODAL -->
<div class="modal fade" id="editItAssetModal" tabindex="-1" aria-labelledby="editItAssetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit IT Asset</h5>
                <button type="button" class="close edit_device_type_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="target-modal-editAsset">

            </div>
        </div>
    </div>
</div>
<!-- ADD IT ASSET MODAL WITH ADD DEVICE AND ASSIGNING ASSET -->
<div class="modal fade" id="addItAsset" tabindex="-1" aria-labelledby="addItAssetModal" aria-hidden="true">
    <div class="modal-dialog" id="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title" id="addAssetModalLabel">Add IT Asset</h5>
                <div class="error-add">

                </div>
                <div class="d-flex">
                  <div class="d-flex">
                    <button type="button" data-toggle="modal" data-target="#addSupplier2" class="btn btn-success addSupplier mr-2">Add Supplier</button>
                    <button type="button" data-toggle="modal" data-target="#addDeviceType2" class="btn btn-success addDeviceType mr-2">Add Device Type</button>
                    <button type="button" class="btn btn-success addMore">Add More</button>
                  </div>
                  <!-- ADD DEVICE TYPE INSIDE THE ADD IT ASSET MODAL -->
                  <div class="modal fade addDeviceType2" id="addDeviceType2" tabindex="-1" aria-labelledby="addDeviceTypeModal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addDeviceTypeModalLabel">Add Device Type</h5>
                                    <button type="button" class="close close_modal_add_deviceType" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                  <div id="device_name_title">
                                      <div class="form-group">
                                          <label for="">Device Type Name</label>
                                          <input type="text" id="deviceTypeInput" name="device_type_name" class="form-control" placeholder="Enter Device name" required>
                                      </div>
                                  <div class="modal-footer">
                                      <button type="submit" name="addDeviceType" class="addDeviceTypeSave btn btn-primary">Save changes</button>
                                      <button type="button" class="btn btn-secondary close_modal_add_deviceType">Close</button>
                                  </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- ADD SUPPLIER INSIDE THE ADD IT ASSET MODAL -->
                  <div class="modal fade addSupplier2" id="addSupplier2" tabindex="-1" aria-labelledby="addSupplierModal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Supplier</h5>
                                    <button type="button" class="close close_modal_add_supplier" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                  <div>
                                      <div class="form-group">
                                          <label for="">Supplier Name</label>
                                          <input type="text" id="supplierInput" name="supplier_name" class="form-control" placeholder="Enter New Supplier" required>
                                      </div>
                                  <div class="modal-footer">
                                      <button type="submit" name="addDeviceType" class="addSupplierSave btn btn-primary">Save changes</button>
                                      <button type="button" class="btn btn-secondary close_modal_add_supplier">Close</button>
                                  </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>
            <div id="add-it-asset" class="modal-body">
                <!-- FORM TO ADD IT ASSET -->
                <form id="form-add-more" action="action_button/add-itAsset.php" class="form-inline form-practice" method="post">
                  <div class="table-responsive">
                    <table class="table tabled-bordered" id="item_table">
                      <thead>
                        <tr>
                          <th scope="col">Device Name</th>
                          <th scope="col">Device Type</th>
                          <th scope="col">Brand</th>
                          <th scope="col">Description/Model/Remarks</th>
                          <th scope="col">Serial Number</th>
                          <th scope="col">Product Number</th>
                          <th scope="col">Supplier</th>
                          <th scope="col">Date Acquired</th>
                          <th scope="col">Warranty Date</th>
                          <th scope="col">Unit Price</th>
                          <th scope="col">Asign</th>
                        </tr>
                      </thead>
                    </table>
                    <div class="center">
                      <div class="modal-footer">
                        <button type="submit" name="addItAsset" class="btn btn-primary" id="submit_new_assets" >Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </form>
        </div>
    </div>
</div>
</div>
<!-- CONFIRM DELETE IT ASSET -->
<div class="modal fade" id="confirm-delete-itasset" tabindex="-1" aria-labelledby="removeItAssetModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" id="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-end">
                <div class="d-flex">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>
            <div id="delete-itAsset" class="modal-body">

        </div>
    </div>
  </div>
</div>
<?php
include ('../Includes/adminFooter.php');
?>
<script>
  let count = 0;
  // JS FOR ADD MORE BUTTON
  $(document).ready(function(){
    // FUNCTION ADD MORE
    function add_more_field(count){
      let tableTr = '';

      tableTr += '<tr class="td-addItAsset">';

      tableTr += '<td><input type="text" name="device_name[]" id="device_name" class="device_name form-control text-capitalize" placeholder="Name"></td>';

      tableTr += '<td><select name="device_type[]" data-id="'+count+'" id="d-type" class="d-type targetDeviceType-'+count+' form-control text-capitalize flex-nowrap" data-live-search="true" required><option value="">Device Type</option></select></td>';

      tableTr += '<td><input type="text" name="brand[]" id="brand" class="form-control text-capitalize" placeholder="Brand"></td>';

      tableTr += '<td><input type="text" name="des_mod_rem[]" id="des_mod_rem" class="form-control text-capitalize" placeholder="Description"></td>';

      tableTr += '<td><input type="text" name="serial_number[]" id="serial_number" class="form-control text-capitalize" placeholder="Serial Number"></td>';

      tableTr += '<td><input type="text" name="product_number[]" id="product_number" class="form-control text-capitalize" placeholder="Product Number"></td>';

      tableTr += '<td><select name="supplier[]" id="supplier" data-id="'+count+'" class="supplier targetSupplier-'+count+' form-control text-capitalize flex-nowrap" data-live-search="true" required><option value="">Supplier</option></select></td>';

      tableTr += '<td><input type="date" name="date_acquired[]" id="date_acquired" class="text-uppercase form-control" value="<?php echo date("Y-m-d");?>"></td>';

      tableTr += '<td><input type="date" name="warranty_date[]" id="warranty_date" class="text-uppercase form-control" placeholder="Warranty Date"></td>';

      tableTr += '<td><input type="number" name="unit_price[]" id="unit_price" class="form-control text-capitalize" placeholder="Price"></td>';

      tableTr += '<td><select name="employee[]" class="form-control text-capitalize" id="employee_assign" data-live-search="true"><option value="">Select Employee</option><?php echo fill_unit_select_box_employee($con);?></select></td>';

      let remove_button = '';

      if(count > 0){
        remove_button = '<button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button>';
      }
      tableTr += '<td>'+remove_button+'</td></tr>';
      return tableTr;
    }
    $('#item_table').append(add_more_field(0));

    $(document).on('click', '.addMore', function(){
       count++;
       $('#item_table').append(add_more_field(count));
    });
    $(document).on('click', '.remove', function(){
      $(this).closest('tr').remove();
    });
  });
</script>
<script src="../js/it_asset/add-device-type.js"></script>
<script src="../js/it_asset/add-supplier.js"></script>
<script src="../js/it_asset/select-supplier.js"></script>
<script src="../js/it_asset/select-device-type.js"></script>
<script src="../js/it_asset/close-modal.js"></script>
<script src="../js/it_asset/edit.js"></script>
<script src="../js/it_asset/confirm-delete.js"></script>
<script src="../js/it_asset/show-device-type.js"></script>
<script src="../js/it_asset/show-supplier.js"></script>
<script src="../js/it_asset/search-it-asset.js"></script>
