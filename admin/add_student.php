<?php
include '../includes/db.php';

// Fetch departments for the dropdown
$dept_query = $conn->query("SELECT * FROM departments ORDER BY dept_name ASC");

if(isset($_POST['add'])){
    // 1. Collect inputs from the form
    $prn = $_POST['prn']; 
    $name = $_POST['name'];
    $roll_no = $_POST['roll_no'];
    $department = $_POST['department']; 
    $section_id = $_POST['section_id']; // Using the value from the form
    $semester = $_POST['semester'];
    $password = $_POST['password'];

    // 2. The Balanced Query
    // COLUMNS (7): student_id, password, name, roll_no, department, section_id, semester
    // VALUES  (7): '$prn', '$password', '$name', '$roll_no', '$department', '$section_id', '$semester'
    
    $sql = "INSERT INTO students (student_id, password, name, roll_no, department, section_id, semester) 
            VALUES ('$prn', '$password', '$name', '$roll_no', '$department', '$section_id', '$semester')";

    if($conn->query($sql)) {
        header("Location: manage_student.php"); // Fixed filename to match your directory
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student | KCEM Smart Campus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-indigo-600 p-6 text-white">
            <h2 class="text-2xl font-bold">Register Student</h2>
            <p class="text-indigo-100 text-sm">Fill in the details to create a new profile.</p>
        </div>

        <form method="post" class="p-8 space-y-5">
            
            <div class="grid grid-cols-1 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Student PRN</label>
                    <input name="prn" type="text" placeholder="e.g. 20241001" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
                    <input name="name" type="text" placeholder="John Doe" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Roll no</label>
                    <input name="roll_no" type="text" placeholder="CSE-A-01" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
    <label class="block text-sm font-semibold text-gray-700 mb-1">Department</label>
    <select name="department" required class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
        <option value="" disabled selected>Select Department</option>
        
        <?php if($dept_query && $dept_query->num_rows > 0): ?>
            <?php while($dept = $dept_query->fetch_assoc()): ?>
                <option value="<?php echo $dept['dept_id']; ?>">
                    <?php echo htmlspecialchars($dept['dept_name']); ?>
                </option>
            <?php endwhile; ?>
        <?php else: ?>
            <option value="">No departments found</option>
        <?php endif; ?>
    </select>
</div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Semester</label>
                        <input name="semester" type="number" min="1" max="8" value="1"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                    </div>
                </div>

                <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">srction_id</label>
                        <input name="section_id" type="number" min="1" max="8" value="1"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                    </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Initial Password</label>
                    <input name="password" type="password" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                </div>
            </div>

            <div class="pt-4 flex items-center justify-between gap-4">
                <a href="manage_students.php" class="text-sm text-gray-500 hover:text-gray-700 font-medium">Cancel</a>
                <button name="add" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-md hover:shadow-lg transform transition-transform active:scale-95">
                    Create Student
                </button>
            </div>

        </form>
    </div>

</body>
</html>