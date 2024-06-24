<?php 
    session_start();
    include('../../Includes/connection.php');
?>

<html>
    <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body>
        

<?php
    
            // echo "Clicked";
            $selected_user_id = $_POST['selected_user_id'];
            $uar_code = $_POST['uar_code'];
            $sa_access = $_POST['access'];
            $sa_add = $_POST['add'];
            $sa_edit = $_POST['edit'];
            $sa_view = $_POST['view'];
            $sa_print = $_POST['print'];
            $sa_delete = $_POST['delete'];
            $sa_upload_doc = $_POST['uploadDoc'];
            $sa_download_doc = $_POST['downloadDoc'];
            $sa_delete_doc = $_POST['deleteDoc'];

            $updateSQL="UPDATE user_access_rights 
                        SET sa_access = $sa_access, 
                            sa_add = $sa_add,
                            sa_edit = $sa_edit,
                            sa_view = $sa_view,
                            sa_print = $sa_print,
                            sa_delete = $sa_delete,
                            sa_upload_doc = $sa_upload_doc,
                            sa_download_doc = $sa_download_doc,
                            sa_delete_doc = $sa_delete_doc
                        WHERE uar_code = $uar_code";

            $update = mysqli_query($con, $updateSQL);
            
            ?> 
                <input type="hidden" id="selected_user_id" value="<?php echo $selected_user_id;?>">
            <?php
            
            if($update == true)
            {
                // $_SESSION['update'] = "<div class='alert alert-success' role='alert'>
                //                         User Access Updated Successfully.
                //                         </div>";
                // header('location:'.$siteURL.'Admin_side/access-rights.php');

                $display = array(
                    'status' => true
                );
                echo json_encode($display);
                ?>
                    <script src="../js/access-rights-loader.js">
                // auto refresh from database
            </script>
                    
                <?php
                
            }
            else
            {
                // $_SESSION['update'] = "<div class='alert alert-danger' role='alert'>
                //                         User Access Failed to Update.
                //                         </div>";
                // header('location:'.$siteURL.'Admin_side/access-rights.php'); 
                $display = array(
                    'status' => false
                );
                echo json_encode($display);               
            }
            
            // $update_session = "<div class='alert alert-success' role='alert'>
            //                     User Access Updated Successfully.
            //                     </div>";
?>



</body>
</html>

