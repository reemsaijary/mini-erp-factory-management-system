<x-layouts.employee>

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Employee Dashboard</h1>
    </div>

    <!-- Welcome + Date -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4 mb-6">

        <!-- Welcome Card -->
        <div class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xl font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-slate-800">
                        Welcome {{ auth()->user()->name }}
                    </h2>
                </div>
            </div>
        </div>

        <!-- Today Date Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <p class="text-sm text-gray-500 mb-2">Today Date</p>
            <h3 class="text-2xl font-bold text-slate-800">
                {{ \Carbon\Carbon::today()->format('d M Y') }}
            </h3>
        </div>
    </div>

    <!-- Attendance Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">

        <!-- Today Status -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <p class="text-sm text-gray-500 mb-3">Today Status</p>

            @if($todayStatus === 'Late')
                <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-sm font-medium text-red-700 mb-3">
                    Late
                </span>
            @elseif($todayStatus === 'Present')
                <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-sm font-medium text-yellow-700 mb-3">
                    Present
                </span>
            @elseif($todayStatus === 'Completed')
                <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-700 mb-3">
                    Completed
                </span>
            @else
                <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-700 mb-3">
                    Not Checked In Yet
                </span>
            @endif

            <h3 class="text-xl font-bold text-slate-800">
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

    <!-- Tasks Overview -->
    <div class="mb-4">
        <h2 class="text-lg font-semibold text-slate-800">Tasks Overview</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">

        <a href="{{ route('employee.tasks') }}"
           class="block bg-white rounded-2xl shadow-sm border border-gray-100 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <p class="text-sm text-gray-500 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-list-check text-slate-500"></i>
                My Tasks
            </p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $totalTasks }}</h3>
        </a>

        <a href="{{ route('employee.tasks', ['status' => 'waiting']) }}"
           class="block bg-white rounded-2xl shadow-sm border border-gray-100 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <p class="text-sm text-gray-500 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-clock text-yellow-500"></i>
                Waiting Tasks
            </p>
            <h3 class="text-2xl font-bold text-yellow-600">{{ $waitingTasks }}</h3>
        </a>

        <a href="{{ route('employee.tasks', ['status' => 'in_production']) }}"
           class="block bg-white rounded-2xl shadow-sm border border-gray-100 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <p class="text-sm text-gray-500 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-gears text-blue-500"></i>
                In Production
            </p>
            <h3 class="text-2xl font-bold text-blue-600">{{ $inProductionTasks }}</h3>
        </a>

        <a href="{{ route('employee.tasks', ['status' => 'completed']) }}"
           class="block bg-white rounded-2xl shadow-sm border border-gray-100 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <p class="text-sm text-gray-500 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-green-500"></i>
                Completed Tasks
            </p>
            <h3 class="text-2xl font-bold text-green-600">{{ $completedTasks }}</h3>
        </a>

    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-semibold text-slate-800 mb-4">Quick Actions</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">

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

            <a href="{{ route('employee.tasks') }}"
               class="rounded-2xl bg-orange-100 p-5 border border-orange-200 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                <h3 class="text-lg font-semibold text-orange-700">My Tasks</h3>
                <p class="text-sm text-orange-600 mt-2">View your assigned production tasks</p>
            </a>

        </div>
    </div>

</x-layouts.employee>