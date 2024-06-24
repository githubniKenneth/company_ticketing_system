<?php
session_start();
include ('../../Includes/connection.php');
$current_id = $_SESSION['user_id'];

    if(isset($_POST["itAssetId"]))
    {
      $employee_id = $_POST["employeeId"];
      $itAssetId = $_POST["itAssetId"];
      $status = 0;
      // REMOVING EMPLOYEE ASSET FROM THE EMPLOYEE
      $deleteQuery = "DELETE FROM employee_asset WHERE asset_id = '$itAssetId'";

      $assetResult = mysqli_query($con, $deleteQuery);

      if ($assetResult == true) {
        // UPDATE STATUS OF THE IT ASSET REMOVED TO INACTIVE OR 0
        $updateQuery = "UPDATE it_asset SET status = '$status' WHERE asset_id = '$itAssetId'";
        $updateResult = mysqli_query($con, $updateQuery);

        // MESSAGE IF THE REMOVING IT ASSET SUCCESSFUL
        echo "<p class='alert alert-success' role='alert'>Remove Succesfully</p>";
      } else {
        // MESSAGE IF THE REMOVING IT ASSET SUCCESSFUL
        echo "<p class='alert alert-danger' role='alert'>Remove Failed</p>";
      }
}
?>
