<?php
include '../includes/db.php';
$result = $conn->query("SELECT * FROM students ORDER BY semester ASC, name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students | KCEM Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link:hover { background-color: rgba(99, 102, 241, 0.1); color: #818cf8; }
        .sidebar-active { background-color: #6366f1; color: white !important; }
    </style>
</head>
<body class="bg-[#f8fafc]">

<div class="flex min-h-screen">

    <aside class="w-72 bg-slate-900 text-slate-300 flex flex-col shadow-xl sticky top-0 h-screen">
        <div class="p-8">
            <div class="flex items-center gap-3">
                <div class="bg-indigo-600 p-2 rounded-lg">
                    <i data-lucide="layout-dashboard" class="text-white w-6 h-6"></i>
                </div>
                <h2 class="text-xl font-bold text-white tracking-tight">Smart Campus</h2>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-1">
            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-4 px-4">Main Menu</p>
            
            <a href="../dashboard_admin.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all font-medium">
                <i data-lucide="home" class="w-5 h-5"></i> Dashboard
            </a>
            
            <a href="manage_student.php" class="sidebar-link sidebar-active flex items-center gap-3 px-4 py-3 rounded-xl transition-all font-medium">
                <i data-lucide="graduation-cap" class="w-5 h-5"></i> Students
            </a>
            
            <a href="manage_teacher.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all font-medium">
                <i data-lucide="users" class="w-5 h-5"></i> Teachers
            </a>
            
            <a href="manage_admin.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all font-medium">
                <i data-lucide="shield-check" class="w-5 h-5"></i> Admins
            </a>
        </nav>

        <div class="p-4 mt-auto border-t border-slate-800">
            <a href="../logout.php" class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10 transition-all font-medium">
                <i data-lucide="log-out" class="w-5 h-5"></i> Logout
            </a>
        </div>
    </aside>

    <main class="flex-1 p-8">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Student Directory</h1>
                <p class="text-sm text-gray-500">View and manage enrolled students</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="add_student.php" 
                   class="inline-flex items-center px-5 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition-all transform active:scale-95">
                   <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                   Add New Student
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">PRN / ID</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Student Name</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Roll no</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Semester</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Password</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php while($row = $result->fetch_assoc()){ ?>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-semibold text-slate-700">
                            #<?php echo $row['student_id']; ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs mr-3">
                                    <?php echo strtoupper(substr($row['name'], 0, 1)); ?>
                                </div>
                                <span class="text-sm font-medium text-slate-700"><?php echo htmlspecialchars($row['name']); ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-bold uppercase">
                                <?php echo $row['roll_no']; ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-bold uppercase">
                                Sem <?php echo $row['semester']; ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <code class="text-xs bg-slate-100 px-2 py-1 rounded text-slate-600 font-mono">
                                <?php echo htmlspecialchars($row['password']); ?>
                            </code>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-2">
                                <a href="reset_password.php?type=student&id=<?php echo $row['student_id']; ?>" 
                                   class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Reset Password">
                                   <i data-lucide="key-round" class="w-4 h-4"></i>
                                </a>
                                <a href="delete_user.php?type=student&id=<?php echo $row['student_id']; ?>" 
                                   onclick="return confirm('Are you sure?')"
                                   class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete Student">
                                   <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

</div>

<script>
    lucide.createIcons();
</script>
</body>
</html>