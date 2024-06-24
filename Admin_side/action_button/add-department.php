
<?php
    session_start();
    include('../../Includes/connection.php');
    $current_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Document</title>
</head>
    <body>
        <?php


// function getCompanyID($CompanyName){ // TARGET THE COMPANY NAME INSIDE THE ARGUEMENT
//         include('../../Includes/connection.php');
//         $companyQuery= "SELECT company_id FROM company WHERE company_name='$CompanyName'"; // SQL QUERY
//         $companyResult = mysqli_query($con, $companyQuery); // SQL RESULT
//         $companyRow = mysqli_fetch_assoc($companyResult); // FETCH THE ROW OF RESULT
//         $company_id = $companyRow['company_id']; // GET DATA FROM DATABASE
//         return $company_id;
//     }

    if(isset($_POST['addDepartmentButton'])){

        $departmentName = $_POST['departmentName'];
        $company_id = $_POST['select_company'];
        // $company = getCompanyID($_POST['companyName']);
        // echo $company;
        $current_id;
        $addDepartmentButton = $_POST['addDepartmentButton'];
        $sql2 = "INSERT INTO department(`department_name`, `company_id`,`user_id`)
                VALUES('$departmentName', '$company_id', '$current_id')";
        $addDepartment = mysqli_query($con, $sql2);

        if ($addDepartment= true)
        {
            $_SESSION['add'] = "<div class='alert alert-success' role='alert'>
                                        Company Added Successfully.
                                        </div>";
            header('location:'.$siteURL.'Admin_side/department.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='alert alert-danger' role='alert'>
                                        Adding Company Failed.
                                        </div>";
            header('location:'.$siteURL.'Admin_side/department.php');
        }
    }

    ?>

</body>
</html>
