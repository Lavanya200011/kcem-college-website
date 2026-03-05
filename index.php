<?php
session_start();
include 'includes/db.php';

// detect login states
$studentLoggedIn = isset($_SESSION['student_loggedin']) && $_SESSION['student_loggedin'] === true;
$teacherLoggedIn = isset($_SESSION['teacher_loggedin']) && $_SESSION['teacher_loggedin'] === true;
$adminLoggedIn   = isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] === true;
?>

<!DOCTYPE html>
<html>
<head>
<title>KCEM Smart Campus Portal</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-white shadow-lg sticky top-0 z-50 border-b border-gray-200">

<div class="max-w-7xl mx-auto px-4">

<div class="flex justify-between items-center py-4">

<!-- Logo -->
<div class="flex items-center space-x-3">

<img src="kcem.png" class="h-10 w-10 rounded-full border-2 border-indigo-600">

<span class="text-2xl font-extrabold bg-gradient-to-r from-indigo-600 to-blue-600 text-transparent bg-clip-text">
KCEM Smart Campus
</span>

</div>


<!-- Desktop Menu -->
<div class="hidden md:flex items-center space-x-6 text-gray-700 font-medium">

<a href="index.php" class="hover:text-indigo-600 transition">Home</a>

<a href="feedback.php" class="hover:text-indigo-600 transition">Feedback</a>

<!-- STUDENT -->
<?php if(!$studentLoggedIn): ?>

<a href="studentlogin.php"
class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow transition">
Student Login
</a>

<?php else: ?>

<a href="dashboard_student.php"
class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow transition">
Student Profile
</a>

<?php endif; ?>


<!-- TEACHER -->
<?php if(!$teacherLoggedIn): ?>

<a href="login_teacher.php"
class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg shadow transition">
Teacher Login
</a>

<?php else: ?>

<a href="dashboard_teacher.php"
class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow transition">
Teacher Panel
</a>

<?php endif; ?>


<!-- ADMIN -->
<?php if(!$adminLoggedIn): ?>

<a href="login_admin.php"
class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow transition">
Admin Login
</a>

<?php else: ?>

<a href="dashboard_admin.php"
class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow transition">
Admin Panel
</a>

<?php endif; ?>


<!-- LOGOUT -->
<?php if($teacherLoggedIn || $adminLoggedIn): ?>

<a href="logout.php"
class="bg-gray-800 hover:bg-black text-white px-4 py-2 rounded-lg shadow transition">
Logout
</a>

<?php endif; ?>

</div>


<!-- MOBILE MENU BUTTON -->
<div class="md:hidden">

<button onclick="toggleMenu()" class="text-gray-700">

<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M4 6h16M4 12h16M4 18h16"></path>
</svg>

</button>

</div>

</div>


<!-- MOBILE MENU -->
<div id="mobile-menu" class="hidden md:hidden pb-4 space-y-3">

<a href="index.php" class="block text-gray-700 hover:text-indigo-600">Home</a>

<a href="feedback.php" class="block text-gray-700 hover:text-indigo-600">Feedback</a>


<?php if(!$studentLoggedIn): ?>

<a href="studentlogin.php"
class="block bg-blue-500 text-white text-center py-2 rounded">
Student Login
</a>

<?php else: ?>

<a href="dashboard_student.php"
class="block bg-green-500 text-white text-center py-2 rounded">
Student Profile
</a>

<?php endif; ?>


<?php if(!$teacherLoggedIn): ?>

<a href="login_teacher.php"
class="block bg-indigo-500 text-white text-center py-2 rounded">
Teacher Login
</a>

<?php else: ?>

<a href="dashboard_teacher.php"
class="block bg-green-500 text-white text-center py-2 rounded">
Teacher Panel
</a>

<?php endif; ?>


<?php if(!$adminLoggedIn): ?>

<a href="login_admin.php"
class="block bg-red-500 text-white text-center py-2 rounded">
Admin Login
</a>

<?php else: ?>

<a href="dashboard_admin.php"
class="block bg-yellow-500 text-white text-center py-2 rounded">
Admin Panel
</a>

<?php endif; ?>


<?php if($teacherLoggedIn || $studentLoggedIn || $adminLoggedIn): ?>

<a href="logout.php"
class="block bg-gray-800 text-white text-center py-2 rounded">
Logout
</a>

<?php endif; ?>

</div>

</div>

</nav>


<!-- HERO SLIDESHOW -->
<section class="relative w-full h-[450px] overflow-hidden">

<div class="absolute inset-0">
<img src="kcem.png" class="w-full h-full object-cover">
</div>

<div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">

<div class="text-center text-white">
<h2 class="text-5xl font-bold">KCEM Smart Campus Portal</h2>
<p class="mt-4 text-lg">Integrated Attendance & College Management System</p>
</div>

</div>

</section>


<!-- dynamic announcement section-->
<?php
include 'includes/db.php';

$announcements = $conn->query("SELECT * FROM announcements ORDER BY id DESC");
?>

<section class="max-w-6xl mx-auto mt-16 px-6">

<h2 class="text-3xl font-bold text-center mb-8">
Latest Announcements
</h2>

<div class="bg-white shadow rounded p-6 max-h-80 overflow-y-scroll border-l-4 border-orange-500 custom-scroll">

<?php while($row = $announcements->fetch_assoc()){ ?>

<div class="mb-4 border-b pb-3">

<span class="text-sm font-semibold px-2 py-1 rounded">
</span>

<p class="text-gray-700 mt-2">
<?php echo htmlspecialchars($row['message']); ?>
</p>

</div>

<?php } ?>

</div>

</section>


<!-- INFO CARDS -->
<section class="max-w-6xl mx-auto mt-20 px-6">

<div class="grid md:grid-cols-4 gap-6 text-center">

<div class="bg-white p-6 shadow rounded">
<h3 class="text-3xl font-bold text-blue-600">480+</h3>
<p class="text-gray-600">Students</p>
</div>

<div class="bg-white p-6 shadow rounded">
<h3 class="text-3xl font-bold text-green-600">40+</h3>
<p class="text-gray-600">Faculty</p>
</div>

<div class="bg-white p-6 shadow rounded">
<h3 class="text-3xl font-bold text-purple-600">12</h3>
<p class="text-gray-600">Departments</p>
</div>

<div class="bg-white p-6 shadow rounded">
<h3 class="text-3xl font-bold text-red-600">20+</h3>
<p class="text-gray-600">Labs</p>
</div>

</div>

</section>


<!-- TIMELINE -->
<section class="max-w-5xl mx-auto mt-20 px-6">

<h2 class="text-3xl font-bold text-center mb-10">Campus Activity Timeline</h2>

<div class="space-y-8 border-l-4 border-blue-500 pl-6">

<div>
<h3 class="font-semibold">Morning Lectures</h3>
<p class="text-gray-600">9:00 AM – Regular academic sessions begin.</p>
</div>

<div>
<h3 class="font-semibold">Laboratory Sessions</h3>
<p class="text-gray-600">11:30 AM – Practical labs for engineering subjects.</p>
</div>

<div>
<h3 class="font-semibold">Student Activities</h3>
<p class="text-gray-600">2:00 PM – Workshops, clubs, and coding practice.</p>
</div>

<div>
<h3 class="font-semibold">Sports & Events</h3>
<p class="text-gray-600">4:00 PM – Physical activities and competitions.</p>
</div>

</div>

</section>


<!-- SERVICES -->
<section class="bg-white mt-20 py-16">

<div class="max-w-6xl mx-auto px-6">

<h2 class="text-3xl font-bold text-center mb-12">Campus Services</h2>

<div class="grid md:grid-cols-3 gap-8 text-center">


<div class="p-6 border rounded shadow hover:shadow-lg">
<h3 class="font-semibold text-lg">Attendance Management</h3>
<p class="text-gray-600 mt-2">
Teachers can mark attendance and generate reports easily.
</p>
</div>


<div class="p-6 border rounded shadow hover:shadow-lg">
<h3 class="font-semibold text-lg">Student Portal</h3>
<p class="text-gray-600 mt-2">
Students can check attendance and academic updates online.
</p>
</div>



<div class="p-6 border rounded shadow hover:shadow-lg">
<h3 class="font-semibold text-lg">Faculty Dashboard</h3>
<p class="text-gray-600 mt-2">
Faculty can manage classes, announcements and reports.
</p>
</div>


</div>

</div>

</section>


<!-- FOOTER -->
<footer class="bg-gray-900 text-white mt-16">

<div class="max-w-6xl mx-auto px-6 py-12 grid md:grid-cols-3 gap-8">

<div>
<h3 class="font-bold text-lg">KCEM Smart Campus</h3>
<p class="text-gray-400 mt-2">
Integrated portal for attendance management, academic activities, and campus communication.
</p>
</div>

<div>
<h3 class="font-bold text-lg">Quick Links</h3>
<ul class="mt-2 space-y-2 text-gray-400">
<li>Student Portal</li>
<li>Faculty Portal</li>
<li>Academic Calendar</li>
<li>Campus Notices</li>
</ul>
</div>

<div>
<h3 class="font-bold text-lg">Contact</h3>
<p class="text-gray-400 mt-2">
KCEM College Campus<br>
Sakoli,Bhandara, Maharashtra<br>
Email: info@kcem.edu
</p>
</div>

</div>

<div class="text-center text-gray-500 border-t border-gray-700 py-4">
© 2026 KCEM Smart Campus Portal
</div>

</footer>

</body>
</html>