<?php
session_start();
include ('../../Includes/connection.php');
date_default_timezone_set('Asia/Manila');
$current_id = $_SESSION['user_id'];

    if(isset($_POST["itAssetId"]))
    {
      $employee_id = $_POST["employeeId"];
      $itAssetId = $_POST["itAssetId"];
      $date_created = date('Y-m-d H:i:s');
      $status = 1;
      // INSERTING INTO EMPLOYEE ASSET TABLE
      $insertEmployeeAsset = "INSERT INTO employee_asset (employee_id, asset_id, date_created, user_id, status)
      VALUES ('$employee_id', '$itAssetId', '$date_created', '$current_id', '$status')";

      $query1 = mysqli_query($con, $insertEmployeeAsset);

      if ($query1 == true) {
        // UPDATING THE STATUS OF A IT ASSET CHOSEN
        $updateItasset = "UPDATE it_asset SET status = '$status', date_modified = '$date_created', modified_by = '$current_id'
        WHERE asset_id = '$itAssetId'";

        $query2 = mysqli_query($con, $updateItasset);
        // MESSAGE IF ADDING IT ASSET IS SUCCESSFUL TO THE EMPLOPYEE
        echo "<p class='alert alert-success' role='alert'>Added Succesfully</p>";
      } else {
        // MESSAGE IF ADDINGIT ASSET IS FAILED TO THE EMPLOPYEE
        echo "<p class='alert alert-danger' role='alert'>Added Failed</p>";
      }
?>

<?php
    }
?>
