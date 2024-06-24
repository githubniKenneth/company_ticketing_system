<?php
session_start();
include('../../Includes/connection.php');
$current_id = $_SESSION['user_id'];

if (isset($_POST['employeeId'])) {

  $employee_id = $_POST['employeeId'];
  $telLocalId = $_POST['telLocalId'];
  ?>
  <!-- CONFIRM MESSAGE TO DELETE EMPLOYEE PERMANENTLY -->
  <div class="confirm-msg-employee">
    <p>Are you sure you want to delete this Employee permanently?</p>
    <div class="d-flex justify-content-end">
      <a href="<?php echo $siteURL;?>Admin_side/action_button/delete-employee.php?employeeId=<?php echo $employee_id;?>&telLocalId=<?php echo $telLocalId;?>"><button type="button" class="mr-2 btn btn-danger">Yes</button></a>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    </div>
  </div>
  <?php
}
?>
