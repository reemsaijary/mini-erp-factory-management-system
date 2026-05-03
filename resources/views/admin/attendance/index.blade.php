<x-layouts.admin>
    <x-slot name="title">
       Attendance
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">Total Records</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $attendanceRecords->total() }}</h3>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">Active Filters</p>
                    <h3 class="text-lg font-semibold text-gray-800 mt-2">
                        {{ request('search') || request('status') || request('attendance_date') ? 'Applied' : 'None' }}
                    </h3>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">Attendance Module</p>
                    <h3 class="text-lg font-semibold text-gray-800 mt-2">Admin View</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Attendance Records</h3>
                    <p class="text-sm text-gray-500">Review employee attendance records</p>
                </div>

                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
                    <form method="GET" action="{{ route('attendance.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Search Employee</label>
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="First or last name"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                            <select name="status" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">All Status</option>
                                <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>Present</option>
                                <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Late</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Date</label>
                            <input
                                type="date"
                                name="attendance_date"
                                value="{{ request('attendance_date') }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>

                        <div class="flex items-end gap-2">
                            <button type="submit"
                                    class="rounded-xl bg-blue-600 px-4 py-2 text-white font-medium hover:bg-blue-700 transition">
                                Filter
                            </button>

                            <a href="{{ route('attendance.index') }}"
                               class="rounded-xl bg-gray-500 px-4 py-2 text-white font-medium hover:bg-gray-600 transition">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">ID</th>
                                <th class="px-4 py-3 text-left font-semibold">Employee</th>
                                <th class="px-4 py-3 text-left font-semibold">Date</th>
                                <th class="px-4 py-3 text-left font-semibold">Check In</th>
                                <th class="px-4 py-3 text-left font-semibold">Check Out</th>
                                <th class="px-4 py-3 text-left font-semibold">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse($attendanceRecords as $record)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-4 font-medium text-gray-700">
                                        #{{ $record->attendance_id }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-800 font-semibold">
                                        {{ $record->employee->first_name ?? '' }} {{ $record->employee->last_name ?? '' }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-700">
                                        {{ $record->attendance_date }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-700">
                                        {{ $record->check_in ?? '-' }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-700">
                                        {{ $record->check_out ?? '-' }}
                                    </td>

                                    <td class="px-4 py-4">
                                        @if($record->check_in && $record->check_out)
                                            <span class="inline-flex rounded-full bg-gray-200 px-3 py-1 text-xs font-semibold text-gray-700">
                                                Completed
                                            </span>
                                        @elseif($record->status === 'late')
                                            <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                                Late
                                            </span>
                                        @elseif($record->status === 'present')
                                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                Present
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                Absent
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                        No attendance records found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-100 bg-white">
                    {{ $attendanceRecords->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>