<?php
session_start();
include ('../Includes/adminSidebar.php');
?>
<link rel="stylesheet" href="../CSS/remove-arrow-input.css">
<?php
// MESSAGES AFTER SUBMITTING OF EXTERNAL TELEPHONE
if(isset($_SESSION['delete_external_line']))
{
    echo $_SESSION['delete_external_line'];
    unset($_SESSION['delete_external_line']);
}
if(isset($_SESSION['addExternal_local']))
{
    echo $_SESSION['addExternal_local'];
    unset($_SESSION['addExternal_local']);
}
if(isset($_SESSION['update']))
{
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}
?>
<h2 class="my-5">External Telephones</h2>
<!-- ADD EXTERNAL TELEPHONE BUTTON -->
<div class="form-inline d-flex justify-content-end mb-2">
    <button type="button" data-toggle="modal" data-target="#addExternalTel" class="btn btn-success mr-2">Add External Telephone</button>
</div>
<!-- SEARCH BAR FOR EXTERNAL TELEPHONE -->
<form class="form-inline mb-2 d-flex justify-content-end">
      <div class="">
        <button id="external_btn_searchBar" class="btn btn-primary mr-sm-2 mb-2" type="button">Search</button>
        <input id="external_input_searchBar" class="form-control mr-sm-2 mb-2 align-middle" type="search" placeholder="Search" aria-label="Search">
      </div>
  </form>
  <!-- TABLE FOR EXTERNAL TELEPHONE LISTS -->
<table class="table" id="table_externalTel">
    <thead>
      <tr>
          <th scope="col">#</th>
          <th scope="col">Created </th>
          <th scope="col">Telephone Number </th>
          <th scope="col">Reception Id </th>
          <th scope="col">Class of Service </th>
          <th scope="col">Company </th>
          <th scope="col">Crated By </th>
          <th scope="col">Status </th>
          <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody class="target-search-external">
              <?php
              $counter = 0;
              $query = "SELECT a.tel_ex_id ,a.date_created, a.tel_external, a.reception_id, a.class_of_service, a.user_id, a.status,
              b.company_name,
              CONCAT(c.first_name, ' ', C.middle_name, ' ', c.last_name) AS created_by
              FROM tel_external_directory a
              INNER JOIN company b ON a.company_id = b.company_id
              INNER JOIN user c ON a.user_id = c.user_id;";

              $result = mysqli_query($con, $query);
              while($row = mysqli_fetch_array($result)){

                $tel_ex_id = $row['tel_ex_id'];
                $date_created = $row['date_created'];
                $tel_external = $row['tel_external'];
                $reception_id = $row['reception_id'];
                $class_of_service = $row['class_of_service'];
                $company_name = $row['company_name'];
                $createdBy = $row['created_by'];
                $telLocalId = $row['status'] == 0 ? "InActive" : "Active";
                $counter++;
                  ?>
                <tr>
                <td class="font-weight-bold"><?php echo $counter;?></td>
                <td><?php echo $date_created;?></td>
                <td><?php echo $tel_external;?></td>
                <td><?php echo $reception_id;?></td>
                <td><?php echo $class_of_service;?></td>
                <td><?php echo $company_name;?></td>
                <td><?php echo $createdBy;?></td>
                <td><?php echo $telLocalId;?></td>
                <td>
                <button type="button" data-toggle="modal" data-id="<?php echo $tel_ex_id; ?>" class="editTelExternal btn btn-primary">Edit</button>
                <button type="button" data-toggle="modal" data-id="<?php echo $tel_ex_id; ?>" class="deleteTelExternal btn btn-danger">Delete</button>
                </td>
            </tr>
          <?php } ?>
    </tbody>
</table>

<!-- EDIT EXTERNAL TELEPHONE MODAL -->
<div class="modal fade" id="editTelExternalModal" tabindex="-1" aria-labelledby="editTelExternalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTelExternalModalLabel">Edit Local Telephone</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="target-modal-edit">

            </div>
        </div>
    </div>
</div>
<!-- CONFIRM DELETE EXTERNAL TELEPHONE MODAL -->
<div class="modal fade" id="confirm-delete-externalTel" tabindex="-1" aria-labelledby="removeTelLocalModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" id="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-end">
                <div class="d-flex">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>
            <div id="delete-externalTel" class="modal-body">

        </div>
    </div>
  </div>
</div>
<!-- ADD EXTERNAL TELEPHONE MODAL -->
<div class="modal fade" id="addExternalTel" tabindex="-1" aria-labelledby="addExternalTelModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExternalTelModalLabel">Add External Telephone</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- add-user-modal.php -->
                <form action="action_button/add-external-line.php" method="POST">
                        <div class="form-group">
                            <label for="">External Telephone Number</label>
                            <input type="text" name="external_tel" class="form-control" placeholder="Enter External Telephone" required>
                        </div>
                        <div class="form-group">
                            <label for="">Reception ID</label>
                            <input type="number" name="reception_id" class="form-control" placeholder="Enter Reception ID" required>
                        </div>
                        <div class="form-group">
                            <label for="">Class of Service</label>
                            <input type="number" name="class_of_service" class="form-control" placeholder="Enter Class of Service" required>
                        </div>
                        <div class="form-group">
                            <label>Company:</label>
                            <select name="company_id" class="company custom-select" required>
                                <option value="">Select Company</option>
                                <?php
                                    $companySql = "SELECT company_id, company_name FROM company";
                                    $companyQuery = mysqli_query($con, $companySql);
                                    $companyRowCheck = mysqli_num_rows($companyQuery);

                                    if($companyRowCheck != 0){
                                        while($companyRow = mysqli_fetch_assoc($companyQuery)){
                                            $companyId = $companyRow['company_id'];
                                            $companyNames = $companyRow['company_name'];
                                            ?>
                                                <option value="<?php echo $companyId; ?>"> <?php echo $companyNames; ?> </option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    <div class="modal-footer">
                        <button type="submit" name="addExternalTelButton" class="btn btn-primary">Save changes</button>
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
<script src="../js/external_telephone/edit.js"></script>
<script src="../js/external_telephone/confirm-delete.js"></script>
<script src="../js/external_telephone/search-external-tel.js"></script>
