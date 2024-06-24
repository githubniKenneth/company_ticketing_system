<?php 
    session_start();
    include ('../includes/connection.php'); 
    include('../restrictions/restriction-check.php');
    include('cls_constant.php');
    $current_id = $_SESSION['user_id'];

    // $selected_user=$_GET['selected_user'];
?>
    
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
        <tbody>
        <?php
                
                $user = $_GET["selected_user"];
                echo $user;
                if($user == "")
                {
                }
                else
                {
                    ?>
                        <input type="text" value="<?php echo $user;?>">
                    <?php
                    $sql = "SELECT a.*,
                            b.sa_name
                    FROM user_access_rights a
                    INNER JOIN system_application b ON a.sa_id=b.sa_id
                    WHERE user_id=$user";
                    $result = mysqli_query($con, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if($resultCheck > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $uar_code = $row['uar_code'];
                            $sa_name = $row['sa_name'];
                            $sa_access = $row['sa_access'] == 0 ? "No" : "Yes";
                            $sa_add = $row['sa_add'] == 0 ? "No" : "Yes";
                            $sa_edit = $row['sa_edit'] == 0 ? "No" : "Yes";
                            $sa_view = $row['sa_view'] == 0 ? "No" : "Yes";
                            $sa_delete = $row['sa_delete'] == 0 ? "No" : "Yes";
                            $sa_print = $row['sa_print'] == 0 ? "No" : "Yes";
                            $sa_upload_doc = $row['sa_upload_doc'] == 0 ? "No" : "Yes";
                            $sa_download_doc = $row['sa_download_doc'] == 0 ? "No" : "Yes";
                            $sa_deletedoc = $row['sa_delete_doc'] == 0 ? "No" : "Yes";
                            ?>
                                <tr>
                                    <td scope="row"><?php echo $sa_name; ?></td>
                                    <td><?php echo $sa_access; ?></td>
                                    <td><?php echo $sa_add; ?></td>
                                    <td><?php echo $sa_edit; ?></td>
                                    <td><?php echo $sa_view; ?></td>
                                    <td><?php echo $sa_delete; ?></td>
                                    <td><?php echo $sa_print; ?></td>
                                    <td><?php echo $sa_upload_doc; ?></td>
                                    <td><?php echo $sa_download_doc; ?></td>
                                    <td><?php echo $sa_deletedoc; ?></td>
                                    <td>
                                        <button type="button" data-id="<?php echo $uar_code; ?>" class="editUserAcess btn btn-primary" <?php accessPermission("sa_view", $current_id, systemApps::appNum_UserAccessRights) ?>>Edit</button>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                            <tr>
                                <td><?php echo "No Data Available"; ?></td>
                            </tr>
                        <?php
                    }
                }
            
            
        ?>
        </tbody>
    </table>

        <!-- Edit Modal -->
        <div class="modal fade" id="editUserAcessModal" tabindex="-1" aria-labelledby="editUserAcessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserAcessModalLabel">Edit User Acess</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End-->

<script type='text/javascript'>
    $(document).ready(function() {
        $('.editUserAcess').click(function(){
            var selected_user_id= $(".user option:selected").val();
            var uar_code = $(this).data('id');
            // alert(selected_user);
            $.ajax({
                url: 'action_button/edit-user-access.php',
                type: 'post',
                data: {uar_code: uar_code,
                        selected_user_id: selected_user_id},
                success: function(response){
                    $('.modal-body').html(response);
                    $('#editUserAcessModal').modal('show');
                }
            });
        });
    });
</script>

<!-- <script>
    setTimeout(function(){
        window.location.reload(1);
    }, 5000);
</script> -->
