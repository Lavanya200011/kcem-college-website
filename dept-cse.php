<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>CSE Department | KCEM Sakoli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
        .cse-gradient {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
        }

         @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-reveal {
            animation: fadeInUp 0.8s ease-out forwards;
        }
    </style>
</head>
<body class="bg-slate-50 font-sans text-slate-900">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <img src="images/cse-22.jpg" alt="CSE Logo" class="h-12 w-12 rounded-lg object-cover shadow-sm">
                <div>
                    <h1 class="text-lg font-bold text-indigo-950 leading-tight">Department of CSE</h1>
                    <p class="text-xs text-indigo-600 font-bold uppercase tracking-widest">KCEM Sakoli</p>
                </div>
            </div>
            <a href="index.php" class="flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-indigo-600 transition-colors">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
                <span>Back to Home</span>
            </a>
        </div>
    </nav>

    <div class="cse-gradient text-white py-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 relative z-10 text-center lg:text-left flex flex-col lg:flex-row items-center justify-between gap-12 animate-reveal">
            <div class="lg:w-2/3">
                <span class="bg-orange-500 text-white px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-6 inline-block">Established Department</span>
                <h2 class="text-4xl md:text-5xl font-black mb-6 leading-tight">Innovating the Digital <br><span class="text-orange-400">Frontier of Tomorrow</span></h2>
                <p class="text-indigo-100 text-lg mb-8 max-w-2xl leading-relaxed opacity-90">
                    The Computer Science and Engineering department focuses on theoretical foundations and practical applications, 
                    creating world-ready software engineers and tech leaders.
                </p>
                <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                    <div class="bg-white/10 border border-white/20 px-6 py-3 rounded-2xl">
                        <p class="text-xs uppercase opacity-60">Annual Intake</p>
                        <p class="text-xl font-bold">120 Seats</p>
                    </div>
                    <div class="bg-white/10 border border-white/20 px-6 py-3 rounded-2xl">
                        <p class="text-xs uppercase opacity-60">Course Duration</p>
                        <p class="text-xl font-bold">4 Years</p>
                    </div>
                </div>
            </div>
            <div class="lg:w-1/3">
                <img src="images/dept-cse.jpg" alt="Coding" class="rounded-3xl shadow-2xl border-8 border-white/10 rotate-3 hover:rotate-0 transition-transform duration-500">
            </div>
           </div>
            <div class="absolute top-0 right-0 opacity-10 pointer-events-none animate-pulse">
                <i data-lucide="network" class="w-96 h-96"></i>
            </div>
        </div>

    <main class="max-w-7xl mx-auto px-4 -mt-10 relative z-20 pb-20">
        
        <section class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 md:p-12 mb-16 flex flex-col md:flex-row gap-12 items-center animate-reveal">
            <div class="w-full md:w-1/3">
                <div class="relative group">
                    <div class="absolute -inset-2 bg-gradient-to-r from-orange-500 to-indigo-600 rounded-3xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                    <img src="images/HOD_CSE.jpg" alt="HOD" class="relative rounded-2xl w-full h-[400px] shadow-lg object-cover transition-transform duration-500 group-hover:scale-[1.02]">
                </div>
            </div>
            <div class="w-full md:w-2/3">
                <i data-lucide="quote" class="text-indigo-100 w-16 h-16 absolute -top-4 -left-4"></i>
                <h2 class="text-3xl font-bold text-slate-800 mb-2">From the HOD's Desk</h2>
                <h3 class="text-indigo-600 font-bold text-xl mb-6">Mrs. Sneha G. Gobade</h3>
                <p class="text-slate-600 leading-relaxed italic text-lg mb-6">
                    "We strive to equip our students with the knowledge and skills necessary to become problem-solvers in the ever-evolving world of technology. Our industry-focused curriculum ensures that our students are well-prepared to meet the challenges of tomorrow."
                </p>
                <div class="flex items-center gap-4">
                    <div class="h-1 w-12 bg-orange-500"></div>
                    <span class="text-sm font-bold uppercase tracking-widest text-slate-400">Head of Department</span>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
            <div class="bg-white p-8 rounded-3xl border border-slate-100 hover:shadow-2xl hover:-translate-y-2 transition-all group">
                <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-indigo-600 transition-colors">
                    <i data-lucide="monitor" class="text-indigo-600 group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">Computing Labs</h3>
                <ul class="text-slate-500 space-y-3 text-sm">
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500"></i> High-speed 100Mbps LAN</li>
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500"></i> AI & ML Dedicated Lab</li>
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500"></i> 24/7 Access to Servers</li>
                </ul>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-slate-100 hover:shadow-2xl hover:-translate-y-2 transition-all group">
                <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-orange-500 transition-colors">
                    <i data-lucide="library" class="text-orange-600 group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">Academic Resources</h3>
                <ul class="text-slate-500 space-y-3 text-sm">
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500"></i> 2000+ Departmental Books</li>
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500"></i> Smart Digital Classrooms</li>
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500"></i> E-Journal Subscriptions</li>
                </ul>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-slate-100 hover:shadow-2xl hover:-translate-y-2 transition-all group">
                <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-green-600 transition-colors">
                    <i data-lucide="briefcase" class="text-green-600 group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">Career Focus</h3>
                <ul class="text-slate-500 space-y-3 text-sm">
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500"></i> Industry Internships</li>
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500"></i> Placement Bootcamps</li>
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500"></i> Innovation Research Center</li>
                </ul>
            </div>
        </div>

    </main>

    <footer class="bg-indigo-950 text-indigo-200 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-sm opacity-60">© 2026 Karanjekar College of Engineering & Management, Sakoli</p>
            <p class="text-xs mt-2 opacity-40 uppercase tracking-widest">Empowering Minds • Designing Future</p>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>