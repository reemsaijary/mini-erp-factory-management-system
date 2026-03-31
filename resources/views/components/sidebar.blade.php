<div id="sidebar" class="w-64 bg-gray-800 text-white min-h-screen p-4 transition-all duration-300 overflow-hidden">

    <h2 id="sidebarTitle" class="text-lg font-bold mb-6">
        Factory Management System 
    </h2>

    <nav class="space-y-2">

        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-3 py-2 rounded sidebar-item transition-all duration-200
           {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
            <span>📊</span>
            <span class="label">Dashboard</span>
        </a>

        <a href="#"
           class="flex items-center gap-3 px-3 py-2 rounded sidebar-item hover:bg-gray-700 transition-all duration-200">
            <span>📦</span>
            <span class="label">Orders</span>
        </a>

        <a href="#"
           class="flex items-center gap-3 px-3 py-2 rounded sidebar-item hover:bg-gray-700 transition-all duration-200">
            <span>🏭</span>
            <span class="label">Production</span>
        </a>

        <a href="{{ route('employees.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded sidebar-item transition-all duration-200
           {{ request()->routeIs('employees.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
            <span>👤</span>
            <span class="label">Employees</span>
        </a>

        <a href="{{ route('attendance.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded sidebar-item hover:bg-gray-700 transition-all duration-200">
            <span>🕒</span>
            <span class="label">Attendance</span>
        </a>

        <a href="#"
           class="flex items-center gap-3 px-3 py-2 rounded sidebar-item hover:bg-gray-700 transition-all duration-200">
            <span>🛠</span>
            <span class="label">Maintenance</span>
        </a>

        <a href="#"
           class="flex items-center gap-3 px-3 py-2 rounded sidebar-item hover:bg-gray-700 transition-all duration-200">
            <span>💰</span>
            <span class="label">Payroll</span>
        </a>

        <a href="#"
           class="flex items-center gap-3 px-3 py-2 rounded sidebar-item hover:bg-gray-700 transition-all duration-200">
            <span>📈</span>
            <span class="label">Reports</span>
        </a>

        <a href="#"
           class="flex items-center gap-3 px-3 py-2 rounded sidebar-item hover:bg-gray-700 transition-all duration-200">
            <span>⚙️</span>
            <span class="label">Settings</span>
        </a>

    </nav>
</div>