<?php
    session_start();
    include('../../Includes/connection.php');
    include('../../cls_global_functions.php');
    date_default_timezone_set('Asia/Manila');
    $current_id = $_SESSION['user_id'];

        if(isset($_POST['addNewEmployee'])){

            $firstname = $_POST['first_name'];
            $lastname = $_POST['last_name'];
            $company = $_POST['company_id'];
            $department = $_POST['department_id'];
            $telLocal = $_POST['tel_local_id'] == ""? 0 : $_POST['tel_local_id'];
            $date_created = date('Y-m-d H:i:s');
            $status = 1;
            // INSERTING NEW EMPLOYEE
            $sqlEmployee = "INSERT INTO employee (firstname, lastname, date_created, company_id, department_id, tel_local_id, status, user_id)
                    VALUES('$firstname', '$lastname', '$date_created', '$company', '$department', '$telLocal', '$status', '$current_id');";
            $add = mysqli_query($con, $sqlEmployee);

            if($add == true && $telLocal != "")
            {
              // UPDATING THE STATUS OF A LOCAL TELEPHONE DIRECTORY CHOSEN
                $sqlTelLocal = "UPDATE tel_local_directory SET status = 1 WHERE tel_local_id = $telLocal;";
                $add = mysqli_query($con, $sqlTelLocal);
                //MESSAGE FOR SUCCESSFULLY ADDING EMPLOYEE WITH LOCAL TELEPHONE
                $_SESSION['add_employee'] = "<div class='alert alert-success' role='alert'>
                                        Employee added successfully.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/employee.php');
            }
            elseif ($add == true) {
              //MESSAGE FOR SUCCESSFULLY ADDING EMPLOYEE
              $_SESSION['add_employee'] = "<div class='alert alert-success' role='alert'>
                                      Employee added successfully.
                                      </div>";
              header('location:'.$siteURL.'Admin_side/employee.php');
            }
            else
            {
              //MESSAGE FOR FAILED ADDING EMPLOYEE WITH LOCAL TELEPHONE
                $_SESSION['add_employee'] = "<div class='alert alert-danger' role='alert'>
                                        Failed to add Employee.
                                        </div>";
                header('location:'.$siteURL.'Admin_side/employee.php');
            }
        }
