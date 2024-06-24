<?php
session_start();
include('../../Includes/connection.php');
$current_id = $_SESSION['user_id'];

if (isset($_POST['departmentId'])) {

  $departmentId = $_POST['departmentId'];
  ?>
  <!-- CONFIRM MESSAGE TO DELETE DEPARTMENT PERMANENTLY -->
  <div class="confirm-msg-employee">
    <p>Are you sure you want to delete this Company permanently?</p>
    <div class="d-flex justify-content-end">
        <a href="<?php echo $siteURL;?>Admin_side/action_button/delete-department.php?id=<?php echo $departmentId;?>"><button class="mr-2 btn btn-danger">Yes</button></a>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    </div>
  </div>
  <?php
}
?>
