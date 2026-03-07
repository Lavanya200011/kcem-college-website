<?php
include '../includes/db.php';

// Check if 'type' exists, otherwise default to empty
$type = $_GET['type'] ?? '';

// Check both 'student_id' AND 'id' just in case
$id = $_GET['student_id'] ?? $_GET['id'] ?? null;

if(isset($_POST['reset']) && $id) {
    $new = $_POST['password'];

    if($type == "student") {
        $conn->query("UPDATE students SET password='$new' WHERE student_id=$id");
    }
    elseif($type == "teacher") {
        $conn->query("UPDATE teachers SET password='$new' WHERE teacher_id=$id");
    }
    elseif($type == "admin") {
        $conn->query("UPDATE admins SET password='$new' WHERE id=$id");
    }

    header("Location: dashboard_admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | KCEM Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="bg-slate-800 p-8 text-white text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-700 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold">Reset Password</h2>
            <p class="text-slate-400 text-sm mt-1 uppercase tracking-widest font-semibold">
                Target: <?php echo htmlspecialchars($type); ?> #<?php echo htmlspecialchars($id); ?>
            </p>
        </div>

        <form method="post" class="p-8 space-y-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">New Secure Password</label>
                <input name="password" type="password" required placeholder="••••••••"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all font-mono">
                <p class="text-xs text-gray-400 mt-3 italic">
                    Note: This change is immediate and will log the user out of active sessions.
                </p>
            </div>

            <div class="flex flex-col gap-3">
                <button name="reset" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-indigo-200 transition-all active:scale-95">
                    Confirm Password Reset
                </button>
                <a href="manage_admin.php" class="text-center text-sm text-gray-500 hover:text-gray-800 font-medium py-2">
                    Cancel and Return
                </a>
            </div>
        </form>
    </div>

</body>
</html>