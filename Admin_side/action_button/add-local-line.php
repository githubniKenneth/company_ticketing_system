<?php
    session_start();
    include('../../Includes/connection.php');
    $current_id = $_SESSION['user_id'];
    date_default_timezone_set('Asia/Manila');
    if(isset($_POST['addLocalTelButton'])){

        $telLocal = $_POST['local_tel'];
        $date_created = date('Y-m-d H:i:s');
        // SELECT TEL LOCAL IF THE INPUT IS EXISTING IN THE TABLE OF TEL LOCAL DIRECTORY
        $selectLocalTel = "SELECT tel_local FROM tel_local_directory WHERE tel_local = '$telLocal'";
        $selectLocalTel = mysqli_query($con, $selectLocalTel);
        $rowLocalTel = mysqli_num_rows($selectLocalTel);

        if ($rowLocalTel != 0) {
          // MESSAGE IF LOCAL TELEPHONE DIRECTORY EXIST ALREADY
          $_SESSION['addTel_local'] = "<div class='alert alert-danger' role='alert'>
                              Local Telephone already been taken.
                              </div>";
          header('location:'.$siteURL.'Admin_side/local_line.php');
        }
        else {
          // INSERTING NEW LOCAL TELEPHONE DIRECTORY
          $sql = "INSERT INTO tel_local_directory (tel_local, date_created, user_id)
                  VALUES('$telLocal', '$date_created', '$current_id')";

          $addLocalTel = mysqli_query($con, $sql);

          if ($addLocalTel == true)
          {
            // MESSAGE IF ADDING NEW LOCAL TELEPHONE DIRECORY IS SUCCESSFUL
              $_SESSION['addTel_local'] = "<div class='alert alert-success' role='alert'>
                                  Local Telephone Added Successfully.
                                  </div>";
              header('location:'.$siteURL.'Admin_side/local_line.php');
          }
          else
          {
            // MESSAGE IF ADDING NEW LOCAL TELEPHONE DIRECORY IS FAILED
              $_SESSION['addTel_local'] = "<div class='alert alert-danger' role='alert'>
                                  Failed to add Local Telephone.
                                  </div>";
              header('location:'.$siteURL.'Admin_side/local_line.php');
          }
        }

    }
?>
