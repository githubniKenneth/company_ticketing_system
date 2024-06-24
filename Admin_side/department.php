<?php
    session_start();
    include ('../includes/adminSidebar.php');

?>

            <h2 class="my-5">List of Departments</h2>
            <?php
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            <form class="form-inline d-flex justify-content-end align-items-baseline mb-2">
                <button type="button" data-toggle="modal" data-target="#addDepartmentModal" class="btn btn-success" <?php accessPermission("sa_add", $current_id, systemApps::appNum_Department); ?>>Add Department</button>
                <!-- <input class="form-control mr-sm-2 mb-2" type="search" placeholder="Search" aria-label="Search"> -->
            </form>

            <!-- Edit Modal -->
            <div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editDepartmentModalLabel">Edit Department</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body edit-modal-body">
                                <!-- <div class="form-group">
                                    <label for="">Department Name</label>
                                    <input type="text" name="departmentName"class="form-control" placeholder="Enter Department Name">
                                </div>  -->
                            </div>
                    </div>
                </div>
            </div>
            <!-- Edit Modal End-->

            <!-- Add Department Modal -->
            <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="action_button/add-department.php" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addDepartmentModalLabel">Add New Department</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">Company Name</label>
                                    <select name="select_company" id="companyName" class="form-control">
                                        <!-- <option value="">Dyne Edge</option>
                                        <option value="">1D</option> -->
                                        <?php
                                            $sql3 = "SELECT company_id, company_name FROM company";
                                            $result3 = mysqli_query($con, $sql3);
                                            $resultCheck3 = mysqli_num_rows($result3);
                                            if ($resultCheck3 > 0){
                                                while ($row3 = mysqli_fetch_assoc($result3)){
                                                    $companyId = $row3['company_id'];
                                                    $companyName = $row3['company_name'];
                                                    ?>
                                                    <option value="<?php echo $companyId; ?>"><?php echo $companyName; ?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">New Department</label>
                                    <input type="text" name="departmentName" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="addDepartmentButton" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal End-->

            <table class="table" id="departmentTable">
                <thead>
                    <tr>
                        <th scope="col">Department ID</th>
                        <th scope="col">Date Created </th>
                        <th scope="col">Departments Name </th>
                        <th scope="col">Company Name </th>
                        <th scope="col">Created By </th>
                        <th scope="col">Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT
                        a.company_name,
                        b.date_created, b.department_name, b.user_id, b.department_id,
                        concat(c.last_name,', ',c.first_name,' ',c.middle_name,'.') as full_name
                        FROM
                        ((company a
                        INNER JOIN department b ON a.company_id=b.company_id)
                        INNER JOIN user c ON b.user_id=c.user_id)";

                        $result = mysqli_query($con, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        $counter = 0;
                        if($resultCheck > 0){
                            while ($row = mysqli_fetch_assoc($result)){
                                $department_id = $row['department_id'];
                                $DepartmentName = $row['department_name'];
                                $dateCreated = $row['date_created'];
                                $companyName = $row['company_name'];
                                $full_name = $row['full_name'];
                                $counter++;
                    ?>
                                <tr>
                                    <th scope="row"><?php echo $counter; ?></th>
                                    <td> <?php echo $dateCreated; ?>  </td>
                                    <td> <?php echo $DepartmentName; ?></td>
                                    <td> <?php echo $companyName; ?>  </td>
                                    <td> <?php echo $full_name;   ?></td>
                                    <td>
                                        <button data-id="<?php echo $department_id;?>" class="editDepartment btn btn-primary" <?php accessPermission("sa_view", $current_id, systemApps::appNum_Department); ?>>Edit</button>
                                        <button data-id="<?php echo $department_id;?>" class="deleteDepartment btn btn-danger" <?php accessPermission("sa_delete", $current_id, systemApps::appNum_Department); ?>>Delete</button>
                                        <!-- <a href="<?php //echo $siteURL;?>Admin_side/action_button/delete-department.php?id=<?php //echo $department_id;?>"><button class="btn btn-danger" <?php //accessPermission("sa_delete", $current_id, systemApps::appNum_Department); ?>>Delete</button></a> -->
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
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="confirm-delete-department" tabindex="-1" aria-labelledby="removeDepartmentModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" id="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-end">
                    <div class="d-flex">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                </div>
                <div id="delete-department" class="modal-body">

            </div>
        </div>
      </div>
    </div>

<?php
    include('../Includes/adminFooter.php');
?>


<script type='text/javascript'>
    $(document).ready(function() {
        $('.editDepartment').click(function(){ // button class name
            var departmentId = $(this).data('id'); // data id on button class name
            // alert(departmentId);
            $.ajax({
                url: 'action_button/edit-department.php',
                type: 'post',
                data: {departmentId: departmentId},
                success: function(response){
                    $('.edit-modal-body').html(response); // modal body class name
                    $('#editDepartmentModal').modal('show'); // button name
                }
            });
        });
    });
</script>

<script>
    $(document).ready( function () {
    $('#departmentTable').DataTable();
        } );
</script>

<script type='text/javascript'>
        $(document).ready(function() {
            $('.deleteDepartment').click(function(){
                let departmentId = $(this).data('id');
                // $('#viewUserModal').modal('show');
                // alert(employeeId);
                $.ajax({
                    url: 'action_button/confirm-delete-department.php',
                    type: 'post',
                    data: { departmentId: departmentId },
                    success: function(response){
                        $('#delete-department').html(response);
                        $('#confirm-delete-department').modal('show');
                    }
                });
            });
        });
</script>
