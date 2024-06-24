<?php
    session_start();
    include('../../Includes/connection.php');
    $current_id = $_SESSION['user_id'];

    if(isset($_POST['addDeviceType'])){  //FIRST WAY TO ADD DEVICE TYPE

        $device_type_name = $_POST['device_type_name'];
        $status = 1;
        // SELECT DEVICE TYPE IF IT IS TAKEN
        $sql1 = "SELECT * FROM device_type WHERE device_type_name = '$device_type_name'";
        $selectDeviceTypeName1 = mysqli_query($con, $sql1);
        $resultCheckName1 = mysqli_num_rows($selectDeviceTypeName1);

        if ($resultCheckName1 > 0) {
          // SESSION START FOR ERROR IF THE DEVICE TYPE IS ALREADY BEEN TAKEN
          $_SESSION['addDeviceType'] = "<div class='alert alert-danger' role='alert'>
                              Device Type ".$device_type_name." already been created.
                              </div>";
          header('location:'.$siteURL.'Admin_side/it_asset.php');
        }
        else {
          // INSERTING INTO DEVICE TYPE TABLE
          $sql2 = "INSERT INTO device_type (device_type_name, status, user_id)
                  VALUES('$device_type_name', '$status', '$current_id')";
          $addDeviceTypeName = mysqli_query($con, $sql2);

          if ($addDeviceTypeName == true)
          {
              // SESSION START IF THE INSERTING DEVICE TYPE IS SUCCESSFUL
              $_SESSION['addDeviceType'] = "<div class='alert alert-success' role='alert'>
                                  Device Type Added Successfully.
                                  </div>";
              header('location:'.$siteURL.'Admin_side/it_asset.php');
          }
          else
          {
              // SESSION START IF THE INSERTING DEVICE TYPE TYPE FAILED
              $_SESSION['addDeviceType'] = "<div class='alert alert-danger' role='alert'>
                                  Adding device type failed.
                                  </div>";
              header('location:'.$siteURL.'Admin_side/it_asset.php');
          }
        }
    }
    elseif (isset($_POST['itAssetInput'])) { //SECOND WAY TO ADD DEVICE TYPE

      $itAssetInput = $_POST['itAssetInput'];
      // SELECT DEVICE TYPE IF IT IS TAKEN
      $sql3 = "SELECT device_type_name FROM device_type WHERE device_type_name = '$itAssetInput'";
      $selectDeviceTypeName = mysqli_query($con, $sql3);
      $resultCheckName2 = mysqli_num_rows($selectDeviceTypeName);
      $status = 1;

      if ($resultCheckName2 != 0) {
        echo 1; // TO HAVE ERROR MESSAGES FROM JQUERY
      }else {
        // INSERTING NEW DEVICE TYPE
          $sql = "INSERT INTO device_type (device_type_name, status, user_id)
                  VALUES('$itAssetInput', '$status', '$current_id')";
          $addDeviceTypeName = mysqli_query($con, $sql);
          if ($addDeviceTypeName == true) {
            // SELECT DEVICE TYPE ID AND DEVICE TYPE NAME TO SHOW IN SELECTION
            $deviceTypeSelect = "SELECT device_type_id, device_type_name FROM device_type WHERE device_type_name = '$itAssetInput'";
            $DeviceTypeName = mysqli_query($con, $deviceTypeSelect);
            while ($rowDeviceTypeRow = (mysqli_fetch_assoc($DeviceTypeName))) {
              $device_type_id = $rowDeviceTypeRow['device_type_id'];
              $device_type_name = $rowDeviceTypeRow['device_type_name'];
              ?>
              <option value="<?php echo $device_type_id;?>" selected><?php echo $device_type_name; ?></option>
              <?php
            }
          }
        }

    }
?>
