<?php
session_start();
include ('../Includes/adminSidebar.php');
?>
<h2 class="my-5">Local Telephones</h2>
<?php
// MESSAGES AFTER SUBMTTING LIST OF LOCAL TELEPHONE
if(isset($_SESSION['delete_local_line']))
{
    echo $_SESSION['delete_local_line'];
    unset($_SESSION['delete_local_line']);
}
if(isset($_SESSION['addTel_local']))
{
    echo $_SESSION['addTel_local'];
    unset($_SESSION['addTel_local']);
}
if(isset($_SESSION['update']))
{
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}
?>
<!-- ADD LOCAL TELEPHONE BUTTON -->
<div class="form-inline d-flex justify-content-end mb-2">
    <button type="button" data-toggle="modal" data-target="#addLocalTel" class="btn btn-success mr-2">Add Local Telephone</button>
</div>
<!-- SEARCH BAR FOR FOR LOCAL LINE -->
<form class="form-inline mb-2 d-flex justify-content-end">
    <div class="">
      <button id="local_btn_searchBar" class="btn btn-primary mr-sm-2 mb-2" type="button">Search</button>
      <input id="local_input_searchBar" class="form-control mr-sm-2 mb-2 align-middle" type="search" placeholder="Search" aria-label="Search">
    </div>
</form>
              <!-- TABLE FOR LIST OF LOCAL TELEPHONE  -->
<table class="table" id="table_localTel">
    <thead>
      <tr>
          <th scope="col">#</th>
          <th scope="col">Created </th>
          <th scope="col">Telephone Number </th>
          <th scope="col">Created By </th>
          <th scope="col">Status </th>
          <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody class="target-search-local">
      <?php
      $counter = 0;
      $query = "SELECT a.tel_local_id, a.tel_local, a.status, a.date_created,
                CONCAT(b.first_name, ' ', b.middle_name, ' ', b.last_name) AS created_user
                FROM tel_local_directory a
                INNER JOIN user b ON a.user_id = b.user_id;";

      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)){

          $tel_local_id = $row['tel_local_id'];
          $date_created = $row['date_created'];
          $tel_local = $row['tel_local'];
          $createdBy = $row['created_user'];
          $telLocalId = $row['status'] == 0 ? "InActive" : "Active";
          $counter++;
            ?>
              <tr>
                    <td class="font-weight-bold"><?php echo $counter;?></td>
                    <td><?php echo $date_created;?></td>
                    <td><?php echo $tel_local;?></td>
                    <td><?php echo $createdBy;?></td>
                    <td><?php echo $telLocalId;?></td>
                    <td>
                    <button type="button" data-toggle="modal" data-id="<?php echo $tel_local_id; ?>" class="editTelLocal btn btn-primary">Edit</button>
                    <button type="button" data-toggle="modal" data-id="<?php echo $tel_local_id; ?>" class="deleteTelLocal btn btn-danger">Delete</button>
                    </td>
                </tr>
        <?php } ?>
    </tbody>
</table>
<!-- EDIT LOCAL TELEPHONE MODAL -->
<div class="modal fade" id="editTelLocalModal" tabindex="-1" aria-labelledby="editTelLocalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTelLocalModalLabel">Edit Local Telephone</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="target-modal-edit">

            </div>
        </div>
    </div>
</div>
<!-- CONFIRM DELETE LOCAL TELEPHONE MODAL -->
<div class="modal fade" id="confirm-delete-telLocal" tabindex="-1" aria-labelledby="removeTelLocalModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" id="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-end">
                <div class="d-flex">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>
            <div id="delete-telLocal" class="modal-body">

        </div>
    </div>
  </div>
</div>
<!-- ADD LOCAL TELEPHONE MODAL -->
<div class="modal fade" id="addLocalTel" tabindex="-1" aria-labelledby="addLocalTelModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add Local Telephone</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add-user-modal.php -->
                <form action="action_button/add-local-line.php" method="POST">
                    <div id="personal-information" class="p">Telephone <hr>
                        <div class="form-group">
                            <label for="">Local Telephone Number</label>
                            <input type="text" name="local_tel" class="form-control" placeholder="Enter Local Telephone" required>
                        </div>
                    <div class="modal-footer">
                        <button type="submit" name="addLocalTelButton" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php
include ('../Includes/adminFooter.php');
?>
<script src="../js/local_telephone/edit.js"></script>
<script src="../js/local_telephone/confirm-delete.js"></script>
<script src="../js/local_telephone/search-local-tel.js"></script>
