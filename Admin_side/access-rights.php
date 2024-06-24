<?php
    session_start();
    include ('../includes/adminSidebar.php');

?>

        <h2 class="my-5">User Access Rights</h2>
        <?php 
            // if(isset($_SESSION['update']))
            // {
            //     echo $_SESSION['update'];
            //     unset($_SESSION['update']);
            // }
            if(isset($_SESSION['added']))
            {
                echo $_SESSION['added'];
                unset($_SESSION['added']);
            }
        ?>
        <div id="success_message"></div>
        <span id="error_message" class="text-danger"></span>
        <!-- <span id="success_message" class="text-success"></span> -->
        <div>
            <h4>Select User to Manage</h4>  <br>
            <div class="d-flex justify-content-between mb-2">
                <select name="" id="selected_user" class="user form-control w-auto">
                    <option value="">Select User</option>
                    <?php
                        $userSql = "SELECT user_id, concat(last_name,', ',first_name,' ',middle_name,'.') AS full_name
                                    FROM user 
                                    WHERE account_type=1 OR account_type=2";
                        $runUserSql = mysqli_query($con, $userSql);
                        $rowUserSql = mysqli_num_rows($runUserSql);
                        
                        if($rowUserSql > 1)
                        {
                            while($rowUser = mysqli_fetch_assoc($runUserSql))
                            {
                                $user_id = $rowUser['user_id'];
                                // $username = $rowUser['username'];
                                $full_name = $rowUser['full_name'];
                                // $middle_name = $rowUser['middle_name'];
                                // $last_name = $rowUser['last_name'];
                                ?>
                                    <option value="<?php echo $user_id; ?>"><?php echo $full_name; ?></option>
                                    
                                <?php
                                
                            }
                        }
                    ?>
                </select>

                
                <button type="submit" class="btn btn-success mr-sm-2" onclick="return addAccess()" <?php accessPermission("sa_add", $current_id, systemApps::appNum_UserAccessRights); ?>>Add Access</button>
            </div>
        </div>

        <div class="form-inline d-flex justify-content-end">
            <input class="form-control mr-sm-2 mb-2" type="search" placeholder="Search" aria-label="Search">
        </div>
    <!-- <input type="hidden" id="test" value="40"> -->
        <div class="form-group" id="response">
                    
                    <!-- userAcess.php -->
                    <!-- <script src="../js/access-rights-loader.js">
                        // auto refresh from database
                    </script> -->
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Application Name</th>
                    <th scope="col">Access</th>
                    <th scope="col">Add </th>
                    <th scope="col">Edit</th>
                    <th scope="col">View</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Print</th>
                    <th scope="col">Upload Docs</th>
                    <th scope="col">Download Docs</th>
                    <th scope="col">Delete Docs</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
            </table>
        </div>



    <!-- Add Access Modal -->
    <div class="modal fade" id="addAccessModal" tabindex="-1" aria-labelledby="addAccessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="action_button/add-access.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAccessModalLabel">Add New Access</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex justify-content-center flex-column">
                        <label for="">Are you sure that you want to give this user an access?</label>
                        <div class="form-group">
                            <button class="btn btn-success" href="">Yes</button>
                            <button class="btn btn-danger" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal End-->

<?php
    include ('../includes/adminFooter.php')
?>



    <script>
        $(document).ready(function(){
            $("select.user").change(function(){
                var selectedUser= $(".user option:selected").val();
                // alert(selectedUser);
                $.ajax({
                    type: "POST",
                    url: "userAccess.php",
                    data: { user : selectedUser } 
                }).done(function(data){
                    $("#response").html(data);
                });
            });
        });
    </script>

    <script>
        function addAccess()
        {
            var data={};
            let text = "Are you sure that you want to give this user an access?";
            if (confirm(text) == true) {
                // text = "You pressed OK!";
                var selectedUser= $(".user option:selected").val();
                $.ajax({
                    type: "POST",
                    url: "action_button/add-access.php",
                    data: { user : selectedUser } 
                }).done(function(data){
                    var xVal = JSON.parse(data);
                    // alert('You Added '+xVal.insertedValues+ ' Applications');
                    // $("#responses").html(data); //test on page
                });
            } else {
                // text = "You canceled!";
            }
            return false;
        }
    </script>

    