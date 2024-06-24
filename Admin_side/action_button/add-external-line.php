<?php
    session_start();
    include('../../Includes/connection.php');
    $current_id = $_SESSION['user_id'];
    date_default_timezone_set('Asia/Manila');

    if(isset($_POST['addExternalTelButton'])){

        $external_tel = $_POST['external_tel'];
        $reception_id = $_POST['reception_id'];
        $class_of_service = $_POST['class_of_service'];
        $company_id = $_POST['company_id'];
        $date_created = date('Y-m-d H:i:s');
        $status = 1;
        // INSERTING NEW EXTERNAL TELEPHONE DIRECTORY
        $sql = "INSERT INTO tel_external_directory (tel_external, reception_id, class_of_service, company_id, date_created, status, user_id)
                VALUES ('$external_tel', '$reception_id', '$class_of_service', '$company_id', '$date_created', '$status', '$current_id')";
        $addExternalTel = mysqli_query($con, $sql);

        if ($addExternalTel == true)
        {
          //MESSAGE FOR SUCCESSFULLY ADDING EXTERNAL TELEPHONE DIRECTORY
            $_SESSION['addExternal_local'] = "<div class='alert alert-success' role='alert'>
                                External Telephone Added Successfully.
                                </div>";
            header('location:'.$siteURL.'Admin_side/external_line.php');
        }
        else
        {
          //MESSAGE FOR FAILED ADDING EXTERNAL TELEPHONE DIRECTORY
            $_SESSION['addExternal_local'] = "<div class='alert alert-danger' role='alert'>
                                Failed to add External Telephone.
                                </div>";
            header('location:'.$siteURL.'Admin_side/external_line.php');
        }
    }
?>
