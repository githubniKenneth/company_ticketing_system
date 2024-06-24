<?php
    session_start();
    include('../Includes/connection.php');
    include('../cls_global_functions.php');
    include('../Admin_side/cls_constant.php');
    if(!$_SESSION['user_id'] || $_SESSION['account_type'] != 0)
    {
        header('Location:'.$siteURL);
        unset($_SESSION);
        session_destroy();
        die;
    }

    $user_name = $_SESSION['username'];
    $current_id = $_SESSION['user_id'];
    $first_name = $_SESSION['first_name'];
    $middle_name = $_SESSION['middle_name'];
    $last_name = $_SESSION['last_name'];
    $current_full_name = $last_name.", ".$first_name." ".$middle_name;
    date_default_timezone_set('Asia/Manila');

?>
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
    <link rel="stylesheet" type="text/css" href="../js\DataTables\datatables.min.css"/>
    <script type="text/javascript" src="../js\DataTables\datatables.min.js"></script>

    <title>IT Helpdesk</title>
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
                <h3>User</h3>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="profile.php">Profile</a>
                </li>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Tickets</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="index.php">My Tickets</a>
                        </li>
                        <li>
                            <a href="pending_tickets_user.php">Pending Tickets</a>
                        </li>
                        <li>
                            <a href="closed_tickets_user.php">Closed Tickets</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
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
                            <input type="hidden" name="user_id" value="<?php echo $current_id; ?>">
                            <i class="fa-solid fa-user fa-2x"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../Includes/logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </nav>
