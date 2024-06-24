<?php

// add-ticket.php
function getNewTicketId($ticketYear)
{
    include('Includes/connection.php');
    $ticket_number = 0;
    $sql="SELECT ticket_number FROM ticket WHERE ticket_year=$ticketYear ORDER BY ticket_number DESC LIMIT 1";
        $result = mysqli_query($con, $sql);
        $resultCount = mysqli_num_rows($result);
        if($resultCount == 0)
        {
            $ticket_number=1;
        }
        else
        {
            $row = mysqli_fetch_assoc($result);
            $ticket_number=intval($row['ticket_number'])+1;

        }
        return $ticket_number;
}

// ticket tables
function ticketNumberLengthCheck($ticket_number)
{
    $lengthCheck = strlen($ticket_number);
    // echo $lengthCheck;
    if($lengthCheck == 1)
    {
        echo "0000".$ticket_number;
    }
    elseif($lengthCheck == 2)
    {
        echo "000".$ticket_number;
    }
    elseif($lengthCheck == 3)
    {
        echo "00".$ticket_number;
    }
    elseif($lengthCheck == 4)
    {
        echo "0".$ticket_number;
    }
    else
    {
        echo $ticket_number;
    }
}

// edit-ticket.php
function setPriorityName($priority)
{
    switch ($priority) {
        case '0':
            echo "Low";
            break;

        case '1':
            echo "Moderate";
            break;

        case '2':
            echo "High";
            break;

        case '3':
            echo "Urgent";
            break;
    }
}

// add-ticket.php
function getPrimaryId($table)
{
    include('Includes/connection.php');

    switch ($table) {
        case 'ticket':
            $sql = "SELECT ticket_id
            FROM ticket
            ORDER BY ticket_id DESC
            LIMIT 1";
            $result = mysqli_query($con, $sql);
            $resultCount = mysqli_num_rows($result);
            if($resultCount == 0)
            {
                $ticket_id=1;
            }
            else
            {
                $row = mysqli_fetch_assoc($result);
                $ticket_id=intval($row['ticket_id'])+1;

            }
            return $ticket_id;
            break;

        case 'ticket_document':
            $sql1 = "SELECT td_id
            FROM ticket_document
            ORDER BY td_id  DESC
            LIMIT 1";
            $result1 = mysqli_query($con, $sql1);
            $resultCount1 = mysqli_num_rows($result1);
            if($resultCount1 == 0)
            {
                $td_id=1;
            }
            else
            {
                $row1 = mysqli_fetch_assoc($result1);
                $td_id=intval($row1['td_id'])+1;

            }
            return $td_id;
            break;
    }
}

    // closedTickets.php
function setFullName($user_id)
{
    include('Includes/connection.php');
    $sql="SELECT concat(last_name,', ',first_name,' ', middle_name) AS full_name
            FROM user
            WHERE user_id=$user_id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    echo $full_name = $row['full_name'];
}


    // edit-ticket.php // 2 add-tickets
function getItAndAdminList($ticket_id)
{
    include('Includes/connection.php');
    $sql="SELECT concat(last_name,', ',first_name,' ', middle_name) AS full_name, user_id
            FROM user
            WHERE (account_type=1 OR account_type=2) AND approved=1";
    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);



    switch ($ticket_id) {
        case 0:
            if($resultCheck != 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $full_name = $row['full_name'];
                    $user_id = $row['user_id'];
                        ?>
                        <option value="<?php echo $user_id; ?>"><?php echo $full_name;?></option>
                        <?php
                }
            }
            break;

        default:
        if($resultCheck != 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $full_name = $row['full_name'];
                $user_id = $row['user_id'];

                $sql2 = "SELECT assigned_to FROM ticket WHERE ticket_id=$ticket_id LIMIT 1"; // get assigned_to  user_id
                $result2 = mysqli_query($con, $sql2);
                $resultCheck2 = mysqli_num_rows($result2);
                if($resultCheck2 != 0)
                {
                    $row2 = mysqli_fetch_assoc($result2);
                    $assigned_to = $row2['assigned_to'];
                        ?>
                        <option value="<?php echo $user_id; ?>" <?php if ($user_id == $assigned_to) echo 'selected="selected"';?>><?php echo $full_name;?></option>
                        <?php
                }
            }
        }
            break;
    }

}

function getTicketPrioritiesCounter($user_id, $priority)
{
    include('Includes/connection.php');
    switch ($priority) {
        case 0:
            $lowPrioritySql ="SELECT assigned_to
                            FROM ticket
                            WHERE assigned_to=$user_id AND status= 0 AND priority=$priority";
            $lowPriorityresult = mysqli_query($con, $lowPrioritySql);
            $lowPriorityCounter = mysqli_num_rows($lowPriorityresult);
            echo $lowPriorityCounter;
            break;

        case 1:
            $moderatePrioritySql ="SELECT assigned_to
                            FROM ticket
                            WHERE assigned_to=$user_id AND status= 0 AND priority=$priority";
            $moderatePriorityresult = mysqli_query($con, $moderatePrioritySql);
            $moderatePriorityCounter = mysqli_num_rows($moderatePriorityresult);
            echo $moderatePriorityCounter;
            break;

        case 2:
            $highPrioritySql ="SELECT assigned_to
                            FROM ticket
                            WHERE assigned_to=$user_id AND status= 0 AND priority=$priority";
            $highPriorityresult = mysqli_query($con, $highPrioritySql);
            $highPriorityCounter = mysqli_num_rows($highPriorityresult);
            echo $highPriorityCounter;
            break;

        case 3:
            $urgentPrioritySql ="SELECT assigned_to
                            FROM ticket
                            WHERE assigned_to=$user_id AND status= 0 AND priority=$priority";
            $urgentPriorityresult = mysqli_query($con, $urgentPrioritySql);
            $urgentPriorityCounter = mysqli_num_rows($urgentPriorityresult);
            echo $urgentPriorityCounter;
            break;
    }
}

function seeLessOrMoreText($texts, $id)
{

    $lengthCounter = strlen($texts);

    if($lengthCounter > 10)
    {
        $see_less = substr($texts, 0, 10);
        $see_more = $texts;

        ?>
            <span id="see_more_<?php echo $id ?>">
                <?php echo $see_less."..." ?> <a onclick="myFunction(<?php echo $id ?>)" id="seeText" >More</a> <?php ;?>
            </span>

            <span id="see_less_<?php echo $id ?>" style="display: none">
                <?php echo $see_more ?> <a onclick="myFunction(<?php echo $id ?>)" id="seeText" >Less</a> <?php ;?>
            </span>
        <?php
    }
    else
    {
        echo $texts;
    }

    ?>
        <script>
            function myFunction($id){
                var btnText = document.getElementById("seeText");
                var moreText = document.getElementById("see_more_" + $id);
                var lessText = document.getElementById("see_less_" + $id);
                if (lessText.style.display === "none")
                {
                    lessText.style.display = "inline";
                    moreText.style.display = "none";
                }
                else
                {
                    lessText.style.display = "none";
                    moreText.style.display = "inline";
                }
            }
        </script>
    <?php
}
// IT ASSET .PHP
