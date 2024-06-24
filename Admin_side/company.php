<?php
    session_start();
    include ('../includes/adminSidebar.php');

?>

            <h2 class="my-5">List of Companies</h2>

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

            <div class="form-inline d-flex justify-content-end align-items-baseline mb-2">
                <button type="button" data-toggle="modal" data-target="#addCompanyModal" class="btn btn-success" <?php accessPermission("sa_add", $current_id, systemApps::appNum_Company); ?>>Add Company</button>
                <!-- <input class="form-control mr-sm-2 mb-2" type="search" placeholder="Search" aria-label="Search"> -->
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editCompanyModal" tabindex="-1" aria-labelledby="editCompanyModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCompanyModalLabel">Edit Company</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body edit-modal-body">
                                    <!-- <div class="form-group">
                                        <label for="">Coasdmpany Name</label>
                                        <input type="text" name="companyName"class="form-control" placeholder="Enter Company Name">
                                    </div>  -->
                            </div>
                    </div>
                </div>
            </div>
            <!-- Edit Modal End-->

            <!-- Add Modal -->
            <div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="action_button/add-company.php" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCompanyModalLabel">Add New Company</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <div class="form-group">
                                        <label for="">Company Name</label>
                                        <input type="text" name="companyName"class="form-control" placeholder="Enter Company Name">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="addCompanyButton" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal End-->


            <table class="table" id="companyTable">
                <thead>
                    <tr>
                        <th scope="col">Company ID</th>
                        <th scope="col">Date Created </th>
                        <th scope="col">Company Name </th>
                        <th scope="col">Created by </th>
                        <th scope="col">Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT
                                a.company_id, a.company_name, a.date_created,
                                concat(b.last_name,', ',b.first_name,' ',b.middle_name,'.') as full_name
                                FROM company a
                                INNER JOIN user b ON b.user_id=a.user_id";
                        $result = mysqli_query($con, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        $counter = 0;
                        if($resultCheck > 0){
                            while ($row = mysqli_fetch_assoc($result)){
                                $company_id = $row['company_id'];
                                $dateCreated = $row['date_created'];
                                $companyName = $row['company_name'];
                                $full_name = $row['full_name'];
                                $counter++;
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $counter; ?></th>
                                    <td> <?php echo $dateCreated; ?> </td>
                                    <td> <?php echo $companyName; ?> </td>
                                    <td> <?php echo $full_name; ?> </td>
                                    <td>
                                        <button data-id="<?php echo $company_id; ?>" class="editCompany btn btn-primary" <?php accessPermission("sa_view", $current_id, systemApps::appNum_Company) ?>>Edit</button>
                                        <button type="button" data-id="<?php echo $company_id; ?>" class="deleteCompany btn btn-danger" <?php accessPermission("sa_delete", $current_id, systemApps::appNum_Company); ?>>Delete</button>
                                        <!-- <a href="<?php //echo $siteURL;?>Admin_side/action_button/delete-company.php?id=<?php //echo $company_id;?>"><button type="button" class="btn btn-danger" <?php //accessPermission("sa_delete", $current_id, systemApps::appNum_Company); ?>>Delete</button></a> -->
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
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="confirm-delete-company" tabindex="-1" aria-labelledby="removeCompanyModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" id="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-end">
                    <div class="d-flex">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                </div>
                <div id="delete-company" class="modal-body">

            </div>
        </div>
      </div>
    </div>
<?php
    include('../Includes/adminFooter.php');
?>

<script type='text/javascript'>
    $(document).ready(function() {
        $('.editCompany').click(function(){
            var company_id = $(this).data('id');
            // $('#viewUserModal').modal('show');
            // alert(companyId);
            $.ajax({
                url: 'action_button/edit-company.php',
                type: 'post',
                data: {company_id: company_id},
                success: function(response){
                    $('.edit-modal-body').html(response);
                    $('#editCompanyModal').modal('show');
                }
            });
        });
    });
</script>


<script>
    $(document).ready( function () {
    $('#companyTable').DataTable();
        } );
</script>

<script type='text/javascript'>
        $(document).ready(function() {
            $('.deleteCompany').click(function(){
                let company_id = $(this).data('id');
                // $('#viewUserModal').modal('show');
                // alert(employeeId);
                $.ajax({
                    url: 'action_button/confirm-delete-company.php',
                    type: 'post',
                    data: { company_id: company_id },
                    success: function(response){
                        $('#delete-company').html(response);
                        $('#confirm-delete-company').modal('show');
                    }
                });
            });
        });
</script>
