<?php
    session_start();
    include ('../includes/adminSidebar.php');
?>

                <h2 class="my-5">Pending Tickets</h2>
                
                <!-- <form class="form-inline d-flex justify-content-end">
                    <input class="form-control mr-sm-2 mb-2" type="search" placeholder="Search" aria-label="Search">
                </form> -->
            
            <table class="table" id="pendingTicketsTable">
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
                                a.user_id, a.subject, a.ticket_description, a.date_created, a.status, a.message, a.ticket_id, a.priority, a.assigned_to,
                                b.first_name, b.last_name
                                FROM 
                                ticket a 
                                INNER JOIN user b ON a.user_id=b.user_id
                                WHERE a.status=0";
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
                                // if($hours <= 0)
                                // {
                                //     $hours = "";
                                // }

                                $subject = $row['subject'];
                                // $companyName = $row['company_name'];
                                $firstName = $row['first_name'];
                                $lastName = $row['last_name'];
                                // $departmentName = $row['department_name'];
                                $ticketDescription = $row['ticket_description'];
                                $message = $row['message'];
                                // $file = $row['file_uploaded'];
                                $status = $row['status'];
                                $statusCheck = $row['status'] == 0 ? "Pending":"Closed";
                                $priority = $row['priority'];
                                $assigned_to = $row['assigned_to'];
                                $user_id = $row['user_id'];
                                $counter++;

                                // $days." days ".$hours." hours"
                                // <td><?php echo $status == 0 ? $days." days ".$hours." hours" : "closed"
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
                                            <button type="button" data-id="<?php echo $ticket_id; ?>" class="editTicket btn btn-primary" <?php accessPermission("sa_view", $current_id, systemApps::appNum_PendingTicket); ?>>Edit</button>
                                            <button type="button" class="btn btn-success"><a href="<?php echo $siteURL; ?>Admin_side/ticket-messages.php?id=<?php echo $ticket_id; ?>">Messages</a></button>
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
                                <div class="modal-body target-modal-body">   
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal End-->

                </tbody>
            </table>
            <!-- <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
            <div class="p-10">
                <strong>Page 1 of 10</strong>
            </div> -->

<?php
    include ('../includes/adminFooter.php')
?>

<script type='text/javascript' src='../js/edit_ticket.js'>

</script>

<script>
    $(document).ready( function () {
    $('#pendingTicketsTable').DataTable();
        } );
</script>