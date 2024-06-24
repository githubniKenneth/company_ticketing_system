<?php
session_start();
include('../../Includes/connection.php');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                    <option value="0" >User</option>
                    <option value="1" >IT</option>
                    <option value="2" >Admin</option>
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
    
    