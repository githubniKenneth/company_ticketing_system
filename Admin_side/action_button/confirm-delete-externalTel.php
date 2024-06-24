<?php
session_start();
include('../../Includes/connection.php');
$current_id = $_SESSION['user_id'];

if (isset($_POST['telExternal'])) {

  $telExternal = $_POST['telExternal'];
  ?>
  <!-- CONFIRM MESSAGE TO DELETE EXTERNAL TELEPHONE DIRECTORY PERMANENTLY -->
  <div class="confirm-msg-telExternal">
    <p>Are you sure you want to delete this External Telephone permanently?</p>
    <div class="d-flex justify-content-end">
      <a href="<?php echo $siteURL;?>Admin_side/action_button/delete-external-line.php?telExternalId=<?php echo $telExternal;?>"><button type="button" class="mr-2 btn btn-danger">Yes</button></a>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    </div>
  </div>

  <?php
}
?>
