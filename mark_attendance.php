<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'includes/db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Detect whether students table has a semester column
$hasSemester = false;
$colCheck = $conn->query("SHOW COLUMNS FROM `students` LIKE 'semester'");
if ($colCheck && $colCheck->num_rows > 0) {
    $hasSemester = true;
}

// helper to escape output
function e($v) { return htmlspecialchars($v ?? '', ENT_QUOTES); }

// Keep previous form values if present
$prev = [
    'dept_id'    => $_POST['dept_id']    ?? '',
    'section_id' => $_POST['section_id'] ?? '',
    'semester'   => $_POST['semester']   ?? '',
    'lecture'    => $_POST['lecture']    ?? '',
    'subject'    => $_POST['subject']    ?? '',
    'date'       => $_POST['date']       ?? '',
];

$error = '';    // error message to display
$students = null;
$show_students = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate required filters
    if (empty($_POST['dept_id']) || empty($_POST['section_id']) || empty($_POST['semester'] ?? '') || empty($_POST['lecture']) || empty($_POST['subject']) || empty($_POST['date'])) {
        $error = "Please fill all fields (Department, Section, Semester, Lecture, Subject, Date).";
    } else {
        $dept_id    = (int)$_POST['dept_id'];
        $section_id = (int)$_POST['section_id'];
        $semester   = $_POST['semester'];
        $lecture    = (int)$_POST['lecture'];
        $subject    = trim($_POST['subject']);
        $date       = $_POST['date'];

        // Build query depending on whether semester column exists
        if ($hasSemester) {
            $sql = "SELECT * FROM students WHERE section_id = ? AND semester = ? ORDER BY roll_no ASC";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $section_id, $semester);
        } else {
            // If semester column doesn't exist, fallback to section-only filter
            $sql = "SELECT * FROM students WHERE section_id = ? ORDER BY roll_no ASC";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $section_id);
        }

        if (!$stmt->execute()) {
            $error = "Database error when fetching students: " . $stmt->error;
        } else {
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                // No students found for given combination
                if ($hasSemester) {
                    $error = "No students found for Department ID {$dept_id}, Section ID {$section_id} and Semester '{$semester}'. Please re-check your selection.";
                } else {
                    $error = "No students found for Section ID {$section_id}. Please re-check your selection.";
                }
            } else {
                // Students exist — show the attendance form
                $students = $result;
                $show_students = true;

                // Preserve values in $prev (already set above)
                $prev['dept_id'] = $dept_id;
                $prev['section_id'] = $section_id;
                $prev['semester'] = $semester;
                $prev['lecture'] = $lecture;
                $prev['subject'] = $subject;
                $prev['date'] = $date;
            }
        }
        if (isset($stmt)) $stmt->close();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Mark Attendance</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <style> /* small improvement for mobile */ body{min-height:100vh}</style>
  <script>
    function toggleMenu(){ const m=document.getElementById('mobile-menu'); if(m) m.classList.toggle('hidden'); }

    // Optional AJAX validation:
    // You can uncomment and adapt below to validate Dept+Section+Semester before submit.
    /*
    function validateSelection() {
      const dept = document.getElementById('deptSelect').value;
      const section = document.getElementById('sectionSelect').value;
      const semester = document.getElementById('semesterSelect').value;
      if (!dept || !section || !semester) return true; // let server handle

      const url = `validate_students.php?dept_id=${encodeURIComponent(dept)}&section_id=${encodeURIComponent(section)}&semester=${encodeURIComponent(semester)}`;
      return fetch(url).then(r => r.json()).then(data => {
        if (!data.ok) {
          alert('No students found for this Dept/Section/Semester.');
          return false;
        }
        return true;
      }).catch(err => { console.error(err); return true; });
    }

    // If you use validateSelection, call it on form submit and preventDefault depending on result.
    */
  </script>
</head>
<body class="bg-gray-100">

<!-- Header / Navbar -->
<nav class="bg-white shadow px-4 py-4 sticky top-0 z-50">
  <div class="max-w-7xl mx-auto flex items-center justify-between">
    <div class="flex items-center gap-3">
      <img src="kcem.png" alt="logo" class="h-10 w-10 rounded-full border-2 border-indigo-500">
      <div class="font-extrabold text-indigo-700">KCEM ATTENDANCE</div>
    </div>
    <div class="hidden md:flex gap-6">
      <a href="index.php" class="text-blue-600 font-semibold">Dashboard</a>
    </div>
    <div class="md:hidden">
      <button onclick="toggleMenu()" class="text-gray-600">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
      </button>
    </div>
  </div>

  <div id="mobile-menu" class="md:hidden hidden px-3 pb-3">
    <a href="index.php" class="block py-2 text-blue-600 font-semibold">Dashboard</a>
  </div>
</nav>

<!-- Page container -->
<div class="max-w-4xl mx-auto mt-8 mb-12 p-6">

  <div class="bg-indigo-500 rounded-lg p-6 shadow">
    <h1 class="text-2xl font-bold text-white text-center mb-4">📝 Mark Attendance</h1>
      <?php if (isset($_GET['submitted']) && $_GET['submitted'] == 1): ?>
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center">
      <strong class="font-bold">Success!</strong> Attendance has been submitted successfully.
  </div>
<?php endif; ?>

    <?php if ($error): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 p-3 rounded mb-4">
        <?= e($error) ?>
      </div>
    <?php endif; ?>

    <?php if (!$show_students): ?>
      <!-- STEP 1: Filter form -->
      <form method="POST" action="">
        <div class="grid md:grid-cols-2 gap-4 bg-white p-4 rounded">
          <!-- Dept -->
          <div>
            <label class="block font-semibold mb-1">Department</label>
            <select name="dept_id" id="deptSelect" class="w-full p-2 border rounded" required>
              <option value="">-- Select Department --</option>
              <?php
                $res = $conn->query("SELECT * FROM departments");
                while ($r = $res->fetch_assoc()) {
                  $sel = ($prev['dept_id'] == $r['dept_id']) ? 'selected' : '';
                  echo "<option value='".e($r['dept_id'])."' $sel>".e($r['dept_name'])."</option>";
                }
              ?>
            </select>
          </div>

          <!-- Section -->
          <div>
            <label class="block font-semibold mb-1">Section</label>
            <select name="section_id" id="sectionSelect" class="w-full p-2 border rounded" required>
              <option value="">-- Select Section --</option>
              <?php
                // optionally prefill sections for previously selected dept (if any)
                if (!empty($prev['dept_id'])) {
                    $sid = (int)$prev['dept_id'];
                    $res2 = $conn->query("SELECT * FROM sections WHERE dept_id = $sid");
                    while ($r2 = $res2->fetch_assoc()) {
                        $sel = ($prev['section_id'] == $r2['section_id']) ? 'selected' : '';
                        echo "<option value='".e($r2['section_id'])."' $sel>" . e($r2['section_name'] ?? $r2['section_id']) . "</option>";
                    }
                }
              ?>
            </select>
          </div>

          <!-- Semester -->
          <div>
            <label class="block font-semibold mb-1">Semester</label>
            <select name="semester" id="semesterSelect" class="w-full p-2 border rounded" required>
              <option value="">-- Select Semester --</option>
              <?php for ($i=1;$i<=8;$i++): $s = $i; ?>
                <option value="<?= $s ?>" <?= ($prev['semester']==$s) ? 'selected' : '' ?>><?= $s ?><?= $s==1 ? 'st' : 'th' ?> Semester</option>
              <?php endfor; ?>
            </select>
          </div>

          <!-- Lecture -->
          <div>
            <label class="block font-semibold mb-1">Lecture No</label>
            <input type="number" name="lecture" min="1" max="8" required class="w-full p-2 border rounded" value="<?= e($prev['lecture']) ?>">
          </div>

          <!-- Subject -->
          <div>
            <label class="block font-semibold mb-1">Subject</label>
            <input type="text" name="subject" required class="w-full p-2 border rounded" value="<?= e($prev['subject']) ?>">
          </div>

          <!-- Date -->
          <div class="md:col-span-2">
            <label class="block font-semibold mb-1">Date</label>
            <input type="date" name="date" required class="w-full p-2 border rounded" value="<?= e($prev['date']) ?>">
          </div>
        </div>

        <div class="mt-4">
          <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Load Students</button>
        </div>
      </form>

      <!-- Client-side: load sections when dept changes -->
      <script>
        document.getElementById('deptSelect').addEventListener('change', function(){
          const deptId = this.value;
          const sectionSelect = document.getElementById('sectionSelect');
          sectionSelect.innerHTML = '<option>Loading...</option>';
          fetch('get_sections.php?dept_id=' + encodeURIComponent(deptId))
            .then(r => r.text())
            .then(html => { sectionSelect.innerHTML = html || '<option>No sections</option>'; })
            .catch(err => { console.error(err); sectionSelect.innerHTML = '<option>Error loading</option>'; });
        });
      </script>

    <?php else: ?>
      <!-- STEP 2: Show students and present/absent radio buttons -->
      <div class="bg-white p-4 rounded shadow">
        <form method="POST" action="submit_attendance.php">
          <input type="hidden" name="section_id" value="<?= e($prev['section_id']) ?>">
          <input type="hidden" name="lecture" value="<?= e($prev['lecture']) ?>">
          <input type="hidden" name="subject" value="<?= e($prev['subject']) ?>">
          <input type="hidden" name="date" value="<?= e($prev['date']) ?>">
          <input type="hidden" name="semester" value="<?= e($prev['semester']) ?>">

          <div class="mb-4">
            <h2 class="text-xl font-bold">Students in Section <?= e($prev['section_id']) ?></h2>
            <p class="text-sm text-gray-600">
              Semester: <?= e($prev['semester']) ?> |
              Date: <?= e($prev['date']) ?> |
              Lecture: <?= e($prev['lecture']) ?> |
              Subject: <?= e($prev['subject']) ?>
            </p>
          </div>

          <?php while ($student = $students->fetch_assoc()): ?>
            <div class="mb-3 border-b pb-3">
              <div class="flex justify-between items-center">
                <div>
                  <strong><?= e($student['roll_no']) ?></strong> - <?= e($student['name']) ?>
                </div>
                <div class="flex items-center space-x-4">
                  <label class="flex items-center space-x-2">
                    <input type="radio" name="status[<?= (int)$student['student_id'] ?>]" value="Present" class="form-radio">
                    <span>Present</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input type="radio" name="status[<?= (int)$student['student_id'] ?>]" value="Absent" checked class="form-radio">
                    <span>Absent</span>
                  </label>
                </div>
              </div>
            </div>
          <?php endwhile; ?>

          <div class="mt-4">
            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
              Submit Attendance
            </button>
          </div>
        </form>
      </div>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
