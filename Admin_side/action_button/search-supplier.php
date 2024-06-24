<?php
session_start();
include('../../Includes/connection.php');

    if(isset($_POST["supplierInputVal"])){
      $input = mysqli_real_escape_string($con, $_POST['supplierInputVal']); //TO ENSURE THAT THE DATA THAT IS SENT TO THE MYSQL SERVER IS SAFE

      // SELECT THE SUPPLIER TO PUT IT TO THE TABLE OF SUPPLIER FOR ADDING AFTER "SEARCHING"
            $query  = "SELECT a.supplier_id, a.supplier_name, a.date_created, a.status
            FROM supplier a
            WHERE a.supplier_name LIKE '%$input%' OR a.date_created  LIKE '%$input%'";

            $result = mysqli_query($con, $query);
            $counter = 0;
            while($row = mysqli_fetch_array($result)){
              $supplier_id = $row['supplier_id'];
              $supplier_name = $row['supplier_name'];
              $date_created = $row['date_created'];
              $status = $row['status'] == 0? "InActive" : "Active";
              $counter++;
              ?>
                      <tr>
                        <td><?php echo $counter ?></td>
                        <td><?php echo $supplier_name ?></td>
                        <td><?php echo $date_created ?></td>
                        <td><?php echo $status ?></td>
                        <td>
                          <button type="button" data-toggle="modal" data-id="<?php echo $supplier_id; ?>" class="editSupplierBtn btn btn-primary">Edit</button>
                        </td>
                      </tr>
  <?php          }
          }
?>
<script src="../js/it_asset/edit-supplier.js"></script>
