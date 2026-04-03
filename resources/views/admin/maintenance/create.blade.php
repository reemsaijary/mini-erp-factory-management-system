<x-layouts.admin>
    @php
        $pageTitle = 'Add Maintenance Record';
    @endphp

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Add Maintenance Record</h3>
                    <p class="text-sm text-gray-500">Enter machine fault or maintenance details</p>
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

                    <form method="POST" action="{{ route('maintenance.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Machine</label>
                                <select name="machine_id" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Machine</option>
                                @foreach($machines as $machine)
                                    <option value="{{ $machine->machine_id }}"
                                        {{ old('machine_id', $selectedMachineId ?? '') == $machine->machine_id ? 'selected' : '' }}>
                                        {{ $machine->machine_name }}
                                    </option>
                                @endforeach
                            </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Reported By</label>
                                <select name="reported_by" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Select Employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->employee_id }}" {{ old('reported_by') == $employee->employee_id ? 'selected' : '' }}>
                                            {{ $employee->first_name }} {{ $employee->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-600 mb-1">Description</label>
                                <textarea name="description" rows="4"
                                          class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Report Date</label>
                                <input type="date" name="report_date" value="{{ old('report_date') }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                                <select name="status" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Select Status</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="resolved" {{ old('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-wrap gap-3">
                            <button type="submit"
                                    class="rounded-xl bg-green-600 px-5 py-2.5 text-white font-medium hover:bg-green-700 transition">
                                Save Record
                            </button>

                            <a href="{{ route('maintenance.index') }}"
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