<?php
session_start();
include('../../Includes/connection.php');
$current_id = $_SESSION['user_id'];

if (isset($_POST['telLocal'])) {

  $telLocal = $_POST['telLocal'];
  ?>
  <!-- CONFIRM MESSAGE TO DELETE LOCAL TELEPHONE DIRECTORY PERMANENTLY -->
  <div class="confirm-msg-telLocal">
    <p>Are you sure you want to delete this Local Telephone permanently?</p>
    <div class="d-flex justify-content-end">
      <a href="<?php echo $siteURL;?>Admin_side/action_button/delete-local-line.php?telLocalId=<?php echo $telLocal;?>"><button type="button" class="mr-2 btn btn-danger">Yes</button></a>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    </div>
  </div>

  <?php
}
?>
