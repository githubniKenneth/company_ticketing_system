<?php
session_start();
include('../../Includes/connection.php');
$current_id = $_SESSION['user_id'];

if (isset($_POST['company_id'])) {

  $company_id = $_POST['company_id'];
  ?>
  <!-- CONFIRM MESSAGE TO DELETE COMPANY PERMANENTLY -->
  <div class="confirm-msg-employee">
    <p>Are you sure you want to delete this Company permanently?</p>
    <div class="d-flex justify-content-end">
      <a href="<?php echo $siteURL;?>Admin_side/action_button/delete-company.php?id=<?php echo $company_id;?>"><button type="button" class="mr-2 btn btn-danger">Yes</button></a>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    </div>
  </div>
  <?php
}
?>
