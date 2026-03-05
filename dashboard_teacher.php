<!DOCTYPE html>
<html>
<head>
<title>Teacher Dashboard | KCEM Smart Campus</title>
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

<a href="dashboard_teacher.php"
class="block p-2 rounded hover:bg-green-100">
🏠 Dashboard
</a>

<a href="create_class.php"
class="block p-2 rounded hover:bg-green-100">
📚 Create Class
</a>

<a href="mark_attendance.php"
class="block p-2 rounded hover:bg-green-100">
✅ Mark Attendance
</a>

<a href="attendancereport.php"
class="block p-2 rounded hover:bg-green-100">
📊 Attendance Reports
</a>

<a href="announcements.php"
class="block p-2 rounded hover:bg-green-100">
📢 Announcements
</a>

<a href="logout.php"
class="block p-2 rounded text-red-600 hover:bg-red-100">
🚪 Logout
</a>

</nav>

</aside>

<!-- Main Content -->
<main class="flex-1">

<!-- Header -->
<header class="bg-white shadow p-4 flex justify-between items-center">

<h1 class="text-2xl font-bold text-gray-700">
Teacher Dashboard
</h1>

<span class="text-gray-500">
Welcome, Faculty
</span>

 <a href="index.php" class="block text-blue-600 font-semibold hover:text-blue-700">
            Dashboard
        </a>

</header>

<!-- Dashboard Content -->
<section class="p-6">

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

<!-- Card 1 -->
<div class="bg-white p-6 shadow rounded-lg">

<h3 class="text-gray-500 text-sm">
Total Classes
</h3>

<p class="text-3xl font-bold mt-2 text-green-600">
32
</p>

</div>

<!-- Card 2 -->
<div class="bg-white p-6 shadow rounded-lg">

<h3 class="text-gray-500 text-sm">
Total Students
</h3>

<p class="text-3xl font-bold mt-2 text-blue-600">
120
</p>

</div>

<!-- Card 3 -->
<div class="bg-white p-6 shadow rounded-lg">

<h3 class="text-gray-500 text-sm">
Average Attendance
</h3>

<p class="text-3xl font-bold mt-2 text-purple-600">
85%
</p>

</div>

</div>

<!-- Quick Actions -->
<div class="mt-10">

<h2 class="text-xl font-semibold mb-4">
Quick Actions
</h2>

<div class="flex flex-wrap gap-4">

<a href="mark_attendance.php"
class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">
Mark Attendance
</a>

<a href="attendancereport.php"
class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
View Reports
</a>

<a href="announcements.php"
class="bg-purple-600 text-white px-6 py-3 rounded hover:bg-purple-700">
Post Announcement
</a>

</div>

</div>

</section>

</main>

</div>

</body>
</html>