<?php
include '../includes/db.php';

$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Students</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-8 bg-gray-100">

<h1 class="text-2xl font-bold mb-4">Students</h1>

<a href="add_student.php" class="bg-blue-600 text-white px-4 py-2 rounded">
Add Student
</a>

<table class="w-full bg-white shadow mt-4">

<tr class="bg-gray-200">
<th>PRN</th>
<th>Name</th>
<th>Password</th>
<th>Semester</th>
<th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>

<tr class="border-b">

<td><?php echo $row['student_id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['password']; ?></td>
<td><?php echo $row['semester']; ?></td>

<td class="space-x-3">

<a href="reset_password.php?type=student&id=<?php echo $row['student_id']; ?>" 
class="text-blue-600 font-semibold">
Reset Password
</a>

<a href="delete_user.php?type=student&id=<?php echo $row['student_id']; ?>" 
class="text-red-600 font-semibold">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>