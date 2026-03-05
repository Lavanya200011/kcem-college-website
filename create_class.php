<?php
include 'includes/db.php';

$success="";
$error="";

if(isset($_POST['create'])){

$department=$_POST['department'];
$section=$_POST['section'];
$subject=$_POST['subject'];
$teacher=$_POST['teacher'];

$sql="INSERT INTO classes(department,section,subject,teacher)
VALUES('$department','$section','$subject','$teacher')";

if($conn->query($sql)){
$success="Class created successfully!";
}else{
$error="Error creating class";
}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Create Class | KCEM Smart Campus</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

<!-- Sidebar -->
<aside class="w-64 bg-white shadow-lg">

<div class="p-6 border-b">
<h2 class="text-xl font-bold text-green-600">Faculty Portal</h2>
</div>

<nav class="p-4 space-y-3">

<a href="dashboard_teacher.php" class="block p-2 rounded hover:bg-green-100">
🏠 Dashboard
</a>

<a href="create_class.php" class="block p-2 rounded bg-green-100 font-semibold">
📚 Create Class
</a>

<a href="mark_attendance.php" class="block p-2 rounded hover:bg-green-100">
✅ Mark Attendance
</a>

<a href="attendance_report.php" class="block p-2 rounded hover:bg-green-100">
📊 Reports
</a>

<a href="announcements.php" class="block p-2 rounded hover:bg-green-100">
📢 Announcements
</a>

<a href="logout.php" class="block p-2 rounded text-red-600 hover:bg-red-100">
🚪 Logout
</a>

</nav>

</aside>

<!-- Main Content -->

<main class="flex-1">

<header class="bg-white shadow p-4">
<h1 class="text-2xl font-bold text-gray-700">
Create New Class
</h1>
</header>

<section class="p-6">

<div class="bg-white shadow rounded-lg p-6 max-w-lg">

<h2 class="text-lg font-semibold mb-4">
Create Class
</h2>

<?php if($success!=""){ ?>
<div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
<?php echo $success ?>
</div>
<?php } ?>

<?php if($error!=""){ ?>
<div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
<?php echo $error ?>
</div>
<?php } ?>

<form method="post" class="space-y-4">

<div>
<label class="block text-sm font-medium">Department</label>

<select name="department"
class="w-full border rounded p-2">

<option value="CSE">Computer Science</option>
<option value="AI">Artificial Intelligence</option>
<option value="EE">Electrical</option>
<option value="CE">Civil</option>

</select>
</div>


<div>
<label class="block text-sm font-medium">Section</label>

<select name="section"
class="w-full border rounded p-2">

<option value="A">Section A</option>
<option value="B">Section B</option>

</select>

</div>


<div>
<label class="block text-sm font-medium">Subject</label>

<input 
type="text"
name="subject"
required
placeholder="Enter Subject Name"
class="w-full border rounded p-2">

</div>


<div>
<label class="block text-sm font-medium">Teacher Name</label>

<input 
type="text"
name="teacher"
required
placeholder="Enter Teacher Name"
class="w-full border rounded p-2">

</div>


<button 
name="create"
class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">

Create Class

</button>

</form>

</div>

</section>

</main>

</div>

</body>
</html>