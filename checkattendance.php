<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Check Attendance</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-sky-200 min-h-screen flex flex-col">


  <!-- Header -->
<nav class="bg-white shadow-xl px-4 py-6 sticky top-0 z-50">
  <div class="max-w-7xl mx-auto flex justify-between items-center">
    
    <!-- Logo + Title -->
    <div class="flex items-center space-x-3">
      <img src="kcem.png" alt="Logo" class="h-10 w-10 rounded-full border-2 border-indigo-500">
      <span class="font-extrabold text-xl sm:text-2xl text-indigo-700 tracking-tight">
        KCEM ATTENDANCE
      </span>
    </div>

    <!-- Desktop menu (md and above) -->
    <div class="hidden md:flex items-center space-x-6 font-medium text-gray-700">
      <a href="index.php" class="text-blue-600 font-semibold hover:text-blue-700">
        Dashboard
      </a>
    </div>

    <!-- Mobile menu button (only below md) -->
    <div class="md:hidden">
      <button onclick="toggleMenu()" class="text-gray-600 hover:text-indigo-600 focus:outline-none">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>

  </div>

  <!-- Mobile Menu (below md) -->
  <div id="mobile-menu" class="md:hidden hidden mt-3 px-3 pb-4 space-y-2 bg-white rounded-xl shadow-xl">
    <a href="index.php" class="block text-blue-600 font-semibold hover:text-blue-700">
      Dashboard
    </a>
  </div>
</nav>




  <!-- Main Content -->
  <main class="flex-grow flex items-center justify-center p-6">
    <div class="bg-indigo-500 shadow-lg rounded-lg p-8 max-w-md w-full">
      <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">📅 Check Attendance</h2>

      <form method="POST" action="check_attendance.php" class="space-y-4">
        <div>
          <label class="block text-white font-semibold mb-1">Student ID</label>
          <input type="number" name="student_id" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>

        <div>
          <label class="block text-white font-semibold mb-1">Month (1-12)</label>
          <input type="number" name="month" min="1" max="12"  class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>

       <!-- <div>
          <label class="block text-gray-700 font-semibold mb-1">Semister (1-8)</label>
          <input type="number" name="Semister" min="1" max="8" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div> -->


        <div>
          <label class="block text-white font-semibold mb-1">Year (e.g., 2025)</label>
          <input type="number" name="year" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-300">
          Get Attendance
        </button>
      </form>
    </div>
  </main>

    <script type="text/javascript">
      function toggleMenu() {
  const menu = document.getElementById('mobile-menu');
  menu.classList.toggle('hidden');
}
    </script>
  </body>
    </html>
