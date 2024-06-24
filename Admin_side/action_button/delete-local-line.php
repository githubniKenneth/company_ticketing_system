<?php
session_start();
include('../../Includes/connection.php');

    $telLocalId = $_GET['telLocalId'];

    // DELETE LOCAL TELEPHONE DIRECTORY PERMANENTLY
    $deleteSQL = "DELETE FROM tel_local_directory WHERE tel_local_id = '$telLocalId'";
    $delete = mysqli_query($con, $deleteSQL);

    if($delete==true)
    {
        // MESSAGE IF THE DELETE LOCAL TELEPHONE DIRECTORY SUCCESSFUL
        $_SESSION['delete_local_line'] = "<div class='alert alert-success' role='alert'>
                                Local Telephone Deleted Successfully.
                                </div>";
        header('location:'.$siteURL.'Admin_side/local_line.php');
    }
    else
    {
      // MESSAGE IF THE DELETE LOCAL TELEPHONE DIRECTORY FAILED
        $_SESSION['delete_local_line'] = "<div class='alert alert-danger' role='alert'>
                                Local Telephone Failed to Delete.
                                </div>";
        header('location:'.$siteURL.'Admin_side/local_line.php');
    }
?>
