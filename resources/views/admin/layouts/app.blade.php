<!-- Layout File: resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="{{ asset('js/dashboard.js') }}" defer></script>


</head>

<body class="bg-gray-100 text-gray-800 font-sans antialiased transition-colors duration-300">
    <div class="flex min-h-screen">
        @include('admin.layouts.sidebar')
        <div id="main-content" class="flex-1 flex flex-col transition-all duration-300 ease-in-out ml-0">
            @include('admin.layouts.navbar')
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
