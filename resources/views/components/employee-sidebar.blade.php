<div id="sidebar" class="w-64 bg-blue-600 text-white min-h-screen p-4">

    <!-- Title -->
    <h2 class="text-lg font-bold mb-6">
        Employee Dashboard
    </h2>

    <!-- Menu -->
    <ul class="space-y-4">

        <li>
            <a href="{{ route('employee.dashboard') }}" class="block hover:bg-blue-500 p-2 rounded">
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('employee.check') }}" class="block hover:bg-blue-500 p-2 rounded">
                Check In / Check Out
            </a>
        </li>

        <li>
            <a href="{{ route('employee.attendance') }}" class="block hover:bg-blue-500 p-2 rounded">
                My Attendance
            </a>
        </li>

        <li>
            <a href="{{ route('employee.profile') }}" class="block hover:bg-blue-500 p-2 rounded">
                My Profile
            </a>
        </li>

    </ul>

</div>