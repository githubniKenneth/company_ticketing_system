<?php
    session_start();
    include ('../includes/adminSidebar.php');



    $ticket_id = $_GET['id'];

    $sql = "SELECT 
            a.subject, a.ticket_description, a.date_created, a.status, a.message, a.priority, a.assigned_to,
            concat(b.last_name,', ',b.first_name ,' ',b.middle_name,'.') as full_name, b.user_id
            FROM 
            ticket a 
            INNER JOIN user b ON a.user_id=b.user_id
            WHERE ticket_id=$ticket_id";
    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);
    $counter = 0;
    if($resultCheck > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $documentSql="SELECT doc_directory, concat(doc_name,'.',doc_type) as file_name
                FROM ticket_document 
                WHERE ticket_id = $ticket_id";
            $documentResult = mysqli_query($con, $documentSql);
            $documentRowCount = mysqli_num_rows($documentResult);
            if($documentRowCount !=0)
            {
                while($documentRow = mysqli_fetch_assoc($documentResult))
                {
                    $file_name = $documentRow['file_name'];
                    $doc_directory = $documentRow['doc_directory']; 
                    $downloadDirectory = systemDirectories::downloadDirectory.$doc_directory;
                }
            }

            $dateCreated = $row['date_created'];
            $subject = $row['subject'];
            $full_name = $row['full_name'];
            $ticketDescription = $row['ticket_description'];
            $message = $row['message'];
            // $file = $row['file_uploaded'];
            $status = $row['status'] == 0 ? "Pending":"Closed";
            $priority = $row['priority'];
            $assigned_to = $row['assigned_to'];
        }
    }
    $date = date('Y-m-d H:i:s');
    // echo $date;
?>
            <h2 class="mt-5 col-7"><?php echo $subject; ?></h2>
            <p class="text-dark col-7"><?php echo $dateCreated; ?></p>
            <p class="text-dark col-7"><?php echo $ticketDescription; ?></p>
            <div class="container-fluid">
                <ul class="list-group list-unstyled" id="ul_data">
                    
                    <script src="../js/message_receive.js">
                        // auto receive and load messages
                    </script>
                    
                </ul>
                <ul class="list-group list-unstyled">
                    <li class="my-1 col-7" id="border">
                        <div class="d-flex justify-content-between">
                            <h4><?php echo $full_name;?></h4>
                            <p><i><?php echo $dateCreated;?></i></p>
                        </div>
                        <ul>
                            <li class="list-unstyled"><?php echo $message; 
                                        if($documentRowCount != 0)
                                        {?>
                                    <a href="<?php echo $downloadDirectory;?>" download style="color: blue; text-decoration: underline blue;"
                                    ><?php echo $file_name;?>
                                    </a>
                                <?php   }?>
                            </li>
                        </ul>
                    </li>
                </ul>

                <form class="form-container my-3" method="POST" id="add_message" enctype="multipart/form-data">
                <div class="form-group" >
                    <label for="">Attach file if needed</label>
                    <input type="file" name="file" class="form-control-file">
                    <input type="hidden" name="user_id" value="<?php echo $current_id; ?>">
                </div>
                <div class="form-group">
                    <!-- <label for="">Send a reply</label><br> -->
                    <textarea name="message" id="message" cols="50" rows="3" placeholder="Enter your message here" class="form-control col-4"></textarea><br> 
                </div>
                
                <input type="hidden" name="ticket_date_created" value="<?php echo $dateCreated; ?>">
                <input type="hidden" name="ticket_id" id="ticket_id" value="<?php echo $ticket_id;?>">
                <input type="hidden" name="current_user_id" value="<?php echo $current_id;?>">
                <input type="hidden" name="current_full_name" value="<?php echo $current_full_name;?>">
                <input type="submit" id="send" name="send" class="btn btn-primary" value="Send">
            </form>
            </div>
            
    
    <?php
    include ('../includes/adminFooter.php')
    ?>

    <script>
        $(document).ready(function(){
            $("#add_message").on("submit", function(event){
                event.preventDefault(event);
                var form_data = new FormData(this);
                $.ajax({
                    url:"action_button/send-message.php",
                    method:"POST",
                    data:form_data,
                    dataType:"json",
                    processData:false,
                    contentType:false,
                    
                    success:function(data){
                    
                        if(data.file)
                        {
                            var html = '<li class="my-1 col-7" id="border">';
                            html +=     '<div class="d-flex justify-content-between">';
                            html +=        '<h4>'+data.current_full_name+'</h4>';
                            html +=        '<p><i>'+data.current_date+'</i></p>';
                            html +=     '</div>';
                            html +=     '<ul>';
                            html +=        '<li class="list-unstyled">'+data.message+'<a href="'+data.download_directory+'"';
                            html +=          'style="color: blue; text-decoration: underline blue;" download';
                            html +=                '>'+data.file+'</a></li>';
                            html +=     '</ul>';
                            html +=    '</li>';
                        }
                        else
                        {
                        var html = '<li class="my-1 col-7" id="border">';
                        html +=     '<div class="d-flex justify-content-between">';
                        html +=        '<h4>'+data.current_full_name+'</h4>';
                        html +=        '<p><i>'+data.current_date+'</i></p>';
                        html +=     '</div>';
                        html +=     '<ul>';
                        html +=        '<li class="list-unstyled">'+data.message+'</li>';
                        html +=     '</ul>';
                        html +=    '</li>';
                        }
                        $('#ul_data').prepend(html);
                        $('#add_message')[0].reset();
                        
                    }
                });
            });
        });
    </script>

    <!-- <script>
        setTimeout(function(){
            window.location.reload();
        }, 10000);
    </script> -->