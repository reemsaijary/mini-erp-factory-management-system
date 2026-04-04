<div id="sidebar"
     class="w-64 bg-gray-900 text-gray-200 min-h-screen p-4 transition-all duration-300 overflow-hidden shadow-lg">

    <!-- Title -->
    <h2 id="sidebarTitle" class="text-lg font-bold mb-6 text-white">
        Factory Management System
    </h2>

    <nav class="space-y-2 text-sm">

        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition-all duration-200
           {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fa-solid fa-chart-line w-5 text-center"></i>
            <span class="label">Dashboard</span>
        </a>

        <!-- Orders -->
        <a href="{{ route('orders.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition-all duration-200
           {{ request()->routeIs('orders.*') ? 'bg-blue-600 text-white shadow' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fa-solid fa-cart-shopping w-5 text-center"></i>
            <span class="label">Orders</span>
        </a>

        <!-- Production -->
        <a href="{{ route('production.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition-all duration-200
           {{ request()->routeIs('production.*') ? 'bg-blue-600 text-white shadow' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fa-solid fa-industry w-5 text-center"></i>
            <span class="label">Production</span>
        </a>

        <!-- Machines -->
        <a href="{{ route('machines.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition-all duration-200
           {{ request()->routeIs('machines.*') ? 'bg-blue-600 text-white shadow' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fa-solid fa-gears w-5 text-center"></i>
            <span class="label">Machines</span>
        </a>

        <!-- Products -->
        <a href="{{ route('products.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition-all duration-200
           {{ request()->routeIs('products.*') ? 'bg-blue-600 text-white shadow' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fa-solid fa-box w-5 text-center"></i>
            <span class="label">Products</span>
        </a>

        <!-- Employees -->
        <a href="{{ route('employees.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition-all duration-200
           {{ request()->routeIs('employees.*') ? 'bg-blue-600 text-white shadow' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fa-solid fa-users w-5 text-center"></i>
            <span class="label">Employees</span>
        </a>

        <!-- Attendance -->
        <a href="{{ route('attendance.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition-all duration-200
           {{ request()->routeIs('attendance.*') ? 'bg-blue-600 text-white shadow' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fa-solid fa-clock w-5 text-center"></i>
            <span class="label">Attendance</span>
        </a>

        <!-- Maintenance -->
        <a href="{{ route('maintenance.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition-all duration-200
           {{ request()->routeIs('maintenance.*') ? 'bg-blue-600 text-white shadow' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fa-solid fa-screwdriver-wrench w-5 text-center"></i>
            <span class="label">Maintenance</span>
        </a>

        <!-- Payroll -->
        <a href="{{ route('payroll.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition-all duration-200
           {{ request()->routeIs('payroll.*') ? 'bg-blue-600 text-white shadow' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fa-solid fa-wallet w-5 text-center"></i>
            <span class="label">Payroll</span>
        </a>

        <!-- Reports -->
        <a href="{{ route('reports.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition-all duration-200
           {{ request()->routeIs('reports.*') ? 'bg-blue-600 text-white shadow' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fa-solid fa-chart-pie w-5 text-center"></i>
            <span class="label">Reports</span>
        </a>

        <!-- Settings -->
        <a href="{{ route('settings.edit') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition-all duration-200
           {{ request()->routeIs('settings.*') ? 'bg-blue-600 text-white shadow' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fa-solid fa-gear w-5 text-center"></i>
            <span class="label">Settings</span>
        </a>

    </nav>
</div>