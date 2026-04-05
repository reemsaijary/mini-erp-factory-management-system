<div id="sidebar"
     class="w-64 bg-gradient-to-b from-blue-600 to-blue-700 text-white min-h-screen p-4 transition-all duration-300 overflow-hidden shadow-lg">


 <div class="flex items-center justify-between mb-8 px-2">

    <!-- LEFT: Title -->
    <div class="flex items-center gap-2">
        <h2 id="sidebarTitle" class="text-lg font-bold text-white">
            Admin Dashboard
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
        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
           {{ request()->routeIs('admin.dashboard') ? 'bg-white/20 text-white shadow' : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-chart-line w-5 text-center"></i>
            <span class="label">Dashboard</span>
        </a>

        <!-- Orders -->
        <a href="{{ route('orders.index') }}"
           class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
           {{ request()->routeIs('orders.*') ? 'bg-white/20 text-white shadow' : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-cart-shopping w-5 text-center"></i>
            <span class="label">Orders</span>
        </a>

        <!-- Production -->
        <a href="{{ route('production.index') }}"
           class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
           {{ request()->routeIs('production.*') ? 'bg-white/20 text-white shadow' : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-industry w-5 text-center"></i>
            <span class="label">Production</span>
        </a>

        <!-- Machines -->
        <a href="{{ route('machines.index') }}"
           class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
           {{ request()->routeIs('machines.*') ? 'bg-white/20 text-white shadow' : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-gears w-5 text-center"></i>
            <span class="label">Machines</span>
        </a>

        <!-- Products -->
        <a href="{{ route('products.index') }}"
           class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
           {{ request()->routeIs('products.*') ? 'bg-white/20 text-white shadow' : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-box w-5 text-center"></i>
            <span class="label">Products</span>
        </a>

        <!-- Employees -->
        <a href="{{ route('employees.index') }}"
           class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
           {{ request()->routeIs('employees.*') ? 'bg-white/20 text-white shadow' : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-users w-5 text-center"></i>
            <span class="label">Employees</span>
        </a>

        <!-- Attendance -->
        <a href="{{ route('attendance.index') }}"
           class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
           {{ request()->routeIs('attendance.*') ? 'bg-white/20 text-white shadow' : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-clock w-5 text-center"></i>
            <span class="label">Attendance</span>
        </a>

        <!-- Maintenance -->
        <a href="{{ route('maintenance.index') }}"
           class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
           {{ request()->routeIs('maintenance.*') ? 'bg-white/20 text-white shadow' : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-screwdriver-wrench w-5 text-center"></i>
            <span class="label">Maintenance</span>
        </a>

        <!-- Payroll -->
        <a href="{{ route('payroll.index') }}"
           class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
           {{ request()->routeIs('payroll.*') ? 'bg-white/20 text-white shadow' : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-wallet w-5 text-center"></i>
            <span class="label">Payroll</span>
        </a>

        <!-- Reports -->
        <a href="{{ route('reports.index') }}"
           class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
           {{ request()->routeIs('reports.*') ? 'bg-white/20 text-white shadow' : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-chart-pie w-5 text-center"></i>
            <span class="label">Reports</span>
        </a>

        <!-- Settings -->
        <a href="{{ route('settings.edit') }}"
           class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200
           {{ request()->routeIs('settings.*') ? 'bg-white/20 text-white shadow' : 'hover:bg-white/10' }}">
            <i class="fa-solid fa-gear w-5 text-center"></i>
            <span class="label">Settings</span>
        </a>

    </nav>
</div>