<aside id="sidebar" class="sidebar fixed top-0 left-0 w-64 h-screen bg-white shadow-xl border-r flex flex-col z-50">
    <div class="p-4 text-2xl font-extrabold text-blue-600 border-b flex items-center justify-start space-x-3">
        <i class="fas fa-shield-alt text-blue-500"></i>
        <span class="text-lg font-semibold text-gray-800">Admin Panel</span>
    </div>

    <nav class="flex-1 p-4 space-y-2 text-sm overflow-y-auto">
        @can('view dashboard')
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 @if (request()->routeIs('admin.dashboard')) bg-blue-100 text-blue-700 @endif transition duration-200">
                <i class="fas fa-home text-blue-500 text-lg"></i>
                <span>Dashboard</span>
            </a>
        @endcan
        @can('manage users')
            <a href="{{ route('admin.users.index') }}"
               class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 @if (request()->routeIs('admin.users.*')) bg-blue-100 text-blue-700 @endif transition duration-200">
                <i class="fas fa-users text-blue-500 text-lg"></i>
                <span>Users</span>
            </a>
        @endcan
        @can('manage posts')
            <a href="{{ route('admin.posts.index') }}"
               class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 @if (request()->routeIs('admin.posts.*')) bg-blue-100 text-blue-700 @endif transition duration-200">
                <i class="fas fa-newspaper text-blue-500 text-lg"></i>
                <span>Posts</span>
            </a>
        @endcan
        @can('manage categories')
            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 @if (request()->routeIs('admin.categories.*')) bg-blue-100 text-blue-700 @endif transition duration-200">
                <i class="fas fa-folder-open text-blue-500 text-lg"></i>
                <span>Categories</span>
            </a>
        @endcan
        @can('manage comments')
            <a href="{{ route('admin.comments.index') }}"
               class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 @if (request()->routeIs('admin.comments.*')) bg-blue-100 text-blue-700 @endif transition duration-200">
                <i class="fas fa-comments text-blue-500 text-lg"></i>
                <span>Comments</span>
            </a>
        @endcan
        @can('manage roles')
            <a href="{{ route('admin.roles.index') }}"
               class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 @if (request()->routeIs('admin.roles.*')) bg-blue-100 text-blue-700 @endif transition duration-200">
                <i class="fas fa-user-shield text-blue-500 text-lg"></i>
                <span>Roles</span>
            </a>
        @endcan
        @can('manage permissions')
            <a href="{{ route('admin.permissions.index') }}"
               class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 @if (request()->routeIs('admin.permissions.*')) bg-blue-100 text-blue-700 @endif transition duration-200">
                <i class="fas fa-key text-blue-500 text-lg"></i>
                <span>Permissions</span>
            </a>
        @endcan
        @can('access settings')
            <a href="#"
               class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-700 transition duration-200">
                <i class="fas fa-cog text-blue-500 text-lg"></i>
                <span>Settings</span>
            </a>
        @endcan
    </nav>

    <div class="p-4 border-t">
        <button id="toggle-theme" class="flex items-center gap-3 w-full p-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-700 transition duration-200">
            <i class="fas fa-moon text-blue-500 text-lg"></i>
            <span>Toggle Theme</span>
        </button>
    </div>

    <script>
        document.getElementById('toggle-theme')?.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        });

        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

    <style>
        .dark .sidebar {
            background-color: #1f2937;
            border-color: #374151;
        }
        .dark .sidebar .text-gray-700 {
            color: #cbd5e1;
        }
        .dark .sidebar .hover\:bg-blue-50:hover,
        .dark .sidebar .bg-blue-50,
        .dark .sidebar .bg-blue-100 {
            background-color: #374151;
        }
        .dark .sidebar .text-blue-500 {
            color: #60a5fa;
        }
    </style>
</aside>
