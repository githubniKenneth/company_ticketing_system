<?php
session_start();
include('../../Includes/connection.php');
$current_id = $_SESSION['user_id'];

if (isset($_POST['userId'])) {

  $userId = $_POST['userId'];
  ?>
  <!-- CONFIRM MESSAGE TO DELETE USER PERMANENTLY -->
  <div class="confirm-msg-employee">
    <p>Are you sure you want to delete this User permanently?</p>
    <div class="d-flex justify-content-end">
      <a href="<?php echo $siteURL;?>Admin_side/action_button/delete-user.php?id=<?php echo $userId;?>"><button type="button" class="mr-2 btn btn-danger">Yes</button></a>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    </div>
  </div>
  <?php
}
?>
