<?php
    session_start();
    include('../../Includes/connection.php');
    include('../../restrictions/restriction-check.php');
    include('../cls_constant.php');

    $current_id = $_SESSION['user_id'];

    $sa_id = $_POST['sa_id'];
    // echo $sa_id;
    $sql = "SELECT sa_name, sa_status
            FROM system_application
            WHERE sa_id = $sa_id";
    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $sa_name = $row['sa_name']; 
            $sa_status = $row['sa_status'];  
            ?>
                <form action="action_button/update-system-app.php" method="POST">

                    <input type="hidden" name="sa_id" value="<?php echo $sa_id;?>">

                    <div class="form-group">
                        <label for="">Application Name</label>
                        <input type="text" class="form-control" value="<?php echo $sa_name; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control">
                            <option value="0" <?php if($sa_status==0) echo 'selected="selected"'; ?>>Inactive</option>
                            <option value="1" <?php if($sa_status==1) echo 'selected="selected"'; ?>>Active</option>
                            
                        </select>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" id="button" name="updateApp" class="btn btn-primary" <?php accessPermissions("sa_edit",$current_id,systemApps::appNum_SystemApplication); ?>>Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            <?php
        }
        
    }
?>