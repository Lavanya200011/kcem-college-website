<?php
include '../includes/db.php';

$result=$conn->query("SELECT * FROM admins");
?>

<h1>Admin Accounts</h1>

<a href="add_admin.php">Create Admin</a>

<table>

<tr>

<th>Username</th>
<th>Email</th>
<th>Actions</th>

</tr>

<?php while($row=$result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['username']; ?></td>
<td><?php echo $row['email']; ?></td>

<td>

<a href="reset_password.php?type=admin&id=<?php echo $row['id']; ?>">Reset</a>

<a href="delete_user.php?type=admin&id=<?php echo $row['id']; ?>">Delete</a>

</td>

</tr>

<?php } ?>

</table>