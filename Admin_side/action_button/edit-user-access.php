<?php
    session_start();
    include('../../Includes/connection.php');
    include('../../restrictions/restriction-check.php');
    include('../cls_constant.php');
    $uar_code = $_POST['uar_code'];
    $selected_user_id = $_POST['selected_user_id'];
    $current_id = $_SESSION['user_id'];

    $sql = "SELECT a.uar_code, a.sa_access, a.sa_add, a.sa_edit, a.sa_view, a.sa_print, a.sa_delete, a.sa_upload_doc, a.sa_download_doc, a.sa_delete_doc,
                    b.sa_name
            FROM user_access_rights a
            INNER JOIN system_application b ON a.sa_id=b.sa_id
            WHERE uar_code=$uar_code";

    $sqlResult = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($sqlResult);

    if($resultCheck > 0)
    {
        while($row = mysqli_fetch_assoc($sqlResult))
        {
            $uar_code = $row['uar_code'];
            $sa_name = $row['sa_name'];
            $sa_access = $row['sa_access'];
            $sa_add = $row['sa_add'];
            $sa_edit = $row['sa_edit'];
            $sa_view = $row['sa_view'];
            $sa_print = $row['sa_print'];
            $sa_delete = $row['sa_delete'];
            $sa_upload_doc = $row['sa_upload_doc'];
            $sa_download_doc = $row['sa_download_doc'];
            $sa_delete_doc = $row['sa_delete_doc'];
        }
    }

?>
    <form method="POST" id="user_access_form">
    <span id="error_message" class="text-danger"></span>
        <span id="success_message" class="text-success"></span>
    <input type="hidden" name="uar_code" value="<?php echo $uar_code; ?>">
    <input type="text" name="selected_user_id" id="selected_user_id" value="<?php echo $selected_user_id; ?>">
    <div class="form-group">
        <label for="">Application Name</label>
        <input type="text" class="form-control" value="<?php echo $sa_name;?>" id="application_name" disabled>
    </div>
    <div class="form-group">
        <label for="">Access</label>
        <select name="access" class="form-control">
            <option value="0" <?php if($sa_access==0) echo 'selected="selected"'; ?>>No</option>
            <option value="1" <?php if($sa_access==1) echo 'selected="selected"'; ?>>Yes</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Add</label>
        <select name="add" class="form-control">
            <option value="0" <?php if($sa_add==0) echo 'selected="selected"'; ?>>No</option>
            <option value="1" <?php if($sa_add==1) echo 'selected="selected"'; ?>>Yes</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Edit</label>
        <select name="edit" class="form-control">
            <option value="0" <?php if($sa_edit==0) echo 'selected="selected"'; ?>>No</option>
            <option value="1" <?php if($sa_edit==1) echo 'selected="selected"'; ?>>Yes</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Delete</label>
        <select name="delete" class="form-control">
            <option value="0" <?php if($sa_delete==0) echo 'selected="selected"'; ?>>No</option>
            <option value="1" <?php if($sa_delete==1) echo 'selected="selected"'; ?>>Yes</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">View</label>
        <select name="view" class="form-control">
            <option value="0" <?php if($sa_view==0) echo 'selected="selected"'; ?>>No</option>
            <option value="1" <?php if($sa_view==1) echo 'selected="selected"'; ?>>Yes</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Print</label>
        <select name="print" class="form-control">
            <option value="0" <?php if($sa_print==0) echo 'selected="selected"'; ?>>No</option>
            <option value="1" <?php if($sa_print==1) echo 'selected="selected"'; ?>>Yes</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Upload Docs</label>
        <select name="uploadDoc" class="form-control">
            <option value="0" <?php if($sa_upload_doc==0) echo 'selected="selected"'; ?>>No</option>
            <option value="1" <?php if($sa_upload_doc==1) echo 'selected="selected"'; ?>>Yes</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Download Docs</label>
        <select name="downloadDoc" class="form-control">
            <option value="0" <?php if($sa_download_doc==0) echo 'selected="selected"'; ?>>No</option>
            <option value="1" <?php if($sa_download_doc==1) echo 'selected="selected"'; ?>>Yes</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Delete Docs</label>
        <select name="deleteDoc" class="form-control">
            <option value="0" <?php if($sa_delete_doc==0) echo 'selected="selected"'; ?>>No</option>
            <option value="1" <?php if($sa_delete_doc==1) echo 'selected="selected"'; ?>>Yes</option>
        </select>
    </div>
    
    <div class="modal-footer">
        <button type="submit" name="updateUserAccess" class="btn btn-primary" id="updateUserAccess" <?php accessPermissions("sa_edit",$current_id,systemApps::appNum_UserAccessRights); ?>>Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#user_access_form").on("submit", function(event){
            event.preventDefault(event);
            // $("#updateUserAccess").click(function(){
            //             $("#response").load(userAccess.php);
            //         });
            $('#editUserAcessModal').modal('hide');
            var form_data = new FormData(this);

            $.ajax({
                url:"action_button/update-user-access.php",
                method:"POST",
                data:form_data,
                dataType:"json",
                processData:false,
                contentType:false,
                
                success:function(data){
                    
                    if(data.status==true)
                    {
                        sendSelectedUser();
                    }
                    
                    
                    // $('#success_message').text(update);
                
                }
            });
        });
    });
</script>

<script>
    function sendSelectedUser()
    {
        var user = $('selected_user_id').val();

        $.ajax({
            url:"userAccess.php",
            method:"POST",
            data:{ user : user},
            success:function(data){

            
            }
        });

        var user = $('selected_user_id').val();
        // alert(selectedUser);
        $.ajax({
            type: "POST",
            url: "userAccess.php",
            data: { user : user } 
        }).done(function(data){
            $("#response").html(data);
        });

    }
    // $(document).ready(function(){
    //     $("#user_access_form").on("submit", function(event){
    //         event.preventDefault(event);
            
    //         // $('#editUserAcessModal').modal('hide');
    //         // var form_data = new FormData(this);
    //         var user = $('selected_user_id').val();

    //         $.ajax({
    //             url:"userAccess.php",
    //             method:"GET",
    //             data:{ user : user},
    //             success:function(data){
    //                 // $('.table').html(data);
    //                 // if(data.status==true)
    //                 // {
    //                 //     $("#response").load('access-rights.php #response');
    //                 // }
                    
                    
    //                 // $('#success_message').text(update);
                
    //             }
    //         });
    //     });
    // });
</script>
<!-- <script>
    $(document).ready(function(){
        
    });
</script> -->