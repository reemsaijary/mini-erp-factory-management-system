<div id="sidebar"
     class="w-64 bg-gradient-to-b from-blue-600 to-blue-700 text-white min-h-screen p-4 transition-all duration-300 overflow-hidden shadow-lg">

    <div class="flex items-center justify-between mb-8 px-2">

        <!-- LEFT: Title -->
        <div class="flex items-center gap-2">
            <h2 id="sidebarTitle" class="text-lg font-bold text-white">
                Employee Panel
            </h2>
        </div>

        <!-- RIGHT: Toggle -->
        <button id="sidebarToggle"
            class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center hover:bg-white/30 transition">
            <i class="fa-solid fa-bars text-sm"></i>
        </button>

    </div>

    <nav class="space-y-2 text-sm">

        <!-- Dashboard -->
        <a href="{{ route('employee.dashboard') }}"
           class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
           {{ request()->routeIs('employee.dashboard') ? 'bg-white/20 text-white shadow' : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-chart-line w-5 text-center"></i>
            <span class="label">Dashboard</span>
        </a>

        <!-- Check In / Check Out -->
        <a href="{{ route('employee.check') }}"
           class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
           {{ request()->routeIs('employee.check') ? 'bg-white/20 text-white shadow' : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-right-to-bracket w-5 text-center"></i>
            <span class="label">Check In / Check Out</span>
        </a>

        <!-- My Attendance -->
        <a href="{{ route('employee.attendance') }}"
           class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
           {{ request()->routeIs('employee.attendance') ? 'bg-white/20 text-white shadow' : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-clock w-5 text-center"></i>
            <span class="label">My Attendance</span>
        </a>

        <!-- My Profile -->
        <a href="{{ route('employee.profile') }}"
           class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
           {{ request()->routeIs('employee.profile') ? 'bg-white/20 text-white shadow' : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-user w-5 text-center"></i>
            <span class="label">My Profile</span>
        </a>

    </nav>

    <!-- Logout at bottom -->
    <div class="mt-10 pt-6 border-t border-white/20">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                type="submit"
                class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 hover:bg-white/10 text-left">
                <i class="fa-solid fa-right-from-bracket w-5 text-center"></i>
                <span class="label">Logout</span>
            </button>
        </form>
    </div>
</div>