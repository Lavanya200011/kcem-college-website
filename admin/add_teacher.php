<?php
include '../includes/db.php';

// Fetch departments for the dropdown
$dept_query = $conn->query("SELECT * FROM departments ORDER BY dept_name ASC");

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    // $department = $_POST['department']; // This will now be the ID from the dropdown
    $password = $_POST['password'];

    // Professional practice: Consider using password_hash here for security
    $conn->query("INSERT INTO teachers(name, email, password) 
                  VALUES('$name', '$email', '$password')");

    header("Location: manage_teacher.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teacher | KCEM Smart Campus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-indigo-600 p-6 text-white text-center">
            <h2 class="text-2xl font-bold italic">KCEM Smart Campus</h2>
            <p class="text-indigo-100 text-sm mt-1">Faculty Registration Portal</p>
        </div>

        <form method="post" class="p-8 space-y-5">
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
                <div class="relative">
                    <input name="name" type="text" placeholder="Dr. Jane Smith" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Official Email</label>
                <input name="email" type="email" placeholder="jane.smith@kcem.edu" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
            </div>

           <!-- <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Department</label>
                <select name="department" required class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                    <option value="" disabled selected>Select Faculty Dept</option>
                    <?php if($dept_query && $dept_query->num_rows > 0): ?>
                        <?php while($dept = $dept_query->fetch_assoc()): ?>
                            <option value="<?php echo $dept['dept_id']; ?>">
                                <?php echo htmlspecialchars($dept['dept_name']); ?>
                            </option>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <option value="General">General Education</option>
                    <?php endif; ?>
                </select>
            </div> -->

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Access Password</label>
                <input name="password" type="password" placeholder="••••••••" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                <p class="text-xs text-gray-400 mt-1 italic">Provide a temporary password for first login.</p>
            </div>

            <div class="pt-6 flex flex-col gap-3">
                <button name="add" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg shadow-md hover:shadow-lg transform transition-all active:scale-95">
                    Register Teacher
                </button>
                <a href="manage_teacher.php" class="text-center text-sm text-gray-500 hover:text-gray-700 font-medium">
                    ← Back to Directory
                </a>
            </div>

        </form>
    </div>

</body>
</html>