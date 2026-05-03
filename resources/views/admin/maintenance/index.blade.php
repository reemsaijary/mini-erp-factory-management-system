<x-layouts.admin>
   <x-slot name="title">
        Maintenance
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">Total Maintenance Records</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $maintenanceRecords->total() }}</h3>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">Active Filters</p>
                    <h3 class="text-lg font-semibold text-gray-800 mt-2">
                        {{ request('search') || request('status') || request('report_date') ? 'Applied' : 'None' }}
                    </h3>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Maintenance Module</p>
                        <h3 class="text-lg font-semibold text-gray-800 mt-2">Admin Control</h3>
                    </div>

                    <a href="{{ route('maintenance.create') }}"
                       class="inline-flex items-center rounded-xl bg-green-600 px-4 py-2 text-white font-medium shadow hover:bg-green-700 transition">
                        + Add Record
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Maintenance Records</h3>
                    <p class="text-sm text-gray-500">Manage machine faults and maintenance progress</p>
                </div>

                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
                    <form method="GET" action="{{ route('maintenance.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Search</label>
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Machine, employee.."
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                            <select name="status" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">All Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Report Date</label>
                            <input
                                type="date"
                                name="report_date"
                                value="{{ request('report_date') }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>

                        <div class="flex items-end gap-2">
                            <button type="submit"
                                    class="rounded-xl bg-blue-600 px-4 py-2 text-white font-medium hover:bg-blue-700 transition">
                                Filter
                            </button>

                            <a href="{{ route('maintenance.index') }}"
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
                                <th class="px-4 py-3 text-left font-semibold">Machine</th>
                                <th class="px-4 py-3 text-left font-semibold">Reported By</th>
                                <th class="px-4 py-3 text-left font-semibold">Description</th>
                                <th class="px-4 py-3 text-left font-semibold">Report Date</th>
                                <th class="px-4 py-3 text-left font-semibold">Status</th>
                                <th class="px-4 py-3 text-left font-semibold">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse($maintenanceRecords as $record)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-4 font-medium text-gray-700">
                                        #{{ $record->maintenance_id}}
                                    </td>

                                    <td class="px-4 py-4 text-gray-800 font-semibold">
                                        {{ $record->machine->machine_name ?? '-' }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-700">
                                        {{ $record->employee->first_name ?? '' }} {{ $record->employee->last_name ?? '' }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-700">
                                        {{ $record->description }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-700">
                                        {{ $record->report_date }}
                                    </td>

                                    <td class="px-4 py-4">
                                        @if($record->status === 'pending')
                                            <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                                Pending
                                            </span>
                                        @elseif($record->status === 'in_progress')
                                            <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                                In Progress
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                Resolved
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('maintenance.edit', $record->maintenance_id) }}"
                                               class="rounded-lg bg-blue-600 px-3 py-2 text-white text-xs font-medium hover:bg-blue-700 transition">
                                                Edit
                                            </a>

                                            <form action="{{ route('maintenance.destroy', $record->maintenance_id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="rounded-lg bg-red-600 px-3 py-2 text-white text-xs font-medium hover:bg-red-700 transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                        No maintenance records found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-100 bg-white">
                    {{ $maintenanceRecords->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>