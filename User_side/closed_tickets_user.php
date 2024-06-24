<?php
    include ('header.php');

?>
            
            <h2 class="my-5">List of Closed Tickets</h2>
                
            <!-- <form class="form-inline d-flex justify-content-end align-items-baseline">
                <input class="form-control mr-sm-2 mb-2" type="search" placeholder="Search" aria-label="Search">
            </form> -->

            <!-- Modal -->
            <div class="modal fade" id="addTicketModal" tabindex="-1" aria-labelledby="addTicketModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addTicketModalLabel">Create Ticket</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                                <div class="form-group">
                                    <label for="">Subject</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Message</label>
                                    <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Attach image if needed</label>
                                    <input type="file" class="form-control-file">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
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
                                            WHERE user_id=$current_id AND status=1";
                        $displayResult = mysqli_query($con, $displayTablesql);
                        $displayResultCheck = mysqli_num_rows($displayResult);

                        if($displayResultCheck>0){
                            while($displayRow = mysqli_fetch_assoc($displayResult)){

                                $status = $displayRow['status'];
                                $ticket_id = $displayRow['ticket_id'];
                                $date_created = $displayRow['date_created'];
                                $ticket_number = $displayRow['ticket_number'];
                                $ticket_year = $displayRow['ticket_year'];
                                $displaySubject = $displayRow['subject'];
                                $displayDescription = $displayRow['ticket_description'];

                                if($status == 0){
                                    $status = "Pending";
                                }
                                else{
                                    $status = "Closed";
                                }
                                ?>
                                <tr>
                                <th scope="row"><?php echo $ticket_year."-"; echo ticketNumberLengthCheck($ticket_number); ?></th>
                                    <td><?php echo "$date_created"?></td>
                                    <td><?php echo "$displaySubject"?></td>
                                    <td><?php echo "$displayDescription"?></td>
                                    <td><?php echo "$status"?></td>
                                    <td>
                                        <a href="<?php echo $siteURL; ?>User_side/ticket-messages.php?id=<?php echo $ticket_id; ?>" class="btn btn-primary">View</a>
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