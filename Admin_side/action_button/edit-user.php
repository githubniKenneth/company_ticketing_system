<?php
session_start();
include('../../Includes/connection.php');
include('../../restrictions/restriction-check.php');
include('../cls_constant.php');
$current_id = $_SESSION['user_id'];
$current_account_type = $_SESSION['account_type'];

    $user_id = $_POST['userid'];
    $sql="SELECT a.first_name, a.middle_name, a.last_name, a.telegram, a.username, a.account_type,
                b.company_name,
                c.department_name
                FROM user a
                INNER JOIN company b ON a.company_id=b.company_id
                INNER JOIN department c ON a.department_id=c.department_id
                WHERE a.user_id=$user_id";
    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            // $user_id = $row['user_id'];
            $first_name = $row['first_name'];
            $middle_name = $row['middle_name'];
            $last_name = $row['last_name'];
            $telegram = $row['telegram'];
            $username = $row['username'];
            $account_type = $row['account_type'];
            $company_name = $row['company_name'];
            $department_name = $row['department_name'];
            ?>
                <form action="action_button/update-user.php" method="POST">

                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                <div class="form-group">
                    <label for="">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
                </div>
                <div class="form-group">
                    <label for="">Middle Name</label>
                    <input type="text" name="middle_name" class="form-control" value="<?php echo $middle_name; ?>">
                </div>
                <div class="form-group">
                    <label for="">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
                </div>
                <div class="form-group">
                    <label for="">Telegram</label>
                    <input type="text" name="telegram" class="form-control" value="<?php echo $telegram; ?>">
                </div>
                <div class="form-group">
                    <label>Company:</label>
                        <select name="company_name" class="company custom-select">
                            <option value="">Select Company</option>
                            <?php
                                $companySql = "SELECT company_id, company_name FROM company WHERE status=0";
                                $companyQuery = mysqli_query($con, $companySql);
                                $companyRowCheck = mysqli_num_rows($companyQuery);

                                if($companyRowCheck != 0){
                                    while($companyRow = mysqli_fetch_assoc($companyQuery)){
                                        $companyId = $companyRow['company_id'];
                                        $companyNames = $companyRow['company_name'];

                                        $sql2 = "SELECT company_id FROM user WHERE user_id=$user_id LIMIT 1"; // get assigned_to  user_id
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
                </div>
                <div class="form-group" id="response">
                    <!-- department-select.php -->
                    <label for="">Department</label>
                    <select name="department_id" class="custom-select">
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
                                    ?>

                                    <?php
                            }
                            //--------------------------------------------------------

                            $sql3 = "SELECT a.department_id, b.department_name
                                    FROM user a
                                    INNER JOIN department b ON a.department_id=b.department_id
                                    WHERE a.user_id=$user_id LIMIT 1";
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
                </div>
                <div class="form-group">
                    <label for="">User Type</label>
                    <select name="account_type" class="form-control">
                        <?php accountTypeLimit("userRegistration", $current_account_type, $account_type) ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" value="">
                    <label for="">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" id="button" name="updateUserButton" class="btn btn-primary" <?php accessPermissions("sa_edit",$current_id,systemApps::appNum_AllUsers); ?>>Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
            <?php
        }
    }
?>

<script src="../js/select_department.js">

</script>
