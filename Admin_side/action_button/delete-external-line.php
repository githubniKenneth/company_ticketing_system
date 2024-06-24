<?php
session_start();
include('../../Includes/connection.php');

    $telLocalId = $_GET['telExternalId'];

    // DELETE EXTERNAL TELEPHONE DIRECTORY PERMANENTLY
    $deleteSQL = "DELETE FROM tel_external_directory WHERE tel_ex_id = '$telLocalId'";
    $delete = mysqli_query($con, $deleteSQL);

    if($delete==true)
    {
      // MESSAGE IF THE DELETE EXTERNAL TELEPHONE DIRECTORY SUCCESSFUL
        $_SESSION['delete_external_line'] = "<div class='alert alert-success' role='alert'>
                                External Telephone Deleted Successfully.
                                </div>";
        header('location:'.$siteURL.'Admin_side/external_line.php');
    }
    else
    {
      // MESSAGE IF THE DELETE EXTERNAL TELEPHONE DIRECTORY FAILED
        $_SESSION['delete_external_line'] = "<div class='alert alert-danger' role='alert'>
                                External Telephone Failed to Delete.
                                </div>";
        header('location:'.$siteURL.'Admin_side/external_line.php');
    }
