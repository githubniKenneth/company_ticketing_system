<?php
    

    function accessPermission($whatRestriction, $user_id, $sa_id)
    {
        include('../Includes/connection.php');
        switch ($whatRestriction) 
        {
            case 'sa_view':
                $accessPermissionSql ="SELECT sa_view as accessPermission
                                    FROM user_access_rights
                                    WHERE user_id=$user_id AND sa_id=$sa_id
                                    LIMIT 1";
                break;
            
            case "sa_edit":
                $accessPermissionSql ="SELECT sa_edit as accessPermission
                                    FROM user_access_rights
                                    WHERE user_id=$user_id AND sa_id=$sa_id
                                    LIMIT 1";
                break;

            case 'sa_add':
                $accessPermissionSql ="SELECT sa_add as accessPermission
                                    FROM user_access_rights
                                    WHERE user_id=$user_id AND sa_id=$sa_id
                                    LIMIT 1";
                break;
            
            case 'sa_delete':
                $accessPermissionSql ="SELECT sa_delete as accessPermission
                                        FROM user_access_rights
                                        WHERE user_id=$user_id AND sa_id=$sa_id
                                        LIMIT 1";
                break;

            case 'sa_access':
                $accessPermissionSql ="SELECT sa_access as accessPermission
                                        FROM user_access_rights
                                        WHERE user_id=$user_id AND sa_id=$sa_id
                                        LIMIT 1";
                break;
        }
            $accessPermissionRunSql = mysqli_query($con, $accessPermissionSql);
            $accessPermissionNumRows = mysqli_num_rows($accessPermissionRunSql);

            if($accessPermissionNumRows > 0)
            {
                $accessPermissionRows = mysqli_fetch_assoc($accessPermissionRunSql);
                $accessPermission = $accessPermissionRows['accessPermission'];
                
            }
            
            if($whatRestriction == "sa_access") // for pages
            {
                switch ($sa_id) {
                    case 1:
                        echo ($accessPermission==1)? "tickets.php":"index.php";
                        break;
                    case 2:
                        echo ($accessPermission==1)? "pendingTickets.php":"index.php";
                        break;
                    case 3:
                        echo ($accessPermission==1)? "closedTickets.php":"index.php";
                        break;
                    case 4:
                        echo ($accessPermission==1)? "department.php":"index.php";
                        break;
                    case 5:
                        echo ($accessPermission==1)? "company.php":"index.php";
                        break;
                    case 7:
                        echo ($accessPermission==1)? "users.php":"index.php";
                        break;
                    case 8:
                        echo ($accessPermission==1)? "pendingAccounts.php":"index.php";
                        break;
                    case 19:
                        echo ($accessPermission==1)? "system-applications.php":"index.php";
                        break;
                    case 20:
                        echo ($accessPermission==1)? "access-rights.php":"index.php";
                        break;
                }
            }
            else
            {
                echo ($accessPermission == 1)? "":"disabled"; // for buttons
            }
    }
    
    function accessPermissions($whatRestriction, $user_id, $sa_id)
    {
        include('../../Includes/connection.php');
        switch ($whatRestriction) 
        {
            case 'sa_view':
                $accessPermissionSql ="SELECT sa_view as accessPermission
                                    FROM user_access_rights
                                    WHERE user_id=$user_id AND sa_id=$sa_id
                                    LIMIT 1";
                break;
            
            case "sa_edit":
                $accessPermissionSql ="SELECT sa_edit as accessPermission
                                    FROM user_access_rights
                                    WHERE user_id=$user_id AND sa_id=$sa_id
                                    LIMIT 1";
                break;

            case 'sa_add':
                $accessPermissionSql ="SELECT sa_add as accessPermission
                                    FROM user_access_rights
                                    WHERE user_id=$user_id AND sa_id=$sa_id
                                    LIMIT 1";
                break;
            
            case 'sa_delete':
                $accessPermissionSql ="SELECT sa_delete as accessPermission
                                        FROM user_access_rights
                                        WHERE user_id=$user_id AND sa_id=$sa_id
                                        LIMIT 1";
                break;

            case 'sa_access':
                $accessPermissionSql ="SELECT sa_access as accessPermission
                                        FROM user_access_rights
                                        WHERE user_id=$user_id AND sa_id=$sa_id
                                        LIMIT 1";
                break;
        }
            $accessPermissionRunSql = mysqli_query($con, $accessPermissionSql);
            $accessPermissionNumRows = mysqli_num_rows($accessPermissionRunSql);

            if($accessPermissionNumRows > 0)
            {
                $accessPermissionRows = mysqli_fetch_assoc($accessPermissionRunSql);
                $accessPermission = $accessPermissionRows['accessPermission'];
                
            }
            
            if($whatRestriction == "sa_access")
            {
                switch ($sa_id) {
                    case 1:
                        echo ($accessPermission==1)? "tickets.php":"index.php";
                        break;
                    case 2:
                        echo ($accessPermission==1)? "pendingTickets.php":"index.php";
                        break;
                    case 3:
                        echo ($accessPermission==1)? "closedTickets.php":"index.php";
                        break;
                    case 4:
                        echo ($accessPermission==1)? "department.php":"index.php";
                        break;
                    case 5:
                        echo ($accessPermission==1)? "company.php":"index.php";
                        break;
                    case 7:
                        echo ($accessPermission==1)? "users.php":"index.php";
                        break;
                    case 8:
                        echo ($accessPermission==1)? "pendingAccounts.php":"index.php";
                        break;
                }
            }
            else
            {
                echo ($accessPermission == 1)? "":"disabled";
            }
    }


    
    function checkTicketStatus($status)
    {
        if($status == 1)
        {
            echo "disabled";
        }
        else
        {
            
        }
    }

    function accountTypeLimit($isFor, $user_account_type, $account_type)
    {
        switch ($isFor) {
            case 'userRegistration':
                switch ($user_account_type) 
                {
                    case 1:
                            ?>
                                <option value="0" <?php if($account_type == 0) echo 'selected="selected"'; ?>>User</option>
                                <option value="1" <?php if($account_type == 1) echo 'selected="selected"'; ?>>IT</option>
                            <?php
                        break;
                    case 2:
                            ?>
                                <option value="0" <?php if($account_type == 0) echo 'selected="selected"'; ?>>User</option>
                                <option value="1" <?php if($account_type == 1) echo 'selected="selected"'; ?>>IT</option>
                                <option value="2" <?php if($account_type == 2) echo 'selected="selected"'; ?>>Admin</option>
                            <?php
                        break;
                }
            break;
        }
    }


?>

    