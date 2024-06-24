<!-- PROCESS FOR SEARCH LOCAL TELEPHONE DIRECTORY -->
<?php
session_start();
include('../Includes/connection.php');

    if(isset($_POST["selectBy"])){
      $selectBy = $_POST['selectBy'];
      $input = mysqli_real_escape_string($con, $_POST['inputVal']);

      $query;

      switch ($selectBy) {
        case 'company':
        $counter = 0;
            $query  = "SELECT a.employee_id, CONCAT(firstname, ' ', lastname) AS name, b.company_name, c.department_name, d.tel_local
            FROM employee a
            INNER JOIN company b ON a.company_id = b.company_id
            INNER JOIN department c ON a.department_id = c.department_id
            INNER JOIN tel_local_directory d ON a.tel_local_id = d.tel_local_id
            WHERE company_name LIKE '%$input%';";
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_array($result)){
              $counter++;
                echo '<tr class="table-active">
                        <td> '.$counter.' </td>
                        <td class="text-uppercase"> '.$row['name'].' </td>
                        <td class="text-uppercase"> '.$row['tel_local'].' </td>
                        <td class="text-uppercase"> '.$row['company_name'].' </td>
                        <td class="text-uppercase"> '.$row['department_name'].' </td>
                      </tr>';
            }
        break;
        case 'department':
        $counter = 0;
            $query  = "SELECT a.employee_id, CONCAT(firstname, ' ', lastname) AS name, b.company_name, c.department_name, d.tel_local
            FROM employee a
            INNER JOIN company b ON a.company_id = b.company_id
            INNER JOIN department c ON a.department_id = c.department_id
            INNER JOIN tel_local_directory d ON a.tel_local_id = d.tel_local_id
            WHERE department_name LIKE '%$input%';";
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_array($result)){
              $counter++;
                echo '<tr class="table-active">
                        <td class="text-uppercase"> '.$counter.' </td>
                        <td class="text-uppercase"> '.$row['name'].' </td>
                        <td class="text-uppercase"> '.$row['tel_local'].' </td>
                        <td class="text-uppercase"> '.$row['company_name'].' </td>
                        <td class="text-uppercase"> '.$row['department_name'].' </td>
                      </tr>';
            }
        break;
        case 'tel_local_directory':
        $counter = 0;
            $query  = "SELECT a.employee_id, CONCAT(firstname, ' ', lastname) AS name, b.company_name, c.department_name, d.tel_local
            FROM employee a
            INNER JOIN company b ON a.company_id = b.company_id
            INNER JOIN department c ON a.department_id = c.department_id
            INNER JOIN tel_local_directory d ON a.tel_local_id = d.tel_local_id
            WHERE tel_local LIKE '%$input%';";
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_array($result)){
              $counter++;
                echo '<tr class="table-active">
                        <td class="text-uppercase"> '.$counter.' </td>
                        <td class="text-uppercase"> '.$row['name'].' </td>
                        <td class="text-uppercase"> '.$row['tel_local'].' </td>
                        <td class="text-uppercase"> '.$row['company_name'].' </td>
                        <td class="text-uppercase"> '.$row['department_name'].' </td>
                      </tr>';
            }
        break;
        case 'employee':
        $counter = 0;
            $query  = "SELECT a.employee_id, CONCAT(firstname, ' ', lastname) AS name, b.company_name, c.department_name, d.tel_local
            FROM employee a
            INNER JOIN company b ON a.company_id = b.company_id
            INNER JOIN department c ON a.department_id = c.department_id
            INNER JOIN tel_local_directory d ON a.tel_local_id = d.tel_local_id
            WHERE firstname LIKE '%$input%' OR lastname LIKE '%$input%';";
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_array($result)){
              $counter++;
                echo '<tr class="table-active">
                        <td class="text-uppercase"> '.$counter.' </td>
                        <td class="text-uppercase"> '.$row['name'].' </td>
                        <td class="text-uppercase"> '.$row['tel_local'].' </td>
                        <td class="text-uppercase"> '.$row['company_name'].' </td>
                        <td class="text-uppercase"> '.$row['department_name'].' </td>
                      </tr>';
            }
        break;
        default:
        $counter = 0;
        $query = "SELECT a.employee_id, CONCAT(firstname, ' ', lastname) AS name, b.company_name, c.department_name, d.tel_local
        FROM employee a
        INNER JOIN company b ON a.company_id = b.company_id
        INNER JOIN department c ON a.department_id = c.department_id
        INNER JOIN tel_local_directory d ON a.tel_local_id = d.tel_local_id;";

        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_array($result)){
          $counter++;
            echo '<tr class="table-active">
                    <td class="text-uppercase"> '.$counter.' </td>
                    <td class="text-uppercase"> '.$row['name'].' </td>
                    <td class="text-uppercase"> '.$row['tel_local'].' </td>
                    <td class="text-uppercase"> '.$row['company_name'].' </td>
                    <td class="text-uppercase"> '.$row['department_name'].' </td>
                </tr>';
        }
          break;

      }

    }
