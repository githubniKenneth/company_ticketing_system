<?php
include('connection.php');
include('../restrictions/restriction-check.php');
include('../Admin_side/cls_constant.php');
include ('../cls_global_functions.php');
    if(!$_SESSION['user_id'] || $_SESSION['account_type'] == 0)
    {
        header('Location:'.$siteURL);
        unset($_SESSION);
        session_destroy();
        die;
    }
    // $username = $_SESSION['username'];
    $current_id = $_SESSION['user_id'];
    $first_name = $_SESSION['first_name'];
    $middle_name = $_SESSION['middle_name'];
    $last_name = $_SESSION['last_name'];
    $current_account_type = $_SESSION['account_type'];
    $current_full_name = $last_name.", ".$first_name." ".$middle_name.".";

    date_default_timezone_set('Asia/Manila');
?>


        <!------------------------ SIDE BAR AND HEADER ------------------------>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>IT Helpdesk</title>
        <!------------------------ DATATABLES ------------------------>

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css"/> -->
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    -->

    <link rel="stylesheet" type="text/css" href="../js\DataTables\datatables.min.css"/>
    <script type="text/javascript" src="../js\DataTables\datatables.min.js"></script>

    <style>
        #border{
            border: 2px solid #7386D5;
            border-radius: 15px;
            }
    </style>
</head>
<body>
    <div class="wrapper">
        <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Administrator</h3>
                </div>
                <ul class="list-unstyled components">
                    <li>
                        <a href="index.php">Dashboard</a>
                    </li>

                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Ticket</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <?php
                            ?>
                            <li>
                                <a href=<?php accessPermission("sa_access", $current_id, systemApps::appNum_AllTicket);?>>
                                All
                                </a>

                            </li>
                            <li>
                                <a href=<?php accessPermission("sa_access", $current_id, systemApps::appNum_PendingTicket);?>>
                                Pending
                                </a>
                            </li>
                            <li>
                                <a href=<?php accessPermission("sa_access", $current_id, systemApps::appNum_ClosedTicket);?>>
                                Closed
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#companySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Company</a>
                        <ul class="collapse list-unstyled" id="companySubmenu">
                            <li>
                                <a href=<?php accessPermission("sa_access", $current_id, systemApps::appNum_Company);?>>
                                Company
                                </a>
                            </li>
                            <li>
                                <a href=<?php accessPermission("sa_access", $current_id, systemApps::appNum_Department);?>>
                                Department
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li>
                        <a href="#employeeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Employee</a>
                        <ul class="collapse list-unstyled" id="employeeSubmenu">
                            <li>
                                <a href="../Admin_side/employee.php"<?php //accessPermission("sa_access", $current_id, systemApps::appNum_AllUsers);?>>
                                Employee List
                                </a>
                            </li>
                            <li>
                                <a href="../Admin_side/employee-asset.php"<?php //accessPermission("sa_access", $current_id, systemApps::appNum_WaitingForApproval);?>>
                                Employee IT Asset
                                </a>
                            </li>
                        </ul>
                    </li> -->
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Manage User</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href=<?php accessPermission("sa_access", $current_id, systemApps::appNum_AllUsers);?>>
                                All
                                </a>
                            </li>
                            <li>
                                <a href=<?php accessPermission("sa_access", $current_id, systemApps::appNum_WaitingForApproval);?>>
                                Waiting For Approval
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li>
                        <a href="../Admin_side/it_asset.php" >IT Asset</a>
                        <ul class="collapse list-unstyled" id="itAssetMenu">
                            <li>
                                <a href="#">
                                External Lines
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                Local Lines
                                </a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- <li>
                        <a href="#telephoneDirectoriesMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Telephone</a>
                        <ul class="collapse list-unstyled" id="telephoneDirectoriesMenu">
                            <li>
                                <a href="../Admin_side/external_line.php">
                                External Lines
                                </a>
                            </li>
                            <li>
                                <a href="../Admin_side/local_line.php">
                                Local Lines
                                </a>
                            </li>
                        </ul>
                    </li> -->
                    <li>
                        <a href="#SystemSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Settings</a>
                        <ul class="collapse list-unstyled" id="SystemSubmenu">
                            <li>
                                <a href="<?php accessPermission("sa_access", $current_id, systemApps::appNum_SystemApplication);?>">System Applications</a>
                            </li>
                            <li>
                                <a href="<?php accessPermission("sa_access", $current_id, systemApps::appNum_UserAccessRights);?>">User Access Rights</a>
                            </li>
                        </ul>
                    </li>
                </ul>
        </nav>
        <?php
        if(isset($_SESSION['restricted']))
        {
            echo $_SESSION['restricted'];
            unset($_SESSION['restricted']);
        }
        ?>
            <!------------------------ HEADER START  ------------------------>
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fa-solid fa-bars"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <div class="dropdown">
                        <?php echo $current_full_name;?>
                        <a class="btn btn-light" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            <!-- <input type="text" value="<?php echo $current_account_type;?>"> -->
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $current_id; ?>">
                            <i class="fa-solid fa-user fa-2x"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../Includes/logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </nav>
