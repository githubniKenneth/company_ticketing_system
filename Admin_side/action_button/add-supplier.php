<?php
    session_start();
    include('../../Includes/connection.php');
    $current_id = $_SESSION['user_id'];
    date_default_timezone_set('Asia/Manila');
    $date_created = date('Y-m-d H:i:s');

    if(isset($_POST['addSupplier'])){  //FIRST WAY TO ADD DEVICE TYPE

        $supplier_name = $_POST['supplier'];
        $status = 1;
        // SELECT DEVICE TYPE IF IT IS TAKEN
        $sql1 = "SELECT * FROM supplier WHERE supplier_name = '$supplier_name'";
        $selectSupplierName1 = mysqli_query($con, $sql1);
        $resultCheckName1 = mysqli_num_rows($selectSupplierName1);

        if ($resultCheckName1 > 0) {
          // SESSION START FOR ERROR IF THE DEVICE TYPE IS ALREADY BEEN TAKEN
          $_SESSION['addSupplier'] = "<div class='alert alert-danger' role='alert'>
                              Supplier ".$supplier_name." already been created.
                              </div>";
          header('location:'.$siteURL.'Admin_side/it_asset.php');
        }
        else {
          // INSERTING INTO DEVICE TYPE TABLE
          $sql2 = "INSERT INTO supplier (supplier_name, date_created, status, user_id)
                  VALUES('$supplier_name', '$date_created', '$status', '$current_id')";
          $addSupplierName = mysqli_query($con, $sql2);

          if ($addSupplierName == true)
          {
              // SESSION START IF THE INSERTING DEVICE TYPE IS SUCCESSFUL
              $_SESSION['addSupplier'] = "<div class='alert alert-success' role='alert'>
                                  Supplier Added Successfully.
                                  </div>";
              header('location:'.$siteURL.'Admin_side/it_asset.php');
          }
          else
          {
              // SESSION START IF THE INSERTING DEVICE TYPE TYPE FAILED
              $_SESSION['addSupplier'] = "<div class='alert alert-danger' role='alert'>
                                  Adding Supplier failed.
                                  </div>";
              header('location:'.$siteURL.'Admin_side/it_asset.php');
          }
        }
    }
    elseif (isset($_POST['supplierInput'])) { //SECOND WAY TO ADD DEVICE TYPE

      $supplierInput = $_POST['supplierInput'];
      // SELECT SUPPLIER IF IT IS TAKEN
      $sql3 = "SELECT supplier_name FROM supplier WHERE supplier_name = '$supplierInput'";
      $selectSupplierName = mysqli_query($con, $sql3);
      $resultCheckName2 = mysqli_num_rows($selectSupplierName);
      $status = 1;

      if ($resultCheckName2 > 0) {
        echo 1; // TO HAVE ERROR MESSAGES FROM JQUERY
      }else {
        // INSERTING NEW SUPPLIER
          $sql = "INSERT INTO supplier (supplier_name, date_created, status, user_id)
                  VALUES('$supplierInput', '$date_created', '$status', '$current_id')";
          $addSupplierName = mysqli_query($con, $sql);
          if ($addSupplierName == true) {
            // SELECT SUPPLIER ID AND DEVICE TYPE NAME TO SHOW IN SELECTION
            $supplierSelect = "SELECT supplier_id, supplier_name FROM supplier WHERE supplier_name = '$supplierInput'";
            $supplierName = mysqli_query($con, $supplierSelect);
            while ($rowSupplierRow = (mysqli_fetch_assoc($supplierName))) {
              $supplier_id = $rowSupplierRow['supplier_id'];
              $supplier_name = $rowSupplierRow['supplier_name'];
              ?>
              <option value="<?php echo $supplier_id;?>" selected><?php echo $supplier_name; ?></option>
              <?php
            }
          }
        }
    }
?>
