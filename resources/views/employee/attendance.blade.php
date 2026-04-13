<x-layouts.employee>

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-slate-800">My Attendance</h1>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
        <form method="GET" action="{{ route('employee.attendance') }}">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search by Date</label>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by date (YYYY-MM-DD)"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select
                        name="status"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">All Statuses</option>
                        <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>Present</option>
                        <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Late</option>
                        <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <!-- Date Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Specific Date</label>
                    <input
                        type="date"
                        name="date"
                        value="{{ request('date') }}"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <!-- Buttons -->
                <div class="flex items-end gap-3">
                    <button
                        type="submit"
                        class="rounded-xl bg-blue-600 px-5 py-2.5 text-white font-medium hover:bg-blue-700 transition"
                    >
                        Filter
                    </button>

                    <a
                        href="{{ route('employee.attendance') }}"
                        class="rounded-xl bg-gray-200 px-5 py-2.5 text-gray-700 font-medium hover:bg-gray-300 transition"
                    >
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Attendance Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-slate-800">Attendance Records</h2>
            <span class="text-sm text-gray-500">Total Records: {{ $attendanceRecords->count() }}</span>
        </div>

        @if($attendanceRecords->isEmpty())
            <div class="p-10 text-center text-gray-500">
                No attendance records found.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-blue-600 text-white">
                       <tr>
                <th class="px-6 py-4 text-sm font-semibold">Date</th>
                <th class="px-6 py-4 text-sm font-semibold">Check In</th>
                <th class="px-6 py-4 text-sm font-semibold">Check Out</th>
                <th class="px-6 py-4 text-sm font-semibold">Total Hours</th>
                <th class="px-6 py-4 text-sm font-semibold">Status</th>
            </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($attendanceRecords as $record)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ \Carbon\Carbon::parse($record->attendance_date)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $record->check_in ? \Carbon\Carbon::parse($record->check_in)->format('h:i A') : '-' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $record->check_out ? \Carbon\Carbon::parse($record->check_out)->format('h:i A') : '-' }}
                                </td>

                                            <td class="px-6 py-4 text-sm text-gray-700">
                @if($record->check_in && $record->check_out)
                    @php
                        $checkIn = \Carbon\Carbon::parse($record->check_in);
                        $checkOut = \Carbon\Carbon::parse($record->check_out);

                        $totalMinutes = $checkIn->diffInMinutes($checkOut);
                        $hours = floor($totalMinutes / 60);
                        $minutes = $totalMinutes % 60;
                    @endphp

                    {{ $hours }}h {{ $minutes }}m
                @else
                    -
                @endif
            </td>
                                <td class="px-6 py-4 text-sm">
                                    @if($record->check_in && !$record->check_out)

                                        @if($record->status === 'late')
                                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-red-700 font-medium">
                                                Late
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-yellow-700 font-medium">
                                                Present
                                            </span>
                                        @endif

                                    @elseif($record->check_in && $record->check_out)
                                        <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-gray-700 font-medium">
                                            Completed
                                        </span>

                                    @elseif($record->status === 'absent')
                                        <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-red-700 font-medium">
                                            Absent
                                        </span>

                                    @else
                                        <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-green-700 font-medium">
                                            {{ ucfirst($record->status) }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</x-layouts.employee>