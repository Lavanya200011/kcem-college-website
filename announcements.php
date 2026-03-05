<?php
include 'includes/db.php';

if(isset($_POST['post'])){
$msg=$_POST['message'];

$conn->query("INSERT INTO announcements(message) VALUES('$msg')");
}

$res=$conn->query("SELECT * FROM announcements ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Announcements | KCEM Smart Campus</title>
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

<a href="create_class.php" class="block p-2 rounded hover:bg-green-100">
📚 Create Class
</a>

<a href="mark_attendance.php" class="block p-2 rounded hover:bg-green-100">
✅ Mark Attendance
</a>

<a href="attendance_report.php" class="block p-2 rounded hover:bg-green-100">
📊 Reports
</a>

<a href="announcements.php" class="block p-2 rounded bg-green-100 font-semibold">
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
<h1 class="text-2xl font-bold text-gray-700">Announcements</h1>
</header>

<section class="p-6">

<!-- Announcement Form -->
<div class="bg-white shadow rounded-lg p-6 mb-8">

<h2 class="text-lg font-semibold mb-4">
Post New Announcement
</h2>

<form method="post">

<textarea 
name="message"
required
placeholder="Write announcement..."
class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-green-500"
rows="4"></textarea>

<button 
name="post"
class="mt-4 bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
Post Announcement
</button>

</form>

</div>


<!-- Announcement List -->
<div>

<h2 class="text-xl font-semibold mb-4">
Latest Announcements
</h2>

<div class="space-y-4">

<?php
while($row=$res->fetch_assoc()){
?>

<div class="bg-white shadow p-4 rounded-lg border-l-4 border-green-600">

<p class="text-gray-800">
<?php echo htmlspecialchars($row['message']); ?>
</p>

<p class="text-sm text-gray-500 mt-2">
Posted on <?php echo $row['created_at'] ?? 'Recent'; ?>
</p>

</div>

<?php
}
?>

</div>

</div>

</section>

</main>

</div>

</body>
</html>