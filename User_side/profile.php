<?php
    include ('header.php');

    $sql = "SELECT a.user_id, a.first_name, a.middle_name, a.last_name, a.telegram, a.username,
                    a.date_created, b.company_name, c.department_name
            FROM user a
            INNER JOIN company b ON a.company_id=b.company_id
            INNER JOIN department c ON a.department_id=c.department_id
            WHERE a.user_id=$current_id";
    $result = mysqli_query($con, $sql);
    $checkResult = mysqli_num_rows($result);

    if($checkResult != 0)
    {
        while ($rows = mysqli_fetch_assoc($result))
        {
            $user_id = $rows['user_id'];
            $first_name = $rows['first_name'];
            $middle_name = $rows['middle_name'];
            $last_name = $rows['last_name'];
            $telegram = $rows['telegram'];
            $company_name = $rows['company_name'];
            $department_name = $rows['department_name'];
            $username = $rows['username'];
            
        }
    }
?>
        <h2 class="my-5">User Details</h2>

        <div class="d-flex">
            
            <div class="form-group mx-5">
            <h3>Personal Information</h3>
                <div class="form-group">
                    <label for="">First Name:</label>
                    <input type="text" class="form-control" value="<?php echo $first_name;?>" readonly>
                </div>

                <div class="form-group">
                    <label for="">Middle Name:</label>
                    <input type="text" class="form-control" value="<?php echo $middle_name;?>" readonly>
                </div>

                <div class="form-group">
                    <label for="">Last Name:</label>
                    <input type="text" class="form-control" value="<?php echo $last_name;?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Telegram:</label>
                    <input type="text" class="form-control" value="<?php echo $telegram;?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Company Name:</label>
                    <input type="text" class="form-control" value="<?php echo $company_name;?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Department Name:</label>
                    <input type="text" class="form-control" value="<?php echo $department_name;?>" readonly>
                </div>
            </div>

            
            
            <div class="form-group">
            <h3>System Credentials</h3>
                
                <div class="form-group">
                    <label for="">User ID:</label>
                    <input type="text" class="form-control" value=<?php echo $user_id;?> readonly>
                </div>
                <div class="form-group">
                    <label for="">Username:</label>
                    <input type="text" class="form-control" value=<?php echo $username;?> readonly>
                </div>
            </div>
        </div>
    
<?php include ('footer.php')?>

