<?php
session_start();
include('../../Includes/connection.php');
include('../../restrictions/restriction-check.php');
include('../cls_constant.php');

    $current_id = $_SESSION['user_id'];
    $company_id = $_POST['company_id'];

    // echo $company_id;
    $sql = "SELECT company_name
            FROM company
            WHERE company_id = $company_id";
    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0)
    {
        $row = mysqli_fetch_assoc($result);
        $company_name = $row['company_name'];
        
        ?>
            <form action="action_button/update-company.php" method="POST">
                <input type="hidden" name="company_id" value="<?php echo $company_id; ?>">
                <div class="form-group">
                    <label for="">Company Name</label>
                    <input type="text" class="form-control" value="<?php echo $company_name; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-control">
                        <option value="0">Active</option>
                        <option value="1">Inactive</option>
                    </select>
                </div>
                <div class="modal-footer">
                <!-- <?php accessPermissions("sa_edit",$current_id,systemApps::appNum_Company); ?> -->
                    <button type="submit" id="button" name="updateCompany" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        <?php
        
    }
?>