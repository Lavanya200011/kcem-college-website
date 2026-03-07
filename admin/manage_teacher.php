<?php
include '../includes/db.php';
$result = $conn->query("SELECT * FROM teachers ORDER BY teacher_id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Teachers | KCEM Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
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
            
            <a href="manage_student.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all font-medium">
                <i data-lucide="graduation-cap" class="w-5 h-5"></i> Students
            </a>
            
            <a href="manage_teacher.php" class="sidebar-link sidebar-active flex items-center gap-3 px-4 py-3 rounded-xl transition-all font-medium">
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
                <h1 class="text-3xl font-bold text-gray-800">Teacher Directory</h1>
                <p class="text-sm text-gray-500">Manage faculty members and official credentials</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="add_teacher.php" 
                   class="inline-flex items-center px-5 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition-all transform active:scale-95">
                   <i data-lucide="plus-circle" class="w-4 h-4 mr-2"></i>
                   Add Teacher
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase tracking-wider">Teacher Name</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase tracking-wider">Email Address</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase tracking-wider">Password</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase tracking-wider text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php while($row = $result->fetch_assoc()){ ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                            #<?php echo $row['teacher_id']; ?>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs mr-3">
                                    <?php echo strtoupper(substr($row['name'], 0, 1)); ?>
                                </div>
                                <span class="text-sm text-gray-700 font-medium"><?php echo htmlspecialchars($row['name']); ?></span>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-500">
                            <?php echo htmlspecialchars($row['email']); ?>
                        </td>

                        <td class="px-6 py-4">
                            <code class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs font-mono">
                                <?php echo htmlspecialchars($row['password']); ?>
                            </code>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-3">
                                <a href="reset_password.php?type=teacher&id=<?php echo $row['teacher_id']; ?>" 
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-bold rounded-md hover:bg-blue-100 transition-colors">
                                    RESET
                                </a>
                                
                                <a href="delete_user.php?type=teacher&id=<?php echo $row['teacher_id']; ?>" 
                                   onclick="return confirm('Are you sure you want to remove this teacher?')"
                                   class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 text-xs font-bold rounded-md hover:bg-red-100 transition-colors">
                                    DELETE
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