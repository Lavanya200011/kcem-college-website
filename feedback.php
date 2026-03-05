<?php
include 'includes/db.php';

// Contact form handling logic
$submitted = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = htmlspecialchars($_POST["name"]);
    $dept_year   = htmlspecialchars($_POST["dept_year"]);
    $message = htmlspecialchars($_POST["message"]);
    // For now, we'll just show confirmation
    $submitted = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Feedback</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
<body class="bg-gray-100 text-gray-800">
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
  
  <div class="max-w-xl mx-auto mt-10 bg-indigo-500 shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4 text-center text-white underline">📬SUGGEST US WHAT WE DO Next</h1><br>

    <?php if ($submitted): ?>
      <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
        Thank you, <strong><?= $name ?></strong>! Your message has been received.
      </div>
    <?php endif; ?>

   <form action="givefeedback.php" method="POST" class="space-y-4">
  <div>
    <label for="name" class="block font-medium text-white">Your Name</label>
    <input type="text" id="name" name="name" required class="w-full border rounded px-4 py-2" />
  </div>

  <div>
    <label for="department_year" class="block font-medium text-white">Your Department and Year: Ex.CSE 2nd</label>
    <input type="text" id="dept_year" name="dept_year" required class="w-full border rounded px-4 py-2" />
  </div>

  <div>
    <label for="message" class="block font-medium text-white">Your Suggestion</label>
    <textarea id="message" name="message" rows="4" required class="w-full border rounded px-4 py-2"></textarea>
  </div>

  <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
    Send Feedback
  </button>
</form>

  </div>
</body>
</html>
