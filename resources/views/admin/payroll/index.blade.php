<x-layouts.admin>
    @php
        $pageTitle = 'Payroll';
    @endphp

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Top Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">Total Payroll Records</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $payrollRecords->total() }}</h3>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">Active Filters</p>
                    <h3 class="text-lg font-semibold text-gray-800 mt-2">
                        {{ request('search') || request('month') || request('status') ? 'Applied' : 'None' }}
                    </h3>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex flex-col justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Payroll Module</p>
                        <h3 class="text-lg font-semibold text-gray-800 mt-2">Admin View</h3>
                    </div>
                </div>
            </div>

            <!-- Payroll Table Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Payroll Records</h3>
                            <p class="text-sm text-gray-500">Review and manage employee salary records</p>
                        </div>

                        <a href="{{ route('payroll.create') }}"
                           class="inline-flex items-center justify-center rounded-xl bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700 transition">
                            + New Payroll
                        </a>
                    </div>
                </div>

                <!-- Filters -->
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
                    <form method="GET" action="{{ route('payroll.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
                            <label class="block text-sm font-medium text-gray-600 mb-1">Month</label>
                            <input
                                type="number"
                                name="month"
                                min="1"
                                max="12"
                                value="{{ request('month') }}"
                                placeholder="1 - 12"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                            <select name="status" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">All Status</option>
                                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            </select>
                        </div>

                        <div class="flex items-end gap-2">
                            <button type="submit"
                                    class="rounded-xl bg-blue-600 px-4 py-2 text-white font-medium hover:bg-blue-700 transition">
                                Filter
                            </button>

                            <a href="{{ route('payroll.index') }}"
                               class="rounded-xl bg-gray-500 px-4 py-2 text-white font-medium hover:bg-gray-600 transition">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">ID</th>
                                <th class="px-4 py-3 text-left font-semibold">Employee</th>
                                <th class="px-4 py-3 text-left font-semibold">Month</th>
                                <th class="px-4 py-3 text-left font-semibold">Basic Salary</th>
                                <th class="px-4 py-3 text-left font-semibold">Bonus</th>
                                <th class="px-4 py-3 text-left font-semibold">Deductions</th>
                                <th class="px-4 py-3 text-left font-semibold">Net Salary</th>
                                <th class="px-4 py-3 text-left font-semibold">Status</th>
                                <th class="px-4 py-3 text-left font-semibold">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse($payrollRecords as $record)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-4 font-medium text-gray-700">
                                        #{{ $record->payroll_id }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-800 font-semibold">
                                        {{ $record->employee->first_name ?? '' }} {{ $record->employee->last_name ?? '' }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-700">
                                        {{ $record->month }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-700">
                                        ${{ number_format($record->basic_salary, 2) }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-700">
                                        ${{ number_format($record->bonus, 2) }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-700">
                                        ${{ number_format($record->deductions, 2) }}
                                    </td>

                                    <td class="px-4 py-4 font-semibold text-gray-800">
                                        ${{ number_format($record->net_salary, 2) }}
                                    </td>

                                    <td class="px-4 py-4">
                                        @if($record->status === 'paid')
                                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                Paid
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                Unpaid
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-4">
                                        <a href="{{ route('payroll.edit', $record->payroll_id) }}"
                                           class="inline-flex items-center rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700 transition">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                                        No payroll records found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-100 bg-white">
                    {{ $payrollRecords->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>