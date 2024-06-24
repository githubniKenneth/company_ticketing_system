<?php
session_start();
include('../../Includes/connection.php');

    $assetID = $_GET['assetId'];
    // DELETE IT ASSET PERMANENTLY
    $deleteSQL = "DELETE FROM it_asset WHERE asset_id = '$assetID'";
    $delete = mysqli_query($con, $deleteSQL);

    if($delete==true)
    {
      // DELETE IT ASSET INSIDE THE EMPLOYEE ASSET PERMANENTLY
      $deleteEmployeeAssetSQL = "DELETE FROM employee_asset WHERE asset_id = '$assetID'";
      $deleteEmployeeAsset = mysqli_query($con, $deleteEmployeeAssetSQL);
      // MESSAGE IF THE DELETE IT ASSET SUCCESSFUL
        $_SESSION['delete_it_asset'] = "<div class='alert alert-success' role='alert'>
                                IT Asset Deleted Successfully.
                                </div>";
        header('location:'.$siteURL.'Admin_side/it_asset.php');
    }
    else
    {
      // MESSAGE IF THE DELETE IT ASSET FAILED
        $_SESSION['delete_it_asset'] = "<div class='alert alert-danger' role='alert'>
                                IT Asset Failed to Delete.
                                </div>";
        header('location:'.$siteURL.'Admin_side/it_asset.php');
    }
?>
