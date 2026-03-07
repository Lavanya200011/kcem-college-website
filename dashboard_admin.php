<?php
include 'includes/db.php';
session_start();

// Authentication check (Optional but recommended)
// if(!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit(); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | KCEM Smart Campus</title>
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

    <aside class="w-72 bg-slate-900 text-slate-300 flex flex-col shadow-xl">
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
            
            <a href="dashboard_admin.php" class="sidebar-link sidebar-active flex items-center gap-3 px-4 py-3 rounded-xl transition-all font-medium">
                <i data-lucide="home" class="w-5 h-5"></i> Dashboard
            </a>
            
            <a href="admin/manage_student.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all font-medium">
                <i data-lucide="graduation-cap" class="w-5 h-5"></i> Students
            </a>
            
            <a href="admin/manage_teacher.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all font-medium">
                <i data-lucide="users" class="w-5 h-5"></i> Teachers
            </a>
            
            <a href="admin/manage_admin.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all font-medium">
                <i data-lucide="shield-check" class="w-5 h-5"></i> Admins
            </a>
        </nav>

        <div class="p-4 mt-auto border-t border-slate-800">
            <a href="logout.php" class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10 transition-all font-medium">
                <i data-lucide="log-out" class="w-5 h-5"></i> Logout
            </a>
        </div>
    </aside>

    <main class="flex-1 overflow-y-auto">
        <header class="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold text-slate-800">Dashboard Overview</h1>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-slate-700">System Admin</p>
                    <p class="text-xs text-slate-400">KCEM Campus Control</p>
                </div>
                <div class="h-10 w-10 bg-indigo-100 text-indigo-700 rounded-full flex items-center justify-center font-bold">
                    SA
                </div>
            </div>
        </header>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <?php
                $students = $conn->query("SELECT COUNT(*) as total FROM students")->fetch_assoc();
                $teachers = $conn->query("SELECT COUNT(*) as total FROM teachers")->fetch_assoc();
                $admins = $conn->query("SELECT COUNT(*) as total FROM admins")->fetch_assoc();
                ?>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-6 group hover:border-indigo-300 transition-all">
                    <div class="bg-indigo-50 p-4 rounded-2xl group-hover:bg-indigo-600 transition-colors">
                        <i data-lucide="graduation-cap" class="text-indigo-600 group-hover:text-white w-8 h-8"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Students</p>
                        <h2 class="text-3xl font-bold text-slate-800"><?php echo number_format($students['total']); ?></h2>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-6 group hover:border-emerald-300 transition-all">
                    <div class="bg-emerald-50 p-4 rounded-2xl group-hover:bg-emerald-600 transition-colors">
                        <i data-lucide="users" class="text-emerald-600 group-hover:text-white w-8 h-8"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Teachers</p>
                        <h2 class="text-3xl font-bold text-slate-800"><?php echo number_format($teachers['total']); ?></h2>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-6 group hover:border-orange-300 transition-all">
                    <div class="bg-orange-50 p-4 rounded-2xl group-hover:bg-orange-600 transition-colors">
                        <i data-lucide="shield-check" class="text-orange-600 group-hover:text-white w-8 h-8"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Active Admins</p>
                        <h2 class="text-3xl font-bold text-slate-800"><?php echo number_format($admins['total']); ?></h2>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 h-64 flex flex-col items-center justify-center text-slate-400">
                <i data-lucide="bar-chart-3" class="w-12 h-12 mb-4 opacity-20"></i>
                <p>Welcome to the KCEM Admin Panel. Select an option from the sidebar to manage records.</p>
            </div>
        </div>
    </main>

</div>

<script>
    // Initialize Lucide Icons
    lucide.createIcons();
</script>
</body>
</html>