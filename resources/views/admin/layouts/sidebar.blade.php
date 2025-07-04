<aside id="sidebar" class="sidebar fixed top-0 w-16 h-screen bg-white shadow-xl border-r flex flex-col transition-all duration-300 z-50">
    <!-- Sidebar Header -->
    <div class="p-4 text-2xl font-extrabold text-blue-600 border-b flex items-center justify-center">
        <i class="fas fa-shield-alt text-blue-500"></i>
        <button id="toggle-sidebar" class="absolute right-2 text-gray-500 hover:text-blue-600 focus:outline-none">
            <i id="sidebar-icon" class="fas fa-bars text-lg"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-2 space-y-2 text-sm overflow-y-auto">
        <!-- Dashboard -->
        @can('view dashboard')
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center justify-center p-3 rounded-lg hover:bg-blue-50 @if (request()->routeIs('admin.dashboard')) bg-blue-100 text-blue-700 @endif transition-colors duration-200"
               title="Dashboard">
                <i class="fas fa-home text-blue-500 text-lg"></i>
            </a>
        @endcan

        <!-- Users Management (Collapsible) -->
        @can('manage users')
            <div class="group">
                <button class="flex items-center justify-center w-full p-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-700 transition-colors duration-200"
                        onclick="toggleMenu('users-menu')"
                        title="Users">
                    <i class="fas fa-users text-blue-500 text-lg"></i>
                </button>
                <div id="users-menu" class="hidden pl-4 space-y-1 mt-1">
                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center justify-center p-2 rounded-lg hover:bg-blue-50 @if (request()->routeIs('admin.users.*')) bg-blue-100 text-blue-700 @endif transition-colors duration-200"
                       title="All Users">
                        <i class="fas fa-user text-blue-500 text-sm"></i>
                    </a>
                </div>
            </div>
        @endcan

        <!-- Posts Management (Collapsible) -->
        @can('manage posts')
            <div class="group">
                <button class="flex items-center justify-center w-full p-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-700 transition-colors duration-200"
                        onclick="toggleMenu('posts-menu')"
                        title="Posts">
                    <i class="fas fa-newspaper text-blue-500 text-lg"></i>
                </button>
                <div id="posts-menu" class="hidden pl-4 space-y-1 mt-1">
                    <a href="{{ route('admin.posts.index') }}"
                       class="flex items-center justify-center p-2 rounded-lg hover:bg-blue-50 @if (request()->routeIs('admin.posts.*')) bg-blue-100 text-blue-700 @endif transition-colors duration-200"
                       title="All Posts">
                        <i class="fas fa-file-alt text-blue-500 text-sm"></i>
                    </a>
                </div>
            </div>
        @endcan

        <!-- Categories Management (Collapsible) -->
        @can('manage categories')
            <div class="group">
                <button class="flex items-center justify-center w-full p-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-700 transition-colors duration-200"
                        onclick="toggleMenu('categories-menu')"
                        title="Categories">
                    <i class="fas fa-folder-open text-blue-500 text-lg"></i>
                </button>
                <div id="categories-menu" class="hidden pl-4 space-y-1 mt-1">
                    <a href="{{ route('admin.categories.index') }}"
                       class="flex items-center justify-center p-2 rounded-lg hover:bg-blue-50 @if (request()->routeIs('admin.categories.*')) bg-blue-100 text-blue-700 @endif transition-colors duration-200"
                       title="All Categories">
                        <i class="fas fa-folder text-blue-500 text-sm"></i>
                    </a>
                </div>
            </div>
        @endcan

        <!-- Comments Management (Collapsible) -->
        @can('manage comments')
            <div class="group">
                <button class="flex items-center justify-center w-full p-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-700 transition-colors duration-200"
                        onclick="toggleMenu('comments-menu')"
                        title="Comments">
                    <i class="fas fa-comments text-blue-500 text-lg"></i>
                </button>
                <div id="comments-menu" class="hidden pl-4 space-y-1 mt-1">
                    <a href="{{ route('admin.comments.index') }}"
                       class="flex items-center justify-center p-2 rounded-lg hover:bg-blue-50 @if (request()->routeIs('admin.comments.*')) bg-blue-100 text-blue-700 @endif transition-colors duration-200"
                       title="All Comments">
                        <i class="fas fa-comment text-blue-500 text-sm"></i>
                    </a>
                </div>
            </div>
        @endcan

        <!-- Roles Management (Collapsible) -->
        @can('manage roles')
            <div class="group">
                <button class="flex items-center justify-center w-full p-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-700 transition-colors duration-200"
                        onclick="toggleMenu('roles-menu')"
                        title="Roles">
                    <i class="fas fa-user-shield text-blue-500 text-lg"></i>
                </button>
                <div id="roles-menu" class="hidden pl-4 space-y-1 mt-1">
                    <a href="{{ route('admin.roles.index') }}"
                       class="flex items-center justify-center p-2 rounded-lg hover:bg-blue-50 @if (request()->routeIs('admin.roles.*')) bg-blue-100 text-blue-700 @endif transition-colors duration-200"
                       title="All Roles">
                        <i class="fas fa-shield-alt text-blue-500 text-sm"></i>
                    </a>
                </div>
            </div>
        @endcan

        <!-- Permissions Management (Collapsible) -->
        @can('manage permissions')
            <div class="group">
                <button class="flex items-center justify-center w-full p-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-700 transition-colors duration-200"
                        onclick="toggleMenu('permissions-menu')"
                        title="Permissions">
                    <i class="fas fa-key text-blue-500 text-lg"></i>
                </button>
                <div id="permissions-menu" class="hidden pl-4 space-y-1 mt-1">
                    <a href="{{ route('admin.permissions.index') }}"
                       class="flex items-center justify-center p-2 rounded-lg hover:bg-blue-50 @if (request()->routeIs('admin.permissions.*')) bg-blue-100 text-blue-700 @endif transition-colors duration-200"
                       title="All Permissions">
                        <i class="fas fa-lock text-blue-500 text-sm"></i>
                    </a>
                </div>
            </div>
        @endcan

        <!-- Settings -->
        @can('access settings')
            <a href="#" class="flex items-center justify-center p-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-700 transition-colors duration-200"
               title="Settings">
                <i class="fas fa-cog text-blue-500 text-lg"></i>
            </a>
        @endcan
    </nav>

    <!-- Theme Toggle -->
    <div class="p-2 border-t">
        <button id="toggle-theme" class="w-full flex items-center justify-center p-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-700 transition-colors duration-200"
                title="Toggle Theme">
            <i class="fas fa-moon text-blue-500 text-lg"></i>
        </button>
    </div>

    <!-- JavaScript for Collapsible Menus and Sidebar Toggle -->
    <script>
        function toggleMenu(menuId) {
            const menu = document.getElementById(menuId);
            menu.classList.toggle('hidden');
        }

        document.getElementById('toggle-sidebar').addEventListener('click', () => {
            const sidebar = document.getElementById('sidebar');
            const icon = document.getElementById('sidebar-icon');
            sidebar.classList.toggle('w-16');
            sidebar.classList.toggle('w-20');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });

        document.getElementById('toggle-theme').addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        });

        // Load theme from localStorage
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

    <style>
        /* Dark Mode Styles */
        .dark .sidebar {
            background-color: #1f2937;
            border-color: #374151;
        }
        .dark .sidebar .text-blue-600,
        .dark .sidebar .text-gray-700 {
            color: #93c5fd;
        }
        .dark .sidebar .hover \:bg-blue-50:hover,
        .dark .sidebar .bg-blue-50,
        .dark .sidebar .bg-blue-100 {
            background-color: #374151;
        }
        .dark .sidebar .text-blue-500 {
            color: #60a5fa;
        }
        .dark .sidebar .border-b,
        .dark .sidebar .border-t {
            border-color: #374151;
        }

        /* Tooltip Styles */
        [title]:hover:after {
            content: attr(title);
            position: absolute;
            left: 4.5rem;
            background: #1f2937;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            white-space: nowrap;
            z-index: 50;
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
        }
        [title]:hover:after {
            opacity: 1;
        }
    </style>
</aside>