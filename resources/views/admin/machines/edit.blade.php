<x-layouts.admin>
    <x-slot name="title">
        Edit Machine
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Edit Machine</h3>
                    <p class="text-sm text-gray-500">Update machine information</p>
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

                    <form method="POST" action="{{ route('machines.update', $machine->machine_id) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Machine Name</label>
                                <input type="text" name="machine_name" value="{{ old('machine_name', $machine->machine_name) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Machine Type</label>
                                <input type="text" name="machine_type" value="{{ old('machine_type', $machine->machine_type) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Purchase Date</label>
                                <input type="date" name="purchase_date" value="{{ old('purchase_date', $machine->purchase_date) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                                <select name="machine_status" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="working" {{ old('machine_status', $machine->machine_status) == 'working' ? 'selected' : '' }}>Working</option>
                                    <option value="under_maintenance" {{ old('machine_status', $machine->machine_status) == 'under_maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                                    <option value="inactive" {{ old('machine_status', $machine->machine_status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-wrap gap-3">
                            <button type="submit"
                                    class="rounded-xl bg-blue-600 px-5 py-2.5 text-white font-medium hover:bg-blue-700 transition">
                                Update Machine
                            </button>

                            <a href="{{ route('machines.index') }}"
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