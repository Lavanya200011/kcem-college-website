<?php
include '../includes/db.php';
// Fetch all admins
$result = $conn->query("SELECT * FROM admins ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admins | KCEM Smart Campus</title>
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
            
            <a href="manage_student.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all font-medium">
                <i data-lucide="graduation-cap" class="w-5 h-5"></i> Students
            </a>
            
            <a href="manage_teacher.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all font-medium">
                <i data-lucide="users" class="w-5 h-5"></i> Teachers
            </a>
            
            <a href="manage_admin.php" class="sidebar-link sidebar-active flex items-center gap-3 px-4 py-3 rounded-xl transition-all font-medium">
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
                <h1 class="text-3xl font-bold text-gray-800">Admin Accounts</h1>
                <p class="text-sm text-gray-500">Manage system level access and security</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="add_admin.php" 
                   class="inline-flex items-center px-5 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition-all transform active:scale-95">
                   <i data-lucide="user-plus" class="w-4 h-4 mr-2"></i>
                   Create Admin
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Administrator</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-center">Security Hash</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-slate-800 text-white flex items-center justify-center font-bold text-sm mr-3 shadow-inner">
                                        <?php echo strtoupper(substr($row['username'], 0, 1)); ?>
                                    </div>
                                    <div>
                                        <span class="block text-sm font-bold text-slate-900"><?php echo htmlspecialchars($row['username']); ?></span>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-green-100 text-green-700 uppercase tracking-tight">
                                            Root Access
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <code class="text-xs bg-slate-100 px-3 py-1.5 rounded-md text-slate-500 font-mono">
                                    <?php echo htmlspecialchars($row['password']); ?>
                                </code>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-3">
                                    <a href="reset_password.php?type=admin&id=<?php echo $row['id']; ?>" 
                                       class="px-3 py-1.5 bg-blue-50 text-blue-700 text-[11px] font-bold rounded-lg hover:bg-blue-100 transition-all">
                                        RESET
                                    </a>
                                    
                                    <a href="delete_user.php?type=admin&id=<?php echo $row['id']; ?>" 
                                       onclick="return confirm('CRITICAL WARNING: Deleting an admin can lock you out of the system. Continue?')"
                                       class="px-3 py-1.5 bg-red-50 text-red-600 text-[11px] font-bold rounded-lg hover:bg-red-100 transition-all">
                                        REVOKE
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-slate-400 italic">
                                No administrators found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <p class="mt-4 text-[11px] text-slate-400 text-right font-medium">
            Authorized System Operators: <span class="text-slate-600"><?php echo $result->num_rows; ?></span>
        </p>
    </main>

</div>

<script>
    // Initialize Icons
    lucide.createIcons();
</script>
</body>
</html>