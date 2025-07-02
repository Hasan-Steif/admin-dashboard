<aside id="sidebar" class="sidebar w-64 bg-white shadow-md border-r flex flex-col ml-0">
    <div class="p-4 text-2xl font-bold text-blue-600 border-b flex items-center justify-between">
        <span class="flex items-center">
            <i class="fas fa-shield-alt mr-2"></i> AdminPanel
        </span>
        <button id="toggle-sidebar" class="text-gray-500 hover:text-blue-600">
            <i id="sidebar-icon" class="fas fa-bars"></i>
        </button>
    </div>
    <nav class="p-4 space-y-2 text-sm flex-1">
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center px-3 py-2 rounded hover:bg-blue-100 @if (request()->routeIs('admin.dashboard')) bg-blue-50 text-blue-600 font-semibold @endif">
            <i class="fas fa-home mr-2"></i>
            <span class="sidebar-text">Dashboard</span>
        </a>
        <a href="{{route('admin.users.index')}}" class="flex items-center px-3 py-2 rounded hover:bg-blue-100">
            <i class="fas fa-users mr-2"></i>
            <span class="sidebar-text">Users</span>
        </a>
        <a href="#" class="flex items-center px-3 py-2 rounded hover:bg-blue-100">
            <i class="fas fa-cog mr-2"></i>
            <span class="sidebar-text">Settings</span>
        </a>
    </nav>
    <div class="p-4 border-t">
        <button id="toggle-theme" class="w-full text-left px-3 py-2 rounded hover:bg-blue-100 flex items-center">
            <i class="fas fa-moon mr-2"></i>
            <span class="sidebar-text">Toggle Theme</span>
        </button>
    </div>
</aside>
