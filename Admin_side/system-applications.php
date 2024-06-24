<?php
    session_start();
    include ('../includes/adminSidebar.php');

?>

                <h2 class="my-5">List of System Applications</h2>
                <?php
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                ?>

                <form class="form-inline d-flex justify-content-end my-2">
                    <button type="button" data-toggle="modal" data-target="#addAppModal" class="btn btn-success" <?php accessPermission("sa_add", $current_id, systemApps::appNum_SystemApplication) ?>>Add Application</button>
                    <!-- <input class="form-control mr-sm-2 mb-2" type="search" placeholder="Search" aria-label="Search"> -->
                </form>

            <table class="table" id="systemAppsTable">
                <thead>
                <tr>
                    <th scope="col">Application Name</th>
                    <th scope="col">Status </th>
                    <th scope="col">Created By </th>
                    <th scope="col">Date Created</th>
                    <th scope="col">Modified By </th>
                    <th scope="col">Date Modified </th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>

                    <?php
                        $sql = "SELECT a.sa_id, a.sa_name, a.sa_created_by, a.sa_modified_by, a.sa_status,
                                date_format(a.sa_created_date,'%m/%d/%Y %h:%i %p') as sa_created_date,
                                date_format(a.sa_modified_date,'%m/%d/%Y %h:%i %p') as sa_modified_date,
                                concat(b.last_name,', ',b.first_name,' ',b.middle_name) as sa_created_by,
                                concat(c.last_name,', ',c.first_name,' ',c.middle_name) as modifiedBy
                                FROM system_application a
                                INNER JOIN user b ON a.sa_created_by=b.user_id
                                LEFT OUTER JOIN user c ON a.sa_modified_by=c.user_id";

                        $result = mysqli_query($con, $sql);
                        $resultCheck = mysqli_num_rows($result);

                        if($resultCheck > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $sa_id = $row['sa_id'];
                                $sa_name = $row['sa_name'];
                                $sa_created_by = $row['sa_created_by'];
                                $sa_created_date = $row['sa_created_date'];
                                $sa_modified_by = $row['sa_modified_by'];
                                $sa_modified_date = $row['sa_modified_date'] == '01/01/1000 12:00 AM' ? " " : $row['sa_modified_date'];
                                $sa_status = $row['sa_status'];

                                $modifiedBy = $row['modifiedBy'];
                                if($sa_status == 0){
                                    $sa_status = "InActive";
                                }
                                else{
                                    $sa_status = "Active";
                                }
                        ?>
                            <tr>
                                <th scope="row"><?php echo $sa_name; ?></th>
                                <td><?php echo $sa_status; ?></td>
                                <td><?php echo $sa_created_by; ?></td>
                                <td><?php echo $sa_created_date; ?></td>
                                <td><?php echo $modifiedBy; ?></td>
                                <td><?php echo  $sa_modified_date; ?></td>
                                <td>
                                    <button type="button" data-id="<?php echo $sa_id; ?>" class="editApp btn btn-primary" <?php accessPermission("sa_view", $current_id, systemApps::appNum_SystemApplication) ?>>Edit</button>
                                </td>
                            </tr>
                        <?php
                            }
                        }
                        else
                        {
                            ?>
                                <tr>
                                    <td>No Data available</td>
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

            <!-- Edit Modal -->
            <div class="modal fade" id="editAppModal" tabindex="-1" aria-labelledby="editAppModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editAppModalLabel">Edit App</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body edit-modal-body">

                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal End-->


            <!-- Add Application Modal -->
            <div class="modal fade" id="addAppModal" tabindex="-1" aria-labelledby="addAppModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="action_button/add-app.php" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAppModalLabel">Add New Application</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">New Application</label>
                                    <input type="text" name="AppName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="addAppButton" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal End-->

<?php
    include ('../includes/adminFooter.php')
?>

<script type='text/javascript'>
        $(document).ready(function() {
            $('.editApp').click(function(){
                var sa_id = $(this).data('id');
                // alert(sa_id);
                $.ajax({
                    url: 'action_button/edit-system-app.php',
                    type: 'post',
                    data: {sa_id: sa_id},
                    success: function(response){
                        $('.edit-modal-body').html(response);
                        $('#editAppModal').modal('show');
                    }
                });
            });
        });
</script>

<script>
    $(document).ready( function () {
    $('#systemAppsTable').DataTable();
        } );
</script>
