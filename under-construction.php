<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Construction | KCEM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .float-animation { animation: float 3s ease-in-out infinite; }
    </style>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen px-4">

    <div class="max-w-2xl text-center">
        <div class="mb-8 flex justify-center">
            <div class="relative">
                <div class="float-animation text-6xl">🚧</div>
                <div class="absolute -bottom-2 -right-2 text-4xl">🛠️</div>
            </div>
        </div>

        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4 tracking-tight">
            Something <span class="text-indigo-500">Big</span> is Coming.
        </h1>
        <p class="text-gray-400 text-lg md:text-xl mb-8">
            We're currently working hard to bring you the best experience for the **KCEM Portal**. 
            This page is under maintenance and will be back shortly!
        </p>

        <div class="w-full bg-gray-800 rounded-full h-4 mb-10 overflow-hidden">
            <div class="bg-indigo-600 h-full rounded-full transition-all duration-1000" style="width: 75%"></div>
        </div>

        <div class="flex flex-col md:flex-row gap-4 justify-center">
            <a href="index.php" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg transition duration-300">
                Go to dashboard
            </a>
            <button onclick="window.location.reload()" class="bg-transparent border border-gray-600 hover:border-gray-400 text-gray-400 py-3 px-8 rounded-lg transition duration-300">
                Refresh Page
            </a>
        </div>

        <p class="mt-12 text-gray-600 text-sm">
            &copy; <?php echo date("Y"); ?> KCEM Portal. All rights reserved.
        </p>
    </div>

</body>
</html>