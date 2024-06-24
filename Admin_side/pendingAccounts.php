<?php
    session_start();
    include ('../includes/adminSidebar.php');
    $current_account_type = $_SESSION['account_type'];
?>

                <h2 class="my-5">Accounts Waiting for Approval</h2>
                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['approve']))
                    {
                        echo $_SESSION['approve'];
                        unset($_SESSION['approve']);
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                ?>
                <div class="form-inline d-flex justify-content-end align-items-baseline mb-2">
                <button type="button" data-toggle="modal" data-target="#addUserModal" class="addUserButton btn btn-success" <?php accessPermission("sa_add", $current_id, systemApps::appNum_WaitingForApproval); ?>>Add New User</button>
                </div>
            
            <table class="table" id="pendingAccountsTable">
                <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Date Created </th>
                    <th scope="col">Full Name </th>
                    <th scope="col">Username </th>
                    <th scope="col">Telegram </th>
                    <th scope="col">Account Type </th>
                    <th scope="col">Action </th>
                </tr>
                </thead>
                <tbody>
                        <?php
                            $sql = "SELECT user_id, date_created, first_name, middle_name, last_name, username, telegram, account_type
                                    FROM user
                                    WHERE approved='0'";
                            $result = mysqli_query($con, $sql);
                            $resultCheck = mysqli_num_rows($result);
                            $counter = 0;
                            if($resultCheck > 0)
                            {
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                    $account_id = $row['user_id'];
                                    $dateCreated = $row['date_created'];
                                    $firstName = $row['first_name'];
                                    $middleName = $row['middle_name'];
                                    $lastName = $row['last_name'];
                                    $username = $row['username'];
                                    $telegramNumber = $row['telegram'];
                                    $account_type = $row['account_type'];
                                    $counter++;
                                    
                                    if ($account_type == 0)
                                    {
                                        $account_type = "User";
                                    }
                                    elseif ($account_type == 1)
                                    {
                                        $account_type = "IT";
                                    }
                                    elseif ($account_type == 2)
                                    {
                                        $account_type = "Administrator";
                                    }
                                    else
                                    {
                                        $account_type = "Error Account Type";
                                    }
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $counter; ?></th>
                                            <td><?php echo $dateCreated; ?></td>
                                            <td><?php echo $firstName." ".$middleName." ".$lastName; ?></td>
                                            <td><?php echo $username; ?></td>
                                            <td><?php echo $telegramNumber; ?></td>
                                            <td><?php echo $account_type; ?></td>
                                            <td>
                                            <!-- data-toggle="modal" data-target="#viewUserModal" -->
                                                <button type="button" data-id="<?php echo $account_id; ?>" class="userinfo btn btn-primary" <?php accessPermission("sa_view", $current_id, systemApps::appNum_WaitingForApproval); ?>>Edit</button>
                                                <a href="<?php echo $siteURL;?>Admin_side/action_button/approve-account.php?id=<?php echo $account_id;?>"><button type="button" class="btn btn-success" <?php accessPermission("sa_add", $current_id, systemApps::appNum_WaitingForApproval); ?>>Approve</button></a>
                                                <a href="<?php echo $siteURL;?>Admin_side/action_button/decline-account.php?id=<?php echo $account_id;?>"><button type="button" class="deleteuser btn btn-danger" <?php accessPermission("sa_delete", $current_id, systemApps::appNum_WaitingForApproval); ?>>Decline</button></a>
                                                
                                            </td>     
                                        </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                    <tr>
                                        <td>No Data Available</td>
                                        <td style="display:none;">No Data Available</td>
                                        <td style="display:none;">No Data Available</td>
                                        <td style="display:none;">No Data Available</td>
                                        <td style="display:none;">No Data Available</td>
                                        <td style="display:none;">No Data Available</td>
                                        <td style="display:none;">No Data Available</td>
                                    </tr>
                                <?php
                            }
                        ?>
                    
                </tbody>
            </table>


            <!-- Modal -->
                <div class="modal fade" id="viewUserModal" role="dialog" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewUserModalLabel">User Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body edit-pending-modal">
                                <!-- 'action_button/view-waitingForApproval.php' -->
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Modal End -->

            <!-- Add User Modal -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- add-user-modal.php -->
                            <form action="action_button/add-user.php" method="POST">
                                <div id="personal-information" class="p">Personal Information <hr>
                                    <div class="form-group">
                                        <label for="">First Name</label>
                                        <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Middle Name</label>
                                        <input type="text" name="middle_name" class="form-control" placeholder="Enter Middle Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Telegram</label>
                                        <input type="number" name="telegram" class="form-control" placeholder="Enter Telegram Account" required>
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
                                        
                                    <div class="form-group" id="response">
                                    <!-- department-select.php -->
                                    </div>
                                </div>

                                <div id="system-credentials" class="p">System Credentials
                                <hr>
                                    <div class="form-group">
                                        <label for="">User Type</label>
                                        <select name="account_type" class="form-control">
                                            <?php accountTypeLimit("userRegistration", $current_account_type, 0) ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Confirm Password</label>
                                        <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="addNewUserButton" class="btn btn-primary">Save changes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
                    <!-- Modal End-->
<?php
    include ('../includes/adminFooter.php');
?>

<script src="../js/select_department.js">
    
</script>

<script type='text/javascript'>
        $(document).ready(function() {
            $('.userinfo').click(function(){
                var userid = $(this).data('id');
                // $('#viewUserModal').modal('show');
                // alert(userid);
                $.ajax({
                    url: 'action_button/view-waitingForApproval.php',
                    type: 'post',
                    data: {userid: userid},
                    success: function(response){
                        $('.edit-pending-modal').html(response);
                        $('#viewUserModal').modal('show');
                    }
                });
            });
        });
</script>

<script>
    $(document).ready( function () {
    $('#pendingAccountsTable').DataTable();
        } );
</script>