<?php 

include('../Includes/connection.php');
include('cls_constant.php');
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');

        $ticket_id=$_GET['ticket_id'];
        
        $sql = "SELECT a.user_id, a.message, a.message_date,a.td_id,
        concat(b.last_name,', ', b.first_name,' ', b.middle_name,'.') as full_name
        FROM ticket_message a
        INNER JOIN user b ON a.user_id=b.user_id
        WHERE ticket_id=$ticket_id
        ORDER BY message_id DESC";

        $result = mysqli_query($con, $sql);
        $rowCount = mysqli_num_rows($result);
        if($rowCount != 0)
        {
            while($resultRow = mysqli_fetch_assoc($result))
            {
                $m_td_id=$resultRow['td_id'];
                $messageLogs = $resultRow['message'];
                $sender_name = $resultRow['full_name'];
                $date = $resultRow['message_date'];

                        $documentSql="SELECT td_id, doc_directory, concat(doc_name,'.',doc_type) as file_name
                        FROM ticket_document 
                        WHERE ticket_id = $ticket_id AND td_id = $m_td_id";
                        $documentResult = mysqli_query($con, $documentSql);
                        $documentRowCount = mysqli_num_rows($documentResult);
                        if($documentRowCount !=0)
                        {
                            while($documentRow = mysqli_fetch_assoc($documentResult))
                            {
                                $td_id = $documentRow['td_id'];
                                $file_name = $documentRow['file_name'];
                                // ($file_name = $documentRow['file_name'] == 0 ? $file_name="": $file_name = $documentRow['file_name']);
                                $doc_directory = $documentRow['doc_directory'];
                                $downloadDirectory = systemDirectories::downloadDirectory.$doc_directory;
                            }
                        }
                ?>
                    <ul class="list-group list-unstyled">
                        <li class="my-1 col-7" id="border">
                            <div class="d-flex justify-content-between">
                                <h4><?php echo $sender_name;?></h4>
                                <p><i><?php echo $date;?></i></p>
                            </div>
                            <ul>
                                <li class="list-unstyled"><?php echo $messageLogs;?>
                                    <?php 
                                        if($m_td_id ==0)
                                        {
                                        }
                                        else
                                        {
                                            ?>
                                            <a href="<?php echo $downloadDirectory;?>" download style="color: blue; text-decoration: underline blue;">
                                            <?php echo $file_name;?>
                                            </a>
                                            <?php 
                                        }
                                    ?>
                                </li>
                            </ul>
                        </li>
                    </ul>
                <?php
            }
        }


        