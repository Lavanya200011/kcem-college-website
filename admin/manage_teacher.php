<?php
include '../includes/db.php';

$result=$conn->query("SELECT * FROM teachers");
?>

<h1>Teachers</h1>

<a href="add_teacher.php">Add Teacher</a>

<table>

<tr>

<th>Name</th>
<th>Email</th>
<th>Department</th>
<th>Actions</th>

</tr>

<?php while($row=$result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['department']; ?></td>

<td>

<a href="edit_teacher.php?id=<?php echo $row['id']; ?>">Edit</a>

<a href="reset_password.php?type=teacher&id=<?php echo $row['id']; ?>">Reset</a>

<a href="delete_user.php?type=teacher&id=<?php echo $row['id']; ?>">Delete</a>

</td>

</tr>

<?php } ?>

</table>