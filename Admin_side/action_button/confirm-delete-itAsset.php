<?php
session_start();
include('../../Includes/connection.php');
$current_id = $_SESSION['user_id'];

if (isset($_POST['assetId'])) {

  $assetId = $_POST['assetId'];
  ?>
  <!-- CONFIRM MESSAGE TO DELETE IT ASSET PERMANENTLY -->
  <div class="confirm-msg-itAsset">
    <p>Are you sure you want to delete this IT Asset permanently?</p>
    <div class="d-flex justify-content-end">
      <a href="<?php echo $siteURL;?>Admin_side/action_button/delete-it-asset.php?assetId=<?php echo $assetId;?>"><button type="button" class="mr-2 btn btn-danger">Yes</button></a>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    </div>
  </div>

  <?php
}
?>
