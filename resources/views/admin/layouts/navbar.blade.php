<header class="bg-white border-b shadow px-6 py-4 flex justify-between items-center">
    <h1 class="text-lg font-semibold flex items-center">
        <i class="fas fa-tachometer-alt mr-2 text-blue-600"></i> @yield('title', 'Dashboard')
    </h1>
    <div class="flex items-center gap-4">
        <button id="toggle-notifications" class="relative text-gray-500 hover:text-blue-600">
            <i class="fas fa-bell"></i>
            <span id="notification-count"
                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
        </button>
        <span class="text-sm flex items-center">
            <i class="fas fa-user-circle mr-2 text-blue-600"></i> {{ Auth::user()->name }}
        </span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-red-600 text-sm hover:underline flex items-center">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
        </form>
    </div>
</header>
