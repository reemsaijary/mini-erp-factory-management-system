<x-layouts.admin>
   <x-slot name="title">
        View Production
    </x-slot>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">View Production Record</h3>
                    <p class="text-sm text-gray-500">Production details</p>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Order</label>
                            <input type="text"
                                   value="Order #{{ $production->order_id }} - {{ $production->order->product->product_name ?? 'Unknown Product' }} (Qty: {{ $production->order->quantity ?? '-' }})"
                                   class="w-full rounded-xl border-gray-300 bg-gray-100 text-gray-700"
                                   readonly>
                        </div>

                        <div class="md:col-span-2 rounded-xl bg-gray-50 border border-gray-200 p-4">
                            <p class="text-sm text-gray-700"><strong>Product:</strong> {{ $production->order->product->product_name ?? '-' }}</p>
                            <p class="text-sm text-gray-700 mt-1"><strong>Quantity:</strong> {{ $production->order->quantity ?? '-' }}</p>
                            <p class="text-sm text-gray-700 mt-1"><strong>Order Date:</strong> {{ $production->order->order_date ?? '-' }}</p>
                            <p class="text-sm text-gray-700 mt-1"><strong>Due Date:</strong> {{ $production->order->due_date ?? '-' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Machine</label>
                            <input type="text"
                                   value="{{ $production->machine->machine_name ?? '-' }}"
                                   class="w-full rounded-xl border-gray-300 bg-gray-100 text-gray-700"
                                   readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Employee</label>
                            <input type="text"
                                   value="{{ ($production->employee->first_name ?? '') . ' ' . ($production->employee->last_name ?? '') }}"
                                   class="w-full rounded-xl border-gray-300 bg-gray-100 text-gray-700"
                                   readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Start Date</label>
                            <input type="text"
                                   value="{{ $production->start_date }}"
                                   class="w-full rounded-xl border-gray-300 bg-gray-100 text-gray-700"
                                   readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">End Date</label>
                            <input type="text"
                                   value="{{ $production->end_date ?? '-' }}"
                                   class="w-full rounded-xl border-gray-300 bg-gray-100 text-gray-700"
                                   readonly>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                            <input type="text"
                                   value="{{ $production->production_status === 'in_production' ? 'In Production' : ucfirst(str_replace('_', ' ', $production->production_status)) }}"
                                   class="w-full rounded-xl border-gray-300 bg-gray-100 text-gray-700"
                                   readonly>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('production.edit', $production->production_id) }}"
                           class="rounded-xl bg-blue-600 px-5 py-2.5 text-white font-medium hover:bg-blue-700 transition">
                            Edit
                        </a>

                        <a href="{{ route('production.index') }}"
                           class="rounded-xl bg-gray-500 px-5 py-2.5 text-white font-medium hover:bg-gray-600 transition">
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>