<x-layouts.admin>

<x-slot name="title">
        Add Payroll
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto">

            <h2 class="text-2xl font-bold mb-6">Create Payroll</h2>

            <form method="POST" action="{{ route('payroll.store') }}">
                @csrf

                <div class="space-y-4">

                    <!-- Employee -->
                    <div>
                        <label class="block text-sm">Employee</label>
                        <select name="employee_id" class="w-full border rounded p-2">
                            @foreach($employees as $emp)
                                <option value="{{ $emp->employee_id }}">
                                    {{ $emp->first_name }} {{ $emp->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Month -->
                    <div>
                        <label class="block text-sm">Month</label>
                        <input type="number" name="month" min="1" max="12"
                               class="w-full border rounded p-2">
                    </div>

                    <!-- Year -->
                    <div>
                        <label class="block text-sm">Year</label>
                        <input type="number" name="year"
                               class="w-full border rounded p-2" value="{{ date('Y') }}">
                    </div>

                    <!-- Bonus -->
                    <div>
                        <label class="block text-sm">Bonus</label>
                        <input type="number" name="bonus" step="0.01"
                               class="w-full border rounded p-2">
                    </div>

                    <!-- Deductions -->
                    <div>
                        <label class="block text-sm">Deductions</label>
                        <input type="number" name="deductions" step="0.01"
                               class="w-full border rounded p-2">
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm">Status</label>
                        <select name="status" class="w-full border rounded p-2">
                            <option value="unpaid">Unpaid</option>
                            <option value="paid">Paid</option>
                        </select>
                    </div>

                    <!-- Submit -->
                  <div class="flex items-center gap-3 mt-4">

    <button type="submit"
            class="bg-blue-600 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-blue-700 transition">
        Save Payroll
    </button>

    <a href="{{ route('payroll.index') }}"
       class="bg-gray-500 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-gray-600 transition">
        Cancel
    </a>

</div>

                </div>
            </form>

        </div>
    </div>

</x-layouts.admin>