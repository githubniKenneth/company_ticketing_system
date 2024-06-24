<?php
    include ('header.php');

?>
            
            <h2 class="my-5">List of Tickets</h2>
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
            ?>
            <form class="form-inline d-flex justify-content-end align-items-baseline">
                <button type="button" data-toggle="modal" data-target="#addTicketModal" class="btn btn-success mb-2">Add Ticket</button>
                <!-- <input class="form-control mr-sm-2 mb-2" type="search" placeholder="Search" aria-label="Search"> -->
            </form>

            <!-- Modal -->
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
                                        <?php getItAndAdminList(0); ?> 
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
            <!-- Modal End-->


            <table class="table" id="myTicketsTable">
                <thead>
                <tr>
                    <th scope="col">Ticket Request #</th>
                    <th scope="col">Date Created</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                
                <?php
                    
                    $displayTablesql = "SELECT ticket_id, ticket_year, ticket_number, date_created, subject, ticket_description, status
                                        FROM ticket
                                        WHERE user_id=$current_id";
                    $displayResult = mysqli_query($con, $displayTablesql);
                    $displayResultCheck = mysqli_num_rows($displayResult);

                    if($displayResultCheck>0){
                        while($displayRow = mysqli_fetch_assoc($displayResult)){
                            $ticket_id = $displayRow['ticket_id'];
                            $status = $displayRow['status'] == 0 ? "Pending":"Closed";
                            $ticket_number = $displayRow['ticket_number'];
                            $ticket_year = $displayRow['ticket_year'];
                            $date_created = $displayRow['date_created'];
                            $displaySubject = $displayRow['subject'];
                            $displayDescription = $displayRow['ticket_description'];

                            ?>
                            <tr>
                                <th scope="row"><?php echo $ticket_year."-"; echo ticketNumberLengthCheck($ticket_number); ?></th>
                                <td><?php echo $date_created;?></td>
                                <td><?php echo $displaySubject;?></td>
                                <td><?php echo $displayDescription;?></td>
                                <td><?php echo $status;?></td>
                                <td>
                                
                                    <a href="<?php echo $siteURL; ?>User_side/ticket-messages.php?id=<?php echo $ticket_id; ?>" class="btn btn-primary">View</a>
                                
                                    <!-- <a href="view_ticket.php"></a> -->
                                    <?php 
                                        if($status == "Closed")
                                        {

                                        }
                                        else
                                        {
                                            ?>
                                                <a href="<?php echo $siteURL;?>User_side/action_button/delete-ticket.php?id=<?php echo $ticket_id;?>"><button type="button" class="btn btn-danger">Delete</button></a>
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
                                </tr>
                            <?php
                        }
                ?>

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
        </div>
    </div>
    
    <?php include ('footer.php')?>

