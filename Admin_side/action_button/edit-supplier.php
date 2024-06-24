<?php
session_start();
include('../../Includes/connection.php');

if (isset($_POST['supplier_id'])) {
$supplier_id = $_POST['supplier_id'];
// SELECT THE SUPPLIER TO PUT IT TO THE MODAL
    $sql="SELECT supplier_id, supplier_name FROM supplier WHERE supplier_id = '$supplier_id'";
    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $supplier_id = $row['supplier_id'];
            $supplier_name = $row['supplier_name'];

            ?>
            <!-- SHOWING THE EXISTING INFORMATION OF A SUPPLIER TO BE EDIT -->
                <input type="hidden" name="supplier_id" class="supplier_id" value="<?php echo $supplier_id; ?>">
                <div class="form-group">
                    <label for="">Supplier</label>
                    <input type="text" name="supplier_name" class="form-control supplier_name" value="<?php echo $supplier_name; ?>" required>
                    <input type="hidden" name="old_supplier_name" class="form-control old_supplier_name" value="<?php echo $supplier_name; ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" id="button" name="updateSupplierBtn" class="updateSupplierBtn btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary edit_supplier_close" data-dismiss="modal">Close</button>
                </div>
            <?php
        }
    } ?>
<script src="../js/it_asset/close-modal.js"></script>
<script src="../js/it_asset/add-supplier.js"></script>
    <?php
    }
?>
