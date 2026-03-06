<?php
include 'includes/db.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex">

<!-- Sidebar -->

<div class="w-64 bg-gray-900 text-white min-h-screen">

<h2 class="p-6 text-xl font-bold">Admin Panel</h2>

<ul class="space-y-2 px-4">

<li><a href="dashboard_admin.php">Dashboard</a></li>
<li><a href="admin/manage_student.php">Students</a></li>
<li><a href="admin/manage_teacher.php">Teachers</a></li>
<li><a href="admin/manage_admin.php">Admins</a></li>
<li><a href="logout.php">Logout</a></li>

</ul>

</div>

<!-- Content -->

<div class="p-8 flex-1">

<h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

<div class="grid grid-cols-3 gap-6">

<?php

$students=$conn->query("SELECT COUNT(*) as total FROM students")->fetch_assoc();
$teachers=$conn->query("SELECT COUNT(*) as total FROM teachers")->fetch_assoc();
$admins=$conn->query("SELECT COUNT(*) as total FROM admins")->fetch_assoc();

?>

<div class="bg-white p-6 shadow rounded">
Total Students
<h2 class="text-3xl"><?php echo $students['total']; ?></h2>
</div>

<div class="bg-white p-6 shadow rounded">
Total Teachers
<h2 class="text-3xl"><?php echo $teachers['total']; ?></h2>
</div>

<div class="bg-white p-6 shadow rounded">
Admins
<h2 class="text-3xl"><?php echo $admins['total']; ?></h2>
</div>

</div>

</div>

</div>

</body>
</html>