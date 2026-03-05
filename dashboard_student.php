<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'includes/db.php';

// Session start (important for login-based access)
session_start();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/*
    --- INPUT LOGIC ---

    Case 1: Page form se call ho (POST)
        → student_id, month, year = POST se (teacher / filter form)

    Case 2: Page login ke baad redirect se open ho (GET)
        → student_id = SESSION se
        → All months ka attendance dikhana
*/

// Flag: month/year filter on hai ya nahi
$filterByMonthYear = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_id'])) {

    // Form se आये – specific month/year ke liye
    $student_id = (int)$_POST['student_id'];
    $month      = (int)$_POST['month'];
    $year       = (int)$_POST['year'];

    $filterByMonthYear = true;

} else {

    // GET request (login ke baad)
    if (isset($_SESSION['student_id'])) {
        $student_id = (int)$_SESSION['student_id'];

        // All months ke liye (no month/year filter)
        $month = null;
        $year  = null;

        $filterByMonthYear = false;
    } else {
        echo "<p style='text-align:center;margin-top:20px;color:red;font-weight:bold'>
                Invalid Access: Student not logged in or no data provided.
              </p>";
        exit;
    }
}

// JS ke liye safe month/year values
if ($filterByMonthYear) {
    $month_js = (int)$month;
    $year_js  = (int)$year;
} else {
    // login se aaye ho → ALL months
    $month_js = 'all';
    $year_js  = 'all';
}

// ============== Step 1: Get student name ==============
// Agar tumhara table ka naam 'student' hai to 'students' ko 'student' kar dena
$sql1 = "SELECT name FROM students WHERE student_id = ?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("i", $student_id);
$stmt1->execute();
$result1 = $stmt1->get_result();

if ($result1->num_rows === 0) {
    echo "<p style='text-align:center;margin-top:20px;color:red;font-weight:bold'>
            No student found with ID: $student_id
          </p>";
    exit;
}

$row1 = $result1->fetch_assoc();
$student_name = $row1['name'];

// ============== Step 2: Get attendance records ==============
if ($filterByMonthYear) {
    // Specific month/year
    $sql2 = "SELECT * FROM attendance WHERE student_id = ? AND MONTH(date) = ? AND YEAR(date) = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("iii", $student_id, $month, $year);
} else {
    // All months (login se)
    $sql2 = "SELECT * FROM attendance WHERE student_id = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("i", $student_id);
}

$stmt2->execute();
$result2 = $stmt2->get_result();

$total_days = 0;
$present_days = 0;
$subject_attendance = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Attendance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-100">

<!-- Navbar -->
<nav class="bg-white shadow-xl px-4 py-4 sticky top-0 z-50">
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

            <?php if (isset($_SESSION['student_loggedin']) && $_SESSION['student_loggedin'] === true): ?>
                <a href="logout.php"
                   class="bg-red-500 text-white px-4 py-2 rounded-xl hover:bg-red-600 transition duration-300 font-semibold">
                    Logout
                </a>
            <?php endif; ?>
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
    <div id="mobile-menu"
         class="md:hidden hidden mt-3 px-3 pb-4 space-y-2 bg-white rounded-xl shadow-xl">

        <a href="index.php" class="block text-blue-600 font-semibold hover:text-blue-700">
            Dashboard
        </a>

        <?php if (isset($_SESSION['student_loggedin']) && $_SESSION['student_loggedin'] === true): ?>
            <a href="logout.php"
               class="block bg-red-500 text-white px-4 py-2 mt-2 rounded-xl text-center font-semibold hover:bg-red-600">
                Logout
            </a>
        <?php endif; ?>
    </div>
</nav>

<?php
echo "<center><h2 class='text-4xl font-bold mt-6'>WELCOME<br> $student_name (ID: $student_id)</h2></center>";

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $total_days++;
        if ($row['status'] === 'Present') {
            $present_days++;
        }

        $sub = $row['subject'];
        if (!isset($subject_attendance[$sub])) {
            $subject_attendance[$sub] = ['total' => 0, 'present' => 0];
        }
        $subject_attendance[$sub]['total']++;
        if ($row['status'] === 'Present') {
            $subject_attendance[$sub]['present']++;
        }
    }

    $attendance_percentage = $total_days > 0 ? round(($present_days / $total_days) * 100, 2) : 0;

    echo "<div class='ml-12 mt-4 border-l-4 border-blue-600 h-[150px] mx-auto my-4'>";
    echo "<h3 class='text-lg font-semibold'>Total Classes: $total_days</h3>";
    echo "<h3 class='text-lg font-semibold text-green-600'>Present Days: $present_days</h3>";
    echo "<h3 class='text-lg font-semibold text-blue-600'>Overall Attendance: $attendance_percentage%</h3>";
    echo "</div><hr>";

    echo "<h3 class='font-bold text-2xl text-center'>Here is your attendance summary</h3>";

    if ($filterByMonthYear) {
        echo "<h3 class='text-lg text-gray-700 text-center font-bold'>Month: $month, Year: $year</h3><hr>";
    } else {
        echo "<h3 class='text-lg text-gray-700 text-center font-bold'>Showing attendance for: ALL recorded months</h3><hr>";
    }

    // Subject-wise summary cards
    echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-6 mt-10">';

    foreach ($subject_attendance as $subject => $data) {
        $percentage = round(($data['present'] / $data['total']) * 100, 2);
        echo "<div onclick=\"showSubjectDetails('$subject')\" class='cursor-pointer bg-white border-l-4 border-indigo-600 shadow-md p-5 rounded-xl hover:bg-gray-100 transition-all duration-200'>";
        echo "<h3 class='text-xl font-bold text-gray-800 mb-2'>$subject</h3>";
        echo "<p class='text-gray-600'>Total Classes: {$data['total']}</p>";
        echo "<p class='text-green-600'>Present: {$data['present']}</p>";
        echo "<p class='text-blue-600 font-semibold'>Attendance: $percentage%</p>";
        echo "</div>";
    }
    echo '</div>';

} else {
    if ($filterByMonthYear) {
        echo "<p class='text-center text-red-600 mt-6'>
                No attendance records found for Student ID: $student_id in the selected month ($month / $year).
              </p>";
    } else {
        echo "<p class='text-center text-red-600 mt-6'>
                No attendance records found for Student ID: $student_id.
              </p>";
    }
}

// Modal HTML
echo <<<EOD
<div id="subjectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white w-11/12 md:w-1/2 p-6 rounded-xl shadow-lg relative">
    <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl">&times;</button>
    <h2 id="modalTitle" class="text-xl font-bold text-indigo-700 mb-4"></h2>
    <div id="modalContent" class="text-gray-800 space-y-2 max-h-96 overflow-y-auto"></div>
  </div>
</div>
EOD;

// Modal script
echo <<<EOD
<script>
function showSubjectDetails(subject) {
    fetch(
        'get_subject_attendance.php'
        + '?subject=' + encodeURIComponent(subject)
        + '&student_id={$student_id}'
        + '&month={$month_js}'
        + '&year={$year_js}'
    )
    .then(response => response.text())
    .then(data => {
        document.getElementById('modalTitle').innerText = 'Details for ' + subject;
        document.getElementById('modalContent').innerHTML = data;
        document.getElementById('subjectModal').classList.remove('hidden');
        document.getElementById('subjectModal').classList.add('flex');
    });
}

function closeModal() {
    const modal = document.getElementById('subjectModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
EOD;

$stmt1->close();
$stmt2->close();
$conn->close();
?>
</body>
</html>
