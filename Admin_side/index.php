<?php
    session_start();
    include ('../includes/adminSidebar.php');

    $ticketsTodaySQL = "SELECT ticket_id FROM ticket 
                        WHERE (date_created BETWEEN CONCAT(CURDATE(), ' 00:00:00') AND CONCAT(CURDATE(), ' 23:59:59'))";
    $ticketsTodayResult = mysqli_query($con, $ticketsTodaySQL);
    $ticketsTodayCount = mysqli_num_rows($ticketsTodayResult);


    $pendingTicketsSQL = "SELECT ticket_id FROM ticket WHERE status='0'";
    $pendingTicketResult = mysqli_query($con, $pendingTicketsSQL);
    $pendingTicketCount = mysqli_num_rows($pendingTicketResult);

    $closedTicketsSQL = "SELECT ticket_id FROM ticket WHERE status='1'";
    $closedTicketResult = mysqli_query($con, $closedTicketsSQL);
    $closedTicketCount = mysqli_num_rows($closedTicketResult);

    $allTicketsSQL = "SELECT ticket_id FROM ticket";
    $allTicketResult = mysqli_query($con, $allTicketsSQL);
    $allTicketCount = mysqli_num_rows($allTicketResult);

    $allUserSQL = "SELECT user_id FROM user WHERE approved='1'";
    $allUserResult = mysqli_query($con, $allUserSQL);
    $allUserCount = mysqli_num_rows($allUserResult);


    
    $urgentPrioritySQL = "SELECT ticket_id FROM ticket WHERE priority=3 AND status=0";
    $urgentPriorityResult = mysqli_query($con, $urgentPrioritySQL);
    $urgentPriorityCount = mysqli_num_rows($urgentPriorityResult);

    $highPrioritySQL = "SELECT ticket_id FROM ticket WHERE priority=2 AND status=0";
    $highPriorityResult = mysqli_query($con, $highPrioritySQL);
    $highPriorityCount = mysqli_num_rows($highPriorityResult);

    $moderatePrioritySQL = "SELECT ticket_id FROM ticket WHERE priority=1 AND status=0";
    $moderatePriorityResult = mysqli_query($con, $moderatePrioritySQL);
    $moderatePriorityCount = mysqli_num_rows($moderatePriorityResult);

    $lowPrioritySQL = "SELECT ticket_id FROM ticket WHERE priority=0 AND status=0";
    $lowPriorityResult = mysqli_query($con, $lowPrioritySQL);
    $lowPriorityCount = mysqli_num_rows($lowPriorityResult);
?>
        
        
        <div class="container-fluid px-4">

            <!----------------------------------------- TICKETS/USERS ROW----------------------------------------->
            <h2>Dashboard</h2>
            <div class="row g-3 my-2 col-sm col-md col-lg">
                <div class="col col-sm col-md col-lg">
                    <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <h3><?php echo $ticketsTodayCount; ?></h3>
                            <p>Today</p>
                        </div>
                        <i class="fa-solid fa-calendar-check fa-4x"></i>
                    </div>
                </div>
                
                <div class="col col-sm col-md col-lg">
                    <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <h3><?php echo $pendingTicketCount; ?></h3>
                            <p>Pending</p>
                        </div>
                        <i class="fa-solid fa-envelope-open fa-4x"></i>
                    </div>
                </div>

                <div class="col col-sm col-md col-lg">
                    <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <h3><?php echo $closedTicketCount; ?></h3>
                            <p>Closed</p>
                        </div>
                        <i class="fa-solid fa-envelope fa-4x"></i>
                    </div>
                </div>

                <div class="col col-sm col-md col-lg">
                    <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <h3><?php echo $allTicketCount; ?></h3>
                            <p>Total</p>
                        </div>
                        <i class="fa-solid fa-envelopes-bulk fa-4x"></i>
                    </div>
                </div>

                <div class="col col-sm col-md col-lg">
                    <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <h3><?php echo $allUserCount; ?></h3>
                            <p>Users</p>
                        </div>
                        <i class="fa-solid fa-users fa-4x"></i>
                    </div>
                </div>
            </div>
            
            <!---------------------------------------- PRIORITY ROW------------------------------------>
            <h2>Priorities</h2>
            <div class="row g-3 my-2 col-sm col-md col-lg">
                <div class="col col-sm col-md col-lg">
                    <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <h3><?php echo $urgentPriorityCount; ?></h3>
                            <p>Urgent</p>
                        </div>
                        <i class="fa-solid fa-circle-exclamation fa-4x text-danger"></i>
                    </div>
                </div>
                
                <div class="col col-sm col-md col-lg">
                    <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <h3><?php echo $highPriorityCount; ?></h3>
                            <p>High</p>
                        </div>
                        <i class="fa-solid fa-circle-exclamation fa-4x text-warning"></i>
                    </div>
                </div>

                <div class="col col-sm col-md col-lg">
                    <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <h3><?php echo $moderatePriorityCount; ?></h3>
                            <p>Moderate</p>
                        </div>
                        <i class="fa-solid fa-circle-exclamation fa-4x text-success"></i>
                    </div>
                </div>

                <div class="col col-sm col-md col-lg">
                    <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <h3><?php echo $lowPriorityCount; ?></h3>
                            <p>Low</p>
                        </div>
                        <i class="fa-solid fa-circle-exclamation fa-4x text-primary"></i>
                    </div>
                </div>
                
            </div>
            
            <!---------------------------------------- PRIORITY ROW END------------------------------------>

            <!---------------------------------------- TICKETS ASSIGNED ROW------------------------------------>
            
            
            <div class="row my-4">
            <h2>Assignments</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Personnel</th>
                        <th scope="col">Total Pending </th>
                        <th scope="col">Urgent </th>
                        <th scope="col">High </th>
                        <th scope="col">Moderate </th>
                        <th scope="col">Low </th>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php 
                            $sql2 = "SELECT concat(last_name,', ',first_name,' ', middle_name) AS full_name,user_id 
                                    FROM user 
                                    WHERE (account_type=1 OR account_type=2) AND approved=1";
                            $result2 = mysqli_query($con, $sql2);
                            $resultCheck2 = mysqli_num_rows($result2);
                            
                            if($resultCheck2 != 0)
                            {
                                while($row2 = mysqli_fetch_assoc($result2))
                                {
                                    $full_name = $row2['full_name'];
                                    $user_id = $row2['user_id'];

                                    $sql3="SELECT assigned_to 
                                        FROM ticket 
                                        WHERE assigned_to=$user_id AND status=0";
                                        $result3 = mysqli_query($con, $sql3);
                                        $ticketsCounter = mysqli_num_rows($result3);
                                    ?>

                                    <tr>
                                        <th><?php echo $full_name;?></th>
                                        <!-- <td></td> -->
                                        <td><?php echo $ticketsCounter;?></td>
                                        <td><?php getTicketPrioritiesCounter($user_id, 3)?></td>
                                        <td><?php getTicketPrioritiesCounter($user_id, 2)?></td>
                                        <td><?php getTicketPrioritiesCounter($user_id, 1)?></td>
                                        <td><?php getTicketPrioritiesCounter($user_id, 0)?></td>
                                    </tr>

                                    <?php
                                }
                            }
                        ?>
                    
                </tbody>
            </table>
                
            </div>
            
            <!---------------------------------------- TICKETS ASSIGNED  ROW END------------------------------------>

            <div class="row my-2">
                <h2>Recent Tickets</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Ticket ID</th>
                            <th scope="col">Date Created </th>
                            <th scope="col">Subject </th>
                            <th scope="col">Company </th>
                            <th scope="col">Department </th>
                            <th scope="col">Name </th>
                            <th scope="col">Priority </th>
                            <th scope="col">Status </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $sql = "SELECT 
                                    a.ticket_id, a.date_created, a.status, a.subject, a.priority,
                                    b.first_name, b.last_name,
                                    c.department_name,
                                    d.company_name
                                    FROM 
                                    ticket a
                                    INNER JOIN user b ON a.user_id=b.user_id
                                    INNER JOIN department c ON a.department_id=c.department_id
                                    INNER JOIN company d ON a.company_id=d.company_id
                                    ORDER BY a.priority DESC, a.date_created DESC
                                    LIMIT 10";
                            $result = mysqli_query($con, $sql);
                            $resultCheck = mysqli_num_rows($result);
                            $counter = 0;
                        
                            if($resultCheck > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $ticket_id = $row['ticket_id'];
                                    $dateCreated = $row['date_created'];
                                    $subject = $row['subject'];
                                    $companyName = $row['company_name'];
                                    $departmentName = $row['department_name'];
                                    $firstName = $row['first_name'];
                                    $lastName = $row['last_name'];
                                    $priority = $row['priority'];
                                    $status = $row['status'] == 0 ? "Pending":"Closed";
                                    $counter++;
                                    
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $counter;?></th>
                                            <td><?php echo $dateCreated;?></td>
                                            <td><?php echo $subject;?></td>
                                            <td><?php echo $companyName;?></td>
                                            <td><?php echo $departmentName;?></td>
                                            <td><?php echo $firstName." ".$lastName;?></td>
                                            <td><?php setPriorityName($priority);?></td>
                                            <td><?php echo $status;?></td>
                                        </tr>
                                    <?php
                                }
                            }
                            else{
                                ?>
                                    <tr>
                                        <td><?php echo "No Tickets Available"; ?></td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

<?php 
    include('../Includes/adminFooter.php')
?>