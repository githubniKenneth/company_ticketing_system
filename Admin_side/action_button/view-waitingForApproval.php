<?php 
session_start();
include('../../Includes/connection.php');
include('../../restrictions/restriction-check.php');
include('../cls_constant.php');
$current_id = $_SESSION['user_id'];
$current_account_type = $_SESSION['account_type'];

$userid = $_POST['userid'];
// echo $userid;
$sql = "SELECT user_id, first_name, middle_name, last_name, telegram, username, password, account_type
        FROM user
        WHERE user_id = $userid";
$result = mysqli_query($con, $sql);
$resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
            {
                $userID = $row['user_id'];
                $firstName = $row['first_name'];
                $middleName = $row['middle_name'];
                $lastName = $row['last_name'];
                $telegramNumber = $row['telegram'];
                $username = $row['username'];
                $password = $row['password'];
                $account_type = $row['account_type'];
                ?>
    
        <script>
            $(document).ready(function(){
                $("select.company").change(function(){
                    var selectedCompany = $(".company option:selected").val();
                    // alert('sdaf');
                    $.ajax({
                        type: "POST",
                        url: "action_button/department-select.php",
                        data: { company : selectedCompany } 
                    }).done(function(data){
                        $("#response").html(data);
                    });
                });
            });
        </script>

            <form action="action_button/update-account.php" method="POST">

                <input type="hidden" name="userID" value="<?php echo $userID; ?>">
                
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" value="<?php echo $firstName." ".$middleName." ".$lastName; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Telegram</label>
                    <input type="text" class="form-control" value="<?php echo $telegramNumber; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" value="<?php echo $username; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="text" class="form-control" value="<?php echo $password; ?>" disabled>
                </div>
                <div class="form-group">
                <label>Company:</label>
                    <select name="companyName" class="company custom-select" required>
                        <option value="">Select Company</option>
                        <?php 
                            $companySql = "SELECT company_id, company_name FROM company WHERE status=0";
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
                <div class="form-group" id="response">
                    <!-- department-select.php -->
                </div>
                <div class="form-group">
                    <label for="">User Type</label>
                    <select name="userTypes" class="form-control">
                        <?php accountTypeLimit("userRegistration", $current_account_type, $account_type); ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="button" name="updateButton" class="btn btn-primary" <?php accessPermissions("sa_edit",$current_id,systemApps::appNum_WaitingForApproval); ?>>Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>

<?php
                
            }
    }
    else 
    echo "no rows found";

?>