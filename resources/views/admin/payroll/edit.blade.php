<x-layouts.admin>
    <x-slot name="title">
        Edit Payroll
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Edit Payroll</h3>
                    <p class="text-sm text-gray-500">Update payroll status, bonus, and deductions</p>
                </div>

                <div class="p-6">
                    @if ($errors->any())
                        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('payroll.update', $payroll->payroll_id) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Employee</label>
                                <input type="text"
                                       value="{{ $payroll->employee->first_name ?? '' }} {{ $payroll->employee->last_name ?? '' }}"
                                       class="w-full rounded-xl border-gray-300 bg-gray-100"
                                       readonly>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Month</label>
                                <input type="text"
                                       value="{{ $payroll->month }}"
                                       class="w-full rounded-xl border-gray-300 bg-gray-100"
                                       readonly>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Basic Salary</label>
                                <input type="text"
                                       value="{{ number_format($payroll->basic_salary, 2) }}"
                                       class="w-full rounded-xl border-gray-300 bg-gray-100"
                                       readonly>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Bonus</label>
                                <input type="number" step="0.01" name="bonus"
                                       value="{{ old('bonus', $payroll->bonus) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Deductions</label>
                                <input type="number" step="0.01" name="deductions"
                                       value="{{ old('deductions', $payroll->deductions) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                                <select name="status" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="unpaid" {{ old('status', $payroll->status) == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                    <option value="paid" {{ old('status', $payroll->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-8 flex gap-3">
                            <button type="submit"
                                    class="rounded-xl bg-blue-600 px-5 py-2.5 text-white font-medium hover:bg-blue-700 transition">
                                Update Payroll
                            </button>

                            <a href="{{ route('payroll.index') }}"
                               class="rounded-xl bg-gray-500 px-5 py-2.5 text-white font-medium hover:bg-gray-600 transition">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>