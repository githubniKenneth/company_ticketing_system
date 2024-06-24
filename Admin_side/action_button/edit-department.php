<?php
session_start();
include('../../Includes/connection.php');
include('../../restrictions/restriction-check.php');
include('../cls_constant.php');
$current_id = $_SESSION['user_id'];

    $department_id = $_POST['departmentId'];
    // echo $company_id;
    $sql = "SELECT department_name
            FROM department
            WHERE department_id = $department_id";
    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0)
    {
        $row = mysqli_fetch_assoc($result);
        $department_name = $row['department_name'];
        ?>
            <form action="action_button/update-department.php" method="POST">
                <input type="hidden" name="department_id" value="<?php echo $department_id; ?>">
                <div class="form-group">
                    <label for="">Department Name</label>
                    <input type="text" class="form-control" value="<?php echo $department_name; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-control">
                        <option value="0">Active</option>
                        <option value="1">Inactive</option>
                    </select>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" id="button" name="updateDepartment" class="btn btn-primary" <?php accessPermissions("sa_edit",$current_id,systemApps::appNum_Department); ?>>Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        <?php
    }
?>