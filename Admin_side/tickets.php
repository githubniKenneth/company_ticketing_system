<?php
session_start();
include ('../includes/adminSidebar.php');
?>

                <h2 class="my-5">All Tickets</h2>
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
                <form class="form-inline d-flex justify-content-end mb-2">
                    <button type="button" data-toggle="modal" data-target="#addTicketModal" class="btn btn-success">Add Ticket</button>
                    <!-- <input class="form-control mr-sm-2 mb-2" type="search" placeholder="Search" aria-label="Search"> -->
                </form>

            <table class="table" id="ticketTable">
                <thead>
                <tr>
                    <th scope="col"># </th>
                    <th scope="col">Created </th>
                    <th scope="col">Duration </th>
                    <th scope="col">Name </th>
                    <th scope="col">Subject </th>
                    <th scope="col">Description </th>
                    <th scope="col">Priority </th>
                    <th scope="col">Assigned To </th>
                    <th scope="col">Status </th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT
                                a.ticket_id, a.subject, a.ticket_description, a.date_created, a.status, a.message, a.priority, a.assigned_to,
                                b.first_name, b.last_name, b.user_id
                                FROM
                                ticket a
                                INNER JOIN user b ON a.user_id=b.user_id
                                ORDER BY status ASC,
                                        ticket_number ASC";
                        $result = mysqli_query($con, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        $counter = 0;
                        if($resultCheck > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $ticket_id = $row['ticket_id'];

                                $dateCreated = new DateTime($row['date_created']);
                                $dateCreatedDisplay = date_format($dateCreated, "m/d/Y H:i A");
                                $created = date_format($dateCreated, "m/d/Y H:i:s");
                                $old_date = strtotime($created);

                                $current_date_format = date("m/d/Y H:i:s");
                                // $createds = date_format($test, "m/d/Y H:i:s");
                                $current_date = strtotime($current_date_format);

                                $difference = $current_date - $old_date;
                                // $minutes = floor($difference/(60));
                                // $hours = floor($difference/(60*60));
                                $days = floor($difference/(60*60*24));
                                $remainder = floor($difference % (60*60*24));
                                $hours = floor($remainder/(60*60));

                                $ticketDescription = $row['ticket_description'];

                                $subject = $row['subject'];
                                $firstName = $row['first_name'];
                                $lastName = $row['last_name'];
                                $message = $row['message'];
                                $status = $row['status'];
                                $statusCheck = $row['status'] == 0 ? "Pending":"Closed";
                                $priority = $row['priority'];
                                $assigned_to = $row['assigned_to'];
                                $user_id = $row['user_id'];
                                $counter++;

                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $counter; ?></th>
                                        <td><?php echo $dateCreatedDisplay; ?></td>
                                        <td><?php echo $status == 0 ? $days." days ".$hours." hours" : ""?></td>
                                        <td><?php echo $firstName." ".$lastName; ?></td>
                                        <td><?php seeLessOrMoreText($subject, $ticket_id); ?></td>
                                        <td><?php seeLessOrMoreText($ticketDescription, $ticket_id); ?></td>
                                        <td><?php setPriorityName($priority); ?></td>
                                        <td><?php echo setFullName($assigned_to);?></td>
                                        <td><?php echo $statusCheck; ?></td>
                                        <td>
                                            <button type="button" data-id="<?php echo $ticket_id; ?>" class="editTicket btn btn-primary" <?php accessPermission("sa_view", $current_id, systemApps::appNum_AllTicket); ?>>Edit</button>
                                            <a href="<?php echo $siteURL; ?>Admin_side/ticket-messages.php?id=<?php echo $ticket_id; ?>" class="btn btn-success">Messages</a>
                                            <?php
                                                if($user_id == $current_id)
                                                {
                                                    ?>
                                                        <a href="<?php echo $siteURL;?>Admin_side/action_button/delete-ticket.php?id=<?php echo $ticket_id;?>"><button type="button" class="btn btn-danger">Delete</button></a>
                                                    <?php
                                                }
                                            ?>
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
                                        <td style="display:none;">No Data Available</td>
                                        <td style="display:none;">No Data Available</td>
                                    </tr>
                                <?php
                            }
                    ?>
                </tbody>
            </table>

            <!-- Add Ticket Modal -->
            <div class="modal fade " id="addTicketModal" tabindex="-1" aria-labelledby="addTicketModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addTicketModalLabel">Create Ticket</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <!-- Add-ticket.php Form -->
                        <form action="action_button/add-ticket.php" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <?php
                                    $selectSQL ="SELECT a.user_id,
                                                        b.company_id,
                                                        c.department_id
                                                        FROM user a
                                                        INNER JOIN company b ON a.company_id=b.company_id
                                                        INNER JOIN department c ON a.department_id=c.department_id
                                                        WHERE a.user_id=$current_id";
                                    $selectResult = mysqli_query($con, $selectSQL);
                                    $selectResultCheck = mysqli_num_rows($selectResult);
                                    if($selectResultCheck > 0)
                                    {
                                        while($rowResult = mysqli_fetch_assoc($selectResult))
                                        {
                                            $companyName = $rowResult['company_id'];
                                            $departmentName = $rowResult['department_id'];
                                        }
                                    }

                                ?>
                                <input type="hidden" name="company" value="<?php echo $companyName ?>">
                                <input type="hidden" name="department" value="<?php echo $departmentName; ?>">

                                <!-- Add-ticket.php Form -->
                                <div class="form-group">
                                    <label for="ticket_date">Date</label>
                                    <input type="text" name="ticket_date" value="<?php echo date("m/d/Y"); ?>" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Subject</label>
                                    <input type="text" name="subject" value="" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="">Ticket Description</label>
                                    <textarea name="ticketDescription" id="" cols="30" rows="5" class="form-control" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Message</label>
                                    <textarea name="message" id="" cols="30" rows="5" class="form-control" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Assign To</label>
                                    <select name="assigned_to" class="form-control">
                                        <!-- cls_global_functions.php-->
                                        <?php getItAndAdminList($ticket_id); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Priority</label>
                                    <select name="priority" class="form-control">
                                        <option value="0">Low</option>
                                        <option value="1">Moderate</option>
                                        <option value="2">High</option>
                                        <option value="3">Urgent</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Attach file if needed</label>
                                    <input type="file" name="file" class="form-control-file">

                                    <input type="hidden" name="user_id" value="<?php echo $current_id; ?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="addTicketButton" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Add Ticket Modal End-->

            <!-- Modal -->
            <div class="modal fade" id="editTicketModal" tabindex="-1" aria-labelledby="editTicketModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTicketModalLabel">Edit Ticket</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body target-modal-body" id="target-modal-body">
                        </div>
                    </div>
                </div>
            </div>
                    <!-- Modal End-->


<?php
    include ('../includes/adminFooter.php')
?>

<script type='text/javascript' src='../js/edit_ticket.js'></script>

<script>
    $(document).ready( function () {
    $('#ticketTable').DataTable();
        } );
</script>

<!-- <script src="../js/dataTables-function.js">
    dataTablesScript("tickets");
</script> -->
