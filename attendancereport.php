<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'includes/db.php';


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Attendance Report</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

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

        <!-- Desktop menu -->
        <div class="hidden md:flex items-center space-x-6 font-medium text-gray-700">
            <a href="index.php" class="text-blue-600 font-semibold hover:text-blue-700">
                Dashboard
            </a>
        </div>

        <!-- Mobile menu button -->
        <div class="md:hidden">
            <button onclick="toggleMenu()" class="text-gray-600 hover:text-indigo-600 focus:outline-none">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden mt-3 px-3 pb-4 space-y-2 bg-white rounded-xl shadow-xl">
        <a href="index.php" class="block text-blue-600 font-semibold hover:text-blue-700">
            Dashboard
        </a>
    </div>
</nav>

  <!-- Main Card -->
  <div class="flex items-center justify-center mt-6 mb-10">
    <div class="bg-indigo-500 p-8 rounded shadow-lg w-full max-w-lg">
      <h1 class="text-2xl font-bold mb-6 text-center text-white">
        📄 Attendance Report Filter
      </h1>

      <!-- FORM: sends data to generate_report.php -->
      <form method="POST" action="generate_report.php" class="space-y-4">

        <!-- Department -->
        <div>
          <label class="block font-semibold mb-1 text-white">Department</label>
          <select name="dept_id" id="deptSelect" required
                  class="w-full p-2 border rounded">
            <option value="">-- Select Department --</option>
            <?php
            $departments = $conn->query("SELECT * FROM departments");
            while ($row = $departments->fetch_assoc()) {
                echo "<option value='{$row['dept_id']}'>{$row['dept_name']}</option>";
            }
            ?>
          </select>
        </div>

        <!-- Section -->
        <div>
          <label class="block font-semibold mb-1 text-white">Section</label>
          <select name="section_id" id="sectionSelect" required
                  class="w-full p-2 border rounded">
            <option value="">-- Select Section --</option>
          </select>
        </div>

        <!-- Semester -->
        <div>
          <label class="block font-semibold mb-1 text-white">Semester</label>
          <select name="semester" required
                  class="w-full p-2 border rounded">
            <option value="">-- Select Semester --</option>
            <option value="1">Sem 1</option>
            <option value="2">Sem 2</option>
            <option value="3">Sem 3</option>
            <option value="4">Sem 4</option>
            <option value="5">Sem 5</option>
            <option value="6">Sem 6</option>
            <option value="7">Sem 7</option>
            <option value="8">Sem 8</option>
          </select>
        </div>

        <!-- Subject -->
        <div>
          <label class="block font-semibold mb-1 text-white">Subject</label>
          <input
            type="text"
            name="subject"
            placeholder="Enter Subject"
            required
            class="w-full p-2 border rounded"
          >
        </div>

        <!-- Month & Year -->
        <div class="flex gap-4">
          <div class="flex-1">
            <label class="block font-semibold mb-1 text-white">Month (1-12)</label>
            <input
              type="number"
              name="month"
              min="1"
              max="12"
              required
              class="w-full p-2 border rounded"
            >
          </div>
          <div class="flex-1">
            <label class="block font-semibold mb-1 text-white">Year (e.g., 2025)</label>
            <input
              type="number"
              name="year"
              required
              class="w-full p-2 border rounded"
            >
          </div>
        </div>

        <!-- Submit -->
        <button
          type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded mt-2"
        >
          Generate PDF Report
        </button>
      </form>
    </div>
  </div>

  <!-- Department → Section dynamic JS -->
  <script>
    document.getElementById('deptSelect').addEventListener('change', function () {
      const deptId = this.value;
      const sectionSelect = document.getElementById('sectionSelect');
      sectionSelect.innerHTML = '<option>Loading...</option>';

      if (!deptId) {
        sectionSelect.innerHTML = '<option value="">-- Select Section --</option>';
        return;
      }

      fetch('get_sections.php?dept_id=' + encodeURIComponent(deptId))
        .then(res => res.text())
        .then(data => {
          sectionSelect.innerHTML = data || '<option>No sections available</option>';
        })
        .catch(err => {
          console.error(err);
          sectionSelect.innerHTML = '<option>Error loading sections</option>';
        });
    });

      function toggleMenu(){
       const menu = document.getElementById("mobile-menu");
       menu.classList.toggle("hidden");
}
  </script>

</body>
</html>
