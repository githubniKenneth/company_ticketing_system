<?php
session_start();
include('../../Includes/connection.php');
if(isset($_POST["employeeInputVal"])){
$input = mysqli_real_escape_string($con, $_POST['employeeInputVal']);
$counter = 0;

$query = "SELECT a.employee_id,a.date_created, a.status, a.lastname, a.firstname, CONCAT(firstname, ' ', lastname) AS name, b.company_name, c.department_name, d.tel_local_id, d.tel_local
FROM employee a
INNER JOIN company b ON a.company_id = b.company_id
INNER JOIN department c ON a.department_id = c.department_id
LEFT JOIN tel_local_directory d ON a.tel_local_id = d.tel_local_id
WHERE a.lastname LIKE '%$input%' OR a.firstname  LIKE '%$input%'
OR a.date_created LIKE '%$input%' OR b.company_name  LIKE '%$input%'
OR c.department_name  LIKE '%$input%' OR d.tel_local  LIKE '%$input%'";
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)){
$employee_id = $row['employee_id'];
$date_created = $row['date_created'];
$name = $row['name'];
$tel_local = $row['tel_local'] == ""? "Not Set" : $row['tel_local'];
$company_name = $row['company_name'];
$department_name = $row['department_name'];
$tel_local_id = $row['tel_local_id'];
$status = $row['status'] == 0? "InActive" : "Active";
$counter++;
?>
<tr>
<td class="font-weight-bold"><?php echo $counter?></td>
<td><?php echo $date_created ?></td>
<td><?php echo $name ?></td>
<td><?php echo $tel_local ?></td>
<td><?php echo $company_name ?></td>
<td><?php echo $department_name ?></td>
<td><?php echo $status ?></td>
<td>
<button type="button" data-id="<?php echo $employee_id; ?>" class="editEmployee btn btn-primary">Edit</button>
<button type="button" data-id="<?php echo $employee_id; ?>" data-tel="<?php echo $tel_local_id; ?>" class="deleteEmployee btn btn-danger">Delete</button>
</td>
</tr>
<?php }
} ?>
<script src="../js/employee/edit.js"></script>
<script src="../js/employee/confirm-delete.js"></script>
