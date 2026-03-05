<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'includes/db.php';

session_start();

// ====== DB CONNECTION (yahan hosting ke credentials daalne hain) ======

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// ====== LOGIN LOGIC ======
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = trim($_POST['student_id'] ?? '');
    $password_input = trim($_POST['password'] ?? '');

    if ($student_id === "" || $password_input === "") {
        $error = "Please enter both PRN (Student ID) and Password.";
    } else {
        // yahan table ka naam 'students' maana hai
        // columns: student_id, password
        $sql = "SELECT student_id, password, name FROM students WHERE student_id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            $error = "Query error: " . $conn->error;
        } else {
            $stmt->bind_param("i", $student_id);
            $stmt->execute();

            // get_result ki jagah bind_result + fetch use kar rahe hain
            $stmt->bind_result($db_student_id, $db_password, $db_name);

            if ($stmt->fetch()) {
                // Agar tumne plain password store kiya hai:
                if ($password_input === $db_password) {
                    // Login success
                    $_SESSION['student_loggedin'] = true;
                    $_SESSION['student_id'] = $db_student_id;
                    $_SESSION['student_name'] = $db_name;

                    // Redirect to attendance page
                    header("Location: check_attendance.php");
                    exit;
                } else {
                    $error = "Invalid password.";
                }

                /*
                // Agar tum password_hash() / password_verify() use karti ho to:
                if (password_verify($password_input, $db_password)) {
                    // success...
                } else {
                    $error = "Invalid password.";
                }
                */
            } else {
                $error = "No student found with this PRN.";
            }

            $stmt->close();
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login - KCEM Attendance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-6 sm:p-8">
    <div class="flex items-center space-x-3 mb-6">
        <img src="kcem.png" alt="Logo" class="h-10 w-10 rounded-full border-2 border-indigo-500">
        <div>
            <h1 class="text-xl font-extrabold text-indigo-700">KCEM Attendance</h1>
            <p class="text-gray-500 text-sm">Student Login</p>
        </div>
    </div>

    <?php if ($error): ?>
        <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 text-red-700 text-sm font-semibold">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="studentlogin.php" class="space-y-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                PRN / Student ID
            </label>
            <input type="number" name="student_id"
                   class="w-full px-3 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   placeholder="Enter your PRN" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Password
            </label>
            <input type="password" name="password"
                   class="w-full px-3 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   placeholder="Enter your password" required>
        </div>

        <button type="submit"
                class="w-full bg-indigo-600 text-white py-2.5 rounded-xl font-semibold hover:bg-indigo-700 transition duration-200">
            Login
        </button>
    </form>

    <div class="mt-4 text-center">
        <a href="index.php" class="text-sm text-blue-600 hover:underline">
            ← Back to Home
        </a>
    </div>
</div>

</body>
</html>
