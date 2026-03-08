<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Civil Engineering | KCEM Sakoli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .aids-gradient {
            background: linear-gradient(135deg, #4c1d95 0%, #1e1b4b 100%);
        }
        /* Custom Fade-in Animation */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-reveal {
            animation: fadeInUp 0.8s ease-out forwards;
        }
    </style>
</head>
<body class="bg-slate-50 font-sans text-slate-900 overflow-x-hidden">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <img src="images/.jpg" alt="Civil_Logo" class="h-12 w-12 rounded-lg object-cover shadow-sm">
                <div>
                 <h1 class="text-lg font-bold text-indigo-950 leading-tight">Dept. of Civil Engineering</h1>                    <p class="text-xs text-purple-600 font-bold uppercase tracking-widest">KCEM Sakoli</p>
                </div>
            </div>
            <a href="index.php" class="flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-indigo-600 transition-all duration-300">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
                <span>Back to Home</span>
            </a>
        </div>
    </nav>

    <div class="aids-gradient text-white py-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 relative z-10 animate-reveal">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                <div class="lg:w-2/3 text-center lg:text-left">
                   <span class="bg-yellow-500 text-white px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-6 inline-block">Infrastructure & Sustainability</span>

                    <h2 class="text-4xl md:text-5xl font-black mb-6 leading-tight">
                        Building <span class="text-yellow-400">Infrastructure</span>,<br>
                        Designing <span class="text-yellow-400">Future Cities</span>
                    </h2>

                    <p class="text-indigo-100 text-lg mb-8 max-w-2xl leading-relaxed opacity-90">
                        Civil Engineering focuses on planning, designing and constructing infrastructure such as roads, bridges, dams and smart cities while ensuring sustainable development.
                    </p>
                    <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                        <div class="bg-white/10 border border-white/20 px-6 py-3 rounded-2xl hover:bg-white/20 transition-colors cursor-default">
                            <p class="text-xs uppercase opacity-60">Annual Intake</p>
                            <p class="text-xl font-bold">60 Seats</p>
                        </div>
                        <div class="bg-white/10 border border-white/20 px-6 py-3 rounded-2xl hover:bg-white/20 transition-colors cursor-default">
                            <p class="text-xs uppercase opacity-60">Tech Focus</p>
                            <p class="text-xl font-bold">Structural Design</p>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/3 flex justify-center">
                    <div class="relative group">
                        <div class="absolute inset-0 bg-purple-500 blur-3xl opacity-30 animate-pulse"></div>
                        <img src="images/.jpg" alt="Civil dept_image" class="relative rounded-3xl shadow-2xl border-4 border-white/20 w-80 h-auto transform group-hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 opacity-10 pointer-events-none animate-pulse">
             <i data-lucide="network" class="w-96 h-96"></i>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 -mt-10 relative z-20 pb-20">
        
        <section class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 md:p-12 mb-16 flex flex-col md:flex-row gap-12 items-center animate-reveal" style="animation-delay: 0.2s;">
            <div class="w-full md:w-1/3 shrink-0">
                <div class="relative group">
                    <div class="absolute -inset-2 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-3xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                    <img src="images/.jpg" alt="HOD Civil" class="relative rounded-2xl w-full h-[350px] object-cover shadow-lg transition-transform duration-500 group-hover:scale-[1.02]">
                </div>
            </div>
            <div class="w-full md:w-2/3 relative">
                <i data-lucide="brain-circuit" class="text-purple-100 w-20 h-20 absolute -top-6 -right-6 -z-10 opacity-50"></i>
                <h2 class="text-3xl font-bold text-slate-800 mb-2">From the HOD's Desk</h2>
                <h3 class="text-purple-600 font-bold text-xl mb-6">
                  Dr. Civil Department HOD Name
                </h3>

                <p class="text-slate-600 leading-relaxed italic text-lg mb-6">
                    "Our department focuses on developing skilled engineers capable of designing sustainable infrastructure and solving real-world construction challenges."
                </p>
                <div class="flex items-center gap-4">
                    <div class="h-1 w-12 bg-purple-500"></div>
                    <span class="text-sm font-bold uppercase tracking-widest text-slate-400">Head of AIDS Department</span>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
            
            <div class="bg-white p-8 rounded-3xl border border-slate-100 hover:shadow-2xl hover:-translate-y-3 transition-all duration-300 group">
                <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-purple-600 transition-all duration-300 transform group-hover:rotate-6">
                    <i data-lucide="database" class="text-purple-600 group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">Core Civil Labs</h3>
                <ul class="text-slate-500 space-y-3 text-sm">
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-purple-500"></i> Concrete Technology Lab</li>
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-purple-500"></i> Surveying & Geomatics Lab</li>
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-purple-500"></i> Geotechnical Engineering Lab</li>
                </ul>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-slate-100 hover:shadow-2xl hover:-translate-y-3 transition-all duration-300 group border-b-4 border-b-purple-500">
                <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-indigo-600 transition-all duration-300 transform group-hover:rotate-6">
                    <i data-lucide="cpu" class="text-indigo-600 group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-xl font-bold mb-4 group-hover:text-indigo-700 transition-colors">Smart Resources</h3>
                <ul class="text-slate-500 space-y-3 text-sm">
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-purple-500"></i> AutoCAD & Structural Design Software</li>
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-purple-500"></i> Survey Equipment & Total Station</li>
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-purple-500"></i> Construction Material Testing Lab</li>
                </ul>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-slate-100 hover:shadow-2xl hover:-translate-y-3 transition-all duration-300 group">
                <div class="w-14 h-14 bg-pink-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-pink-600 transition-all duration-300 transform group-hover:rotate-6">
                    <i data-lucide="zap" class="text-pink-600 group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-xl font-bold mb-4 group-hover:text-pink-700 transition-colors">Opportunities</h3>
                <ul class="text-slate-500 space-y-3 text-sm">
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-purple-500"></i> Construction Industry Internships</li>
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-purple-500"></i> Smart City Development Projects</li>
                    <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-purple-500"></i> Careers in Structural Engineering</li>
                </ul>
            </div>
        </div>
    </main>

    <footer class="bg-indigo-950 text-indigo-200 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-sm opacity-60">© 2026 Karanjekar College of Engineering & Management, Sakoli</p>
            <p class="text-xs mt-2 opacity-40 uppercase tracking-widest text-purple-400">Decoding Data • Engineering Intelligence</p>
        </div>
    </footer>

    <script>
        // Initialize icons after DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
</body>
</html>