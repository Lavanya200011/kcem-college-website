<?php
session_start();
include 'includes/db.php';

// Detect login states
$studentLoggedIn = isset($_SESSION['student_loggedin']) && $_SESSION['student_loggedin'] === true;
$teacherLoggedIn = isset($_SESSION['teacher_loggedin']) && $_SESSION['teacher_loggedin'] === true;
$adminLoggedIn   = isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] === true;
$anyLoggedIn     = $studentLoggedIn || $teacherLoggedIn || $adminLoggedIn;

// Fetch announcements
$announcements = $conn->query("SELECT * FROM announcements ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KCEM | Karanjekar College of Engineering & Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .marquee-container { overflow: hidden; white-space: nowrap; }
        .marquee-content { display: inline-block; animation: marquee 20s linear infinite; }
        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .custom-scroll::-webkit-scrollbar { width: 5px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }


    /* Force the scrollbar to be visible and easy to grab */
    .custom-scroll {
        scrollbar-width: thin;          /* For Firefox */
        scrollbar-color: #4f46e5 #f1f5f9; /* For Firefox */
    }

    /* For Chrome, Edge, and Safari */
    .custom-scroll::-webkit-scrollbar {
        width: 8px; /* Wider for easier clicking */
        display: block;
    }

    .custom-scroll::-webkit-scrollbar-track {
        background: #f1f5f9; /* Light slate track */
        border-radius: 10px;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
        background: #94a3b8; /* Darker slate thumb for visibility */
        border-radius: 10px;
        border: 2px solid #f1f5f9; /* Creates a padding effect */
    }

    .custom-scroll::-webkit-scrollbar-thumb:hover {
        background: #4f46e5; /* Turns Indigo on hover */
    }
    </style>
</head>
<body class="bg-slate-50 font-sans text-slate-900">

    <header class="bg-white py-4 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between text-center md:text-left gap-4">
            <div class="flex items-center gap-4">
                <img src="images/logo.png" alt="KCEM Logo" class="h-20 w-auto">
                <div>
                    <h1 class="text-xl md:text-2xl font-bold text-indigo-900 leading-tight">
                        Karanjekar College of Engineering & Management
                    </h1>
                    <p class="text-sm text-indigo-600 font-semibold uppercase tracking-wider">
                        Nagzira Road Sakoli (441802) | Affiliated to DBATU, Lonere
                    </p>
                </div>
            </div>
        </div>
    </header>

    <nav class="bg-indigo-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-3">
                <div class="hidden md:flex space-x-8 font-medium">
                    <a href="#about" class="hover:text-indigo-300 transition">About</a>
                    <a href="#principal" class="hover:text-indigo-300 transition">Principal</a>
                    <a href="#courses" class="hover:text-indigo-300 transition">Courses</a>
                    <a href="#announcements" class="hover:text-indigo-300 transition">Notices</a>
                    <a href="#contact" class="hover:text-indigo-300 transition">Contact</a>
                </div>

                <div class="flex items-center gap-3">
                    <?php if(!$anyLoggedIn): ?>
                        <a href="studentlogin.php" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-sm font-bold shadow-md transition">Student Portal</a>
                        <a href="login_teacher.php" class="bg-white text-indigo-900 hover:bg-indigo-50 px-4 py-2 rounded-lg text-sm font-bold shadow-md transition">Faculty Login</a>
                    <?php else: ?>
                        <?php if($studentLoggedIn): ?>
                            <a href="dashboard_student.php" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-sm font-bold">My Profile</a>
                        <?php elseif($teacherLoggedIn): ?>
                            <a href="dashboard_teacher.php" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg text-sm font-bold">Faculty Panel</a>
                        <?php elseif($adminLoggedIn): ?>
                            <a href="dashboard_admin.php" class="bg-yellow-500 text-black px-4 py-2 rounded-lg text-sm font-bold">Admin Panel</a>
                        <?php endif; ?>
                        <a href="logout.php" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg text-sm font-bold shadow-md transition">Logout</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <section class="marquee-container bg-slate-900 h-[400px]">
        <div class="marquee-content flex">
            <img src="images/slide1.jpg" class="h-[400px] w-auto object-cover opacity-80" alt="Slide 1">
            <img src="images/slide2.jpg" class="h-[400px] w-auto object-cover opacity-80" alt="Slide 2">
            <img src="images/slide3.jpg" class="h-[400px] w-auto object-cover opacity-80" alt="Slide 3">
            <img src="images/slide4.jpg" class="h-[400px] w-auto object-cover opacity-80" alt="Slide 4">
            <img src="images/slide5.jpg" class="h-[400px] w-auto object-cover opacity-80" alt="Slide 5">
            <img src="images/slide1.jpg" class="h-[400px] w-auto object-cover opacity-80">
            <img src="images/slide2.jpg" class="h-[400px] w-auto object-cover opacity-80">
        </div>
        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-900 p-10 text-center">
            <h2 class="text-4xl font-bold text-white">Shaping the Engineers of Tomorrow</h2>
        </div>
    </section>

    <div class="max-w-6xl mx-auto -mt-12 relative z-10 px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 bg-white p-8 shadow-xl rounded-2xl border border-slate-100">
            <div class="text-center">
                <h3 class="text-3xl font-bold text-indigo-600">480+</h3>
                <p class="text-slate-500 text-sm font-medium">Students</p>
            </div>
            <div class="text-center border-l border-slate-100">
                <h3 class="text-3xl font-bold text-green-600">40+</h3>
                <p class="text-slate-500 text-sm font-medium">Faculty</p>
            </div>
            <div class="text-center border-l border-slate-100">
                <h3 class="text-3xl font-bold text-purple-600">12</h3>
                <p class="text-slate-500 text-sm font-medium">Departments</p>
            </div>
            <div class="text-center border-l border-slate-100">
                <h3 class="text-3xl font-bold text-red-600">20+</h3>
                <p class="text-slate-500 text-sm font-medium">Labs</p>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 pt-28 pb-16 grid lg:grid-cols-3 gap-12">
        
        <div class="lg:col-span-2 space-y-16">
            
            <section id="about">
                <h2 class="text-3xl font-bold text-slate-800 border-l-4 border-indigo-600 pl-4 mb-6">About Our Institution</h2>
                <p class="text-lg text-slate-600 leading-relaxed">
                    Karanjekar College of Engineering & Management, located in Sakoli, is dedicated to providing
                    quality education in various fields of engineering and management. Our mission is to empower 
                    students with technical skills and leadership qualities to shape their future.
                </p>
            </section>

            <section id="principal" class="bg-indigo-50 p-8 rounded-3xl flex flex-col md:flex-row gap-8 items-center">
                <img src="images/principal.jpg" alt="Principal" class="w-48 h-60 object-cover rounded-2xl shadow-lg border-4 border-white">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">From the Principal's Desk</h2>
                    <h3 class="text-indigo-600 font-bold mb-4">Mrs. Kiran A. Girhepunje</h3>
                    <p class="text-slate-600 italic leading-relaxed">
                        "Our institution is committed to fostering an environment of academic excellence and innovation. 
                        We strive to equip our students with the knowledge and skills necessary to become leaders 
                        in the ever-evolving world of technology."
                    </p>
                </div>
            </section>

            <section id="courses" class="scroll-mt-20">
    <h2 class="text-3xl font-bold text-slate-800 border-l-4 border-indigo-600 pl-4 mb-8">Academic Departments</h2>
    
    <div class="grid md:grid-cols-2 gap-4">
        <?php 
        // Associative array: "Display Name" => "page_link.php"
        $depts = [
            "Computer Science (CSE)" => "dept-cse.php",
            "AI & Data Science (AIDS)" => "dept-aids.php",
            "Civil Engineering" => "dept-civil.php",
            "Electrical Engineering" => "dept-electrical.php",
            "MCA" => "dept-mca.php",
            "MBA" => "dept-mba.php"
        ];

        foreach($depts as $name => $link): ?>
            <a href="<?php echo $link; ?>" class="group p-5 bg-white border border-slate-200 rounded-2xl hover:border-indigo-500 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-indigo-50 rounded-lg group-hover:bg-indigo-600 transition-colors">
                        <i data-lucide="book-open" class="text-indigo-600 group-hover:text-white transition-colors w-5 h-5"></i>
                    </div>
                    <span class="font-bold text-slate-700 group-hover:text-indigo-600 transition-colors tracking-tight">
                        <?php echo $name; ?>
                    </span>
                </div>
                
                <i data-lucide="chevron-right" class="text-slate-300 group-hover:text-indigo-500 group-hover:translate-x-1 transition-all w-5 h-5"></i>
            </a>
        <?php endforeach; ?>
    </div>
</section>
        </div>
           
        <div class="space-y-12">
            <section id="announcements" class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden flex flex-col h-[500px]">
    <div class="bg-orange-500 text-white p-4 font-bold flex items-center gap-2 shrink-0">
        <i data-lucide="megaphone" class=""></i>
        Latest Notices
    </div>

    <div class="p-4 overflow-y-auto custom-scroll flex-grow space-y-4">
        <?php 
        // Ensure the pointer is at the start if you've used this variable elsewhere
        $announcements->data_seek(0); 
        
        if ($announcements->num_rows > 0):
            while($row = $announcements->fetch_assoc()): ?>
                <div class="border-b border-slate-100 last:border-0 pb-3 hover:bg-slate-50 transition-colors p-2 rounded-lg">
                    <p class="text-slate-700 text-sm leading-relaxed mb-1">
                        <?php echo htmlspecialchars($row['message']); ?>
                    </p>
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-400"></span>
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">
                            Posted: <?php echo isset($row['created_at']) ? date('M d, Y', strtotime($row['created_at'])) : 'Recently'; ?>
                        </span>
                    </div>
                </div>
            <?php endwhile; 
        else: ?>
            <p class="text-slate-400 text-sm text-center py-10">No new notices at this time.</p>
        <?php endif; ?>
    </div>

    <div class="h-4 bg-gradient-to-t from-white to-transparent shrink-0"></div>
</section>

            <div class="bg-slate-900 text-white p-8 rounded-2xl shadow-lg">
                <h3 class="text-xl font-bold mb-6">Campus Schedule</h3>
                <div class="space-y-6 border-l-2 border-indigo-500 pl-4">
                    <div class="relative"><div class="absolute -left-[21px] top-1 w-2 h-2 rounded-full bg-indigo-500"></div>
                        <h4 class="text-sm font-bold">09:00 AM</h4>
                        <p class="text-xs text-slate-400">Regular Lectures Begin</p>
                    </div>
                    <div class="relative"><div class="absolute -left-[21px] top-1 w-2 h-2 rounded-full bg-indigo-500"></div>
                        <h4 class="text-sm font-bold">11:30 AM</h4>
                        <p class="text-xs text-slate-400">Laboratory Practical Sessions</p>
                    </div>
                    <div class="relative"><div class="absolute -left-[21px] top-1 w-2 h-2 rounded-full bg-indigo-500"></div>
                        <h4 class="text-sm font-bold">02:00 PM</h4>
                        <p class="text-xs text-slate-400">Workshop & Club Activities</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <section id="contact" class="bg-slate-100 py-20">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Contact Us</h2>
            <div class="grid lg:grid-cols-2 gap-12 bg-white p-8 rounded-3xl shadow-sm">
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <i data-lucide="map-pin" class="text-indigo-600 mt-1"></i>
                        <p class="text-slate-600">Nagzira Road, Sakoli (441802), Maharashtra, India</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <i data-lucide="phone" class="text-indigo-600"></i>
                        <p class="text-slate-600">+91-7391058483</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <i data-lucide="mail" class="text-indigo-600"></i>
                        <p class="text-slate-600">Kcemsakoli@gmail.com</p>
                    </div>
                    
                    
                </div>
                <div class="rounded-2xl overflow-hidden h-[300px] border border-slate-100 shadow-inner">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2355.6595412530496!2d79.99872547267427!3d21.091676680573375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a2b73106c6ea98f%3A0x701bfabf07c95db6!2sKaranjekar%20College%20of%20Engineering%20and%20Management%2C%20Sakoli%2C%20Dist-Bhandara%20441802!5e1!3m2!1sen!2sin!4v1772955861288!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

 <footer class="bg-indigo-950 text-indigo-200 border-t border-indigo-900">
    
    <div class="max-w-7xl mx-auto px-6 py-12 grid md:grid-cols-4 gap-8">

        <!-- About -->
        <div>
            <h2 class="text-white text-lg font-semibold mb-4">
                KCEM Smart Campus
            </h2>
            <p class="text-sm opacity-80 leading-relaxed">
                KCEM Smart Campus Portal is a digital platform designed to
                streamline academic and administrative services for students,
                faculty, and staff of Karanjekar College of Engineering &
                Management, Sakoli.
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h2 class="text-white text-lg font-semibold mb-4">
                Quick Links
            </h2>

            <ul class="space-y-2 text-sm">
                <li><a href="#" class="hover:text-white transition">Home</a></li>
                <li><a href="#" class="hover:text-white transition">Student Portal</a></li>
                <li><a href="#" class="hover:text-white transition">Attendance</a></li>
                <li><a href="#courses" class="hover:text-white transition">Departments</a></li>
                <li><a href="#" class="hover:text-white transition">Contact</a></li>
            </ul>
        </div>

        <!-- Contact -->
        <div>
            <h2 class="text-white text-lg font-semibold mb-4">
                Contact
            </h2>

            <ul class="text-sm space-y-2 opacity-80">
                <li>Email: info@kcem.edu</li>
                <li>Phone: +91 XXXXX XXXXX</li>
                <li>Sakoli, Bhandara District</li>
                <li>Maharashtra, India</li>
            </ul>
        </div>

        <!-- Social -->
        <div>
            <h2 class="text-white text-lg font-semibold mb-4">
                Follow Us
            </h2>

            <div class="flex justify-start space-x-4 text-sm">
                <a href="#" class="hover:text-white">Facebook</a>
                <a href="#" class="hover:text-white">Instagram</a>
                <a href="#" class="hover:text-white">LinkedIn</a>
                <a href="#" class="hover:text-white">YouTube</a>
            </div>
        </div>

    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-indigo-900 py-6 text-center text-xs opacity-60">
        © 2026 Karanjekar College of Engineering & Management, Sakoli.  
        Developed for the KCEM Smart Campus Portal.
    </div>

</footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>