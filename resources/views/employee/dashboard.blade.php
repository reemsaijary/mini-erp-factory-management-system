<x-layouts.employee>

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Employee Dashboard</h1>
    </div>

    <!-- Welcome Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
        <h2 class="text-xl font-semibold text-slate-800">
            Welcome {{ auth()->user()->name }} 
        </h2>
    </div>

    <!-- Status Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

        <!-- Today Status -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <p class="text-sm text-gray-500 mb-2">Today Status</p>
            <h3 class="text-2xl font-bold
                @if($todayStatus === 'Late') text-red-600
                @elseif($todayStatus === 'Present') text-yellow-600
                @elseif($todayStatus === 'Completed') text-green-600
                @else text-gray-700
                @endif">
                {{ $todayStatus }}
            </h3>
        </div>

        <!-- Check In -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <p class="text-sm text-gray-500 mb-2">Check In</p>
            <h3 class="text-2xl font-bold text-slate-800">
                {{ $checkInTime ?? '-' }}
            </h3>
        </div>

        <!-- Check Out -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <p class="text-sm text-gray-500 mb-2">Check Out</p>
            <h3 class="text-2xl font-bold text-slate-800">
                {{ $checkOutTime ?? '-' }}
            </h3>
        </div>

        <!-- Total Hours -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <p class="text-sm text-gray-500 mb-2">Total Hours</p>
            <h3 class="text-2xl font-bold text-slate-800">
                {{ $totalHours ?? '-' }}
            </h3>
        </div>

    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-semibold text-slate-800 mb-4">Quick Actions</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <a href="{{ route('employee.check') }}"
               class="rounded-2xl bg-green-100 p-5 border border-green-200 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                <h3 class="text-lg font-semibold text-green-700">Check In / Check Out</h3>
                <p class="text-sm text-green-600 mt-2">Manage your attendance for today</p>
            </a>

            <a href="{{ route('employee.attendance') }}"
               class="rounded-2xl bg-blue-100 p-5 border border-blue-200 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                <h3 class="text-lg font-semibold text-blue-700">My Attendance</h3>
                <p class="text-sm text-blue-600 mt-2">View your attendance history</p>
            </a>

            <a href="{{ route('employee.profile') }}"
               class="rounded-2xl bg-purple-100 p-5 border border-purple-200 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                <h3 class="text-lg font-semibold text-purple-700">My Profile</h3>
                <p class="text-sm text-purple-600 mt-2">View your personal information</p>
            </a>

        </div>
    </div>

</x-layouts.employee>