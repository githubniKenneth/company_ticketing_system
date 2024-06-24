<?php
session_start();
include ('../Includes/adminSidebar.php');
?>
<h2 class="my-5">Employee IT Asset</h2>
<link rel="stylesheet" href="../CSS/employee_asset.css">
<!-- SEARCH BAR FOR EMPLOYEE ASSET LIST -->
<form class="form-inline mb-2 d-flex justify-content-end">
  <div class="d-flex">
    <button class="btn_searchBar btn btn-primary mr-sm-2 mb-2" type="button">Search</button>
    <input class="input_searchBar form-control mr-sm-2 mb-2 align-middle" type="search" placeholder="Search" aria-label="Search">
  </div>
  </form>
  <!-- TABLE FOR EMPLOYEE ASSET LIST -->
<table class="table" id="table_employeeAsset">
    <thead>
      <tr>
          <th scope="col">#</th>
          <th scope="col">Employee</th>
          <th scope="col">Quantity Asset</th>
          <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody class="target-search-employeeAsset">
                    <?php
                    $counter = 0;
                        $query = "SELECT a.employee_id, CONCAT(a.firstname, ' ', a.lastname) AS employee_name, a.company_id, a.department_id
                        FROM employee a";

                    $result = mysqli_query($con, $query);
                    while($row = mysqli_fetch_array($result)){
                    $employee_id = $row['employee_id'];
                    $employee_name = $row['employee_name'];
                    $company_id = $row['company_id'];
                    $department_id = $row['department_id'];
                    $counter++;
                    ?>
                    <tr>
                    <td class="font-weight-bold"><?php echo $counter;?></td>
                    <td><?php echo $employee_name;?></td>
                    <?php $rowAsset = "SELECT * FROM employee_asset WHERE employee_id = '$employee_id'";
                    $resultAsset = mysqli_query($con, $rowAsset);
                    $rowCheck = mysqli_num_rows($resultAsset);
                    echo "<td>".$rowCheck."</td>";
                    ?>
                    <td>
                    <button type="button" data-toggle="modal" data-id="<?php echo $employee_id; ?>" class="reviewAsset btn btn-primary">View Asset</button>
                    <button type="button" data-toggle="modal" data-id="<?php echo $employee_id; ?>" class="addAsset btn btn-success">Add Asset</button>
                    </td>
                </tr>
        <?php  }?>
    </tbody>
</table>
<!-- ADD EMPLOYEE ASSET MODAL -->
<div class="modal fade" id="addEmployeeItAssetModal" tabindex="-1" aria-labelledby="addEmployeeItAssetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeItAssetModalLabel">Add Asset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="target-modal-addAsset">

            </div>
        </div>
    </div>
</div>

<!-- VIEW EMPLOYEE ASSET MODAL -->
<div class="modal fade" id="viewItAssetModal" tabindex="-1" aria-labelledby="viewItAssetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewItAssetModalLabel">Employee Asset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="target-modal-viewAsset">

            </div>
        </div>
    </div>
</div>


<?php
include ('../Includes/adminFooter.php');
?>
<script src="../js/employee_asset/add-employee-asset.js"></script>
<script src="../js/employee_asset/view-employee-asset.js"></script>
<script src="../js/employee_asset/search-employee-asset.js"></script>
