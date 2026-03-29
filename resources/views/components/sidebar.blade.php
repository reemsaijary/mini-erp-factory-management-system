<div id="sidebar" class="w-64 bg-gray-800 text-white min-h-screen p-4 transition-all duration-300">

    <h2 id="sidebarTitle" class="text-lg font-bold mb-6 leading-snug">
        Factory Management System
    </h2>

    <nav class="space-y-2">

        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700">
            Dashboard
        </a>

        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700">
            Orders
        </a>

        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700">
            Production
        </a>

        <a href="{{ route('employees.index') }}"
           class="block px-3 py-2 rounded {{ request()->routeIs('employees.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
            Employees
        </a>

        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700">
            Attendance
        </a>

        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700">
            Maintenance
        </a>

        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700">
            Payroll
        </a>

        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700">
            Reports
        </a>

        <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700">
            Settings
        </a>

    </nav>
</div>