<?php
session_start();
include ('../Includes/adminSidebar.php');

?>
<h2 class="my-5">Employee</h2>
<?php
// MESSAGES AFTER SUBMITTING OF EMPLOYEE
    if(isset($_SESSION['delete_employee']))
    {
        echo $_SESSION['delete_employee'];
        unset($_SESSION['delete_employee']);
    }
    if(isset($_SESSION['add_employee']))
    {
        echo $_SESSION['add_employee'];
        unset($_SESSION['add_employee']);
    }
    if(isset($_SESSION['update']))
    {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }
?>
<!-- ADD EMPLOYEE BUTTON -->
<div class="form-inline d-flex justify-content-end mb-2">
    <button type="button" data-toggle="modal" data-target="#addEmployeeModal" class="btn btn-success mr-2" <?php accessPermission("sa_add", $current_id, systemApps::appNum_Department); ?>>Add Employee</button>
</div>
<!-- SEARCH BAR FOR EMPLOYEEE LIST -->
<form class="form-inline mb-2 d-flex justify-content-end">
    <div class="">
      <button id="srch_btn_employee" class="btn btn-primary mr-sm-2 mb-2" type="button">Search</button>
      <input id="srch_input_employee" class="form-control mr-sm-2 mb-2 align-middle" type="search" placeholder="Search" aria-label="Search">
    </div>
</form>
<!-- TABLE FOR EMPLOYEE LIST -->
<table class="table" id="table_employee">
    <thead>
      <tr>
          <th scope="col">#</th>
          <th scope="col">Created </th>
          <th scope="col">Name </th>
          <th scope="col">Local Telephone </th>
          <th scope="col">Company </th>
          <th scope="col">Department </th>
          <th scope="col">Status </th>
          <th scope="col">Action</th>
      </tr>
    </thead>
      <tbody class="target-search-employee">
                <?php
                $counter = 0;
                $query = "SELECT a.employee_id,a.date_created, a.status, CONCAT(firstname, ' ', lastname) AS name, b.company_name, c.department_name, d.tel_local_id, d.tel_local
                FROM employee a
                INNER JOIN company b ON a.company_id = b.company_id
                INNER JOIN department c ON a.department_id = c.department_id
                LEFT JOIN tel_local_directory d ON a.tel_local_id = d.tel_local_id
                ORDER BY a.firstname ASC";
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_array($result)){
                $employee_id = $row['employee_id'];
                $date_created = $row['date_created'];
                $name = $row['name'];
                $tel_local = $row['tel_local'] == ""? "InActive" : $row['tel_local'];
                $company_name = $row['company_name'];
                $department_name = $row['department_name'];
                $tel_local_id = $row['tel_local_id'];
                $status = $row['status'] == 0? "InActive" : "Active";
                $counter++;
                ?>
            <tr>
                <td class="font-weight-bold"><?php echo $counter?></td>
                <td><?php echo $date_created ?></td>
                <td><?php echo $name ?></td>
                <td><?php echo $tel_local ?></td>
                <td><?php echo $company_name ?></td>
                <td><?php echo $department_name ?></td>
                <td><?php echo $status ?></td>
                <td>
                <button type="button" data-id="<?php echo $employee_id; ?>" class="editEmployee btn btn-primary">Edit</button>
                <button type="button" data-id="<?php echo $employee_id; ?>" data-tel="<?php echo $tel_local_id; ?>" class="deleteEmployee btn btn-danger">Delete</button>
                </td>
            </tr>
      <?php } ?>
    </tbody>
</table>

<!-- EDIT EMPLOYEEE MODAL -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="target-modal-edit">

            </div>
        </div>
    </div>
</div>

<!-- ADD EMPLOYEE MODAL -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addEmployeeModal">Add Employee</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <!-- add-employee-modal.php -->
            <form action="action_button/add-employee.php" method="POST">
                <div id="personal-information" class="p">Personal Information <hr>
                    <div class="form-group">
                        <label for="">First Name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="">Last Name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" required>
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
                                    <?php }
                                } ?>
                        </select>
                    </div>

                    <div class="form-group" id="response">
                    <!-- department-select.php -->
                    </div>
                    <div class="form-group">
                        <label>Local Telephone (optional):</label>
                        <select name="tel_local_id" class="tel_local custom-select">
                            <option selected disabled value="">Select Telephone</option>
                            <?php
                                $telLocalSQL = "SELECT * FROM tel_local_directory WHERE status = 0";
                                $telLocalQuery = mysqli_query($con, $telLocalSQL);
                                $telLocalRowCheck = mysqli_num_rows($telLocalQuery);

                                if($telLocalRowCheck != 0){
                                    while($telLocalRow = mysqli_fetch_assoc($telLocalQuery)){
                                        $telLocalId = $telLocalRow['tel_local_id'];
                                        $telLocal = $telLocalRow['tel_local'];
                                        ?>
                                            <option value="<?php echo $telLocalId; ?>"> <?php echo $telLocal; ?> </option>
                                  <?php  }
                                } ?>
                        </select>
                    </div>
                <div class="modal-footer">
                    <button type="submit" name="addNewEmployee" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
    </div>
  </div>
</div>
<!-- CONFIRM DELETE EMPLOYEE MODAL -->
<div class="modal fade" id="confirm-delete-employee" tabindex="-1" aria-labelledby="removeEmployeeModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" id="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-end">
                <div class="d-flex">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>
            <div id="delete-employee" class="modal-body">

        </div>
    </div>
  </div>
</div>
<?php
include ('../Includes/adminFooter.php');
?>
<!-- JS FOR SELECT DEPARTMENT -->
<script src="../js/select_department.js"></script>
<script src="../js/employee/edit.js"></script>
<script src="../js/employee/confirm-delete.js"></script>
<script src="../js/employee/search-employee.js"></script>
