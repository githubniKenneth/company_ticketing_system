<?php
session_start();
include('../../Includes/connection.php');

$current_id = $_SESSION['user_id'];
$employeeId = $_POST['employeeId'];
// SELECT THE EMPLOYEE TO PUT IT TO THE MODAL
    $sql="SELECT a.employee_id, a.firstname, a.lastname, a.tel_local_id, a.department_id, a.company_id,
                c.company_name,d.department_name, e.tel_local
                FROM employee a
                INNER JOIN company c ON a.company_id = c.company_id
                INNER JOIN department d ON a.department_id = d.department_id
                LEFT JOIN tel_local_directory e ON a.tel_local_id = e.tel_local_id
                WHERE a.employee_id = $employeeId";

    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $employee_id = $row['employee_id'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $tel_local_id = $row['tel_local_id'];
            $departmentId = $row['department_id'];
            $company_id = $row['company_id'];

            ?>
            <!-- SHOWING THE EXISTING INFORMATION OF A EMPLOYEE TO BE EDIT -->
                <form action="action_button/update-employee.php" method="POST">
                <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
                <div class="form-group">
                    <label for="">First Name</label>
                    <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>" required>
                    <input type="hidden" name="old_firstname" class="form-control" value="<?php echo $firstname; ?>">
                </div>
                <div class="form-group">
                    <label for="">Last Name</label>
                    <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>" required>
                    <input type="hidden" name="old_lastname" class="form-control" value="<?php echo $lastname; ?>">
                </div>

                <div class="form-group">
                    <label>Company:</label>
                    <!-- SELECTING THE EXISTING COMPANY AND ALL THE LIST OF COMPANY -->
                        <select name="company_id" class="company custom-select" required>
                            <option value="">Select Company</option>
                            <?php
                                $companySql = "SELECT company_id, company_name FROM company WHERE status = 0";
                                $companyQuery = mysqli_query($con, $companySql);
                                $companyRowCheck = mysqli_num_rows($companyQuery);

                                if($companyRowCheck != 0){
                                    while($companyRow = mysqli_fetch_assoc($companyQuery)){
                                        $companyId = $companyRow['company_id'];
                                        $companyNames = $companyRow['company_name'];

                                        $sql2 = "SELECT company_id FROM employee WHERE employee_id = $employee_id LIMIT 1"; // get assigned_to  user_id
                                        $result2 = mysqli_query($con, $sql2);
                                        $resultCheck2 = mysqli_num_rows($result2);
                                        if($resultCheck2 != 0)
                                        {
                                            $row2 = mysqli_fetch_assoc($result2);
                                            $current_company = $row2['company_id'];
                                                ?>
                                                <option value="<?php echo $companyId; ?>" <?php if ($companyId == $current_company) echo 'selected="selected"'?>> <?php echo $companyNames; ?> </option>
                                                <?php
                                        }
                                    }
                                }
                            ?>
                        </select>
                        <input type="hidden" name="old_company_id" class="form-control" value="<?php echo $company_id; ?>">
                </div>
                <div class="form-group" id="response">
                    <label for="">Department</label>
                    <!-- SELECTING THE EXISTING DEPARTMENT AND ALL THE LIST OF DEPARTMENT INSIDE THE COMPANY-->
                    <select name="department_id" class="custom-select" required>
                        <?php
                            $sql5 = "SELECT department_id
                                    FROM department
                                    WHERE status=0";
                            $result5 = mysqli_query($con, $sql5);
                            $resultCheck5 = mysqli_num_rows($result5);
                            if($resultCheck5 != 0)
                            {
                                $row5 = mysqli_fetch_assoc($result5);
                                $department_id = $row5['department_id'];
                            }
                            $sql3 = "SELECT a.department_id, b.department_name
                                    FROM employee a
                                    INNER JOIN department b ON a.department_id = b.department_id
                                    WHERE a.employee_id = $employee_id LIMIT 1";
                            $result3 = mysqli_query($con, $sql3);
                            $resultCheck3 = mysqli_num_rows($result3);
                            if($resultCheck3 != 0)
                            {
                                $row3 = mysqli_fetch_assoc($result3);
                                $current_department = $row3['department_id'];
                                $department_name = $row3['department_name'];
                                    ?>
                                        <option value="<?php echo $current_department; ?>" <?php if($department_id == $current_department) echo 'selected="selected"'?>><?php echo $department_name;?></option>
                                    <?php
                            }
                        ?>
                    </select>
                    <input type="hidden" name="old_department_id" class="form-control" value="<?php echo $departmentId; ?>">
                </div>
                <div class="form-group">
                    <label>Local Telephone:</label>
                      <!-- SELECTING THE EXISTING LOCAL TELEPHONE DIRECTORY AND ALL THE LIST OF LOCAL TELEPHONE DIRECTORY-->
                        <select name="tel_local_id" class="custom-select">
                          <?php if ($tel_local_id != "") {
                            echo '<option value="">Select Local Telephone</option>';
                          }?>
                          <?php
                              $tel_localSql = "SELECT tel_local_id, tel_local FROM tel_local_directory WHERE status = 0 OR tel_local_id = '$tel_local_id'";
                              $tel_localQuery = mysqli_query($con, $tel_localSql);
                              $tel_localRowCheck = mysqli_num_rows($tel_localQuery);
                              if($tel_localRowCheck != 0){
                                  while($tel_localRow = mysqli_fetch_assoc($tel_localQuery)){
                                      $newtel_localId = $tel_localRow['tel_local_id'];
                                      $tel_localNames = $tel_localRow['tel_local'];
                                              ?>
                                      <option value="<?php echo $newtel_localId; ?>" <?php if ($newtel_localId == $tel_local_id){echo "selected";}?>> <?php echo $tel_localNames; ?> </option>
                                              <?php
                                      }
                                  }
                              ?>
                        </select>
                    <input type="hidden" name="old_tel_local_id" value="<?php echo $tel_local_id; ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" id="button" name="updateEmployeeButton" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
            <?php
        }
    }
?>
<!-- JS FOR CHANGING THE COMPANY IT WILL ALSO CHANGE THE LIST OF DEPARTMENT-->
<script src="../js/select_department.js"></script>
