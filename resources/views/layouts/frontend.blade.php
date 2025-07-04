<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | My Blog</title>
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Custom animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }
        /* Custom blue accent */
        .btn-blue {
            background-color: #1e40af; /* Professional blue */
            transition: background-color 0.3s ease;
        }
        .btn-blue:hover {
            background-color: #1e3a8a;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="text-2xl font-bold text-blue-600">
                    <a href="/">My Blog</a>
                </div>
                <div class="space-x-4">
                    <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-blue-600 transition">Categories</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 transition">About</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 transition">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">About Us</h3>
                    <p class="text-gray-400">A modern blog platform sharing knowledge and insights across various categories.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('categories.index') }}" class="text-gray-400 hover:text-blue-400 transition">Categories</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition">Terms of Service</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-8 text-center text-gray-400">
                © {{ date('Y') }} My Blog. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="fixed bottom-4 right-4 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition">
        <i class="fas fa-arrow-up"></i>
    </button>
</body>
</html>