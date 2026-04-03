<x-layouts.admin>
    @php
        $pageTitle = 'Add Production';
    @endphp

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Add Production</h3>
                    <p class="text-sm text-gray-500">Assign an order to production with machine, employee, and schedule</p>
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

                    <form method="POST" action="{{ route('production.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                           <div class="md:col-span-2">
    <label class="block text-sm font-medium text-gray-600 mb-1">Order</label>

    <select name="order_id" id="orderSelect"
            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        <option value="">Select Order</option>

        @foreach($orders as $o)
            <option 
                value="{{ $o->order_id }}"
                data-order-date="{{ $o->order_date }}"
                data-due-date="{{ $o->due_date }}"
                data-product-name="{{ $o->product->product_name ?? 'Unknown Product' }}"
                data-quantity="{{ $o->quantity }}"
                {{ old('order_id') == $o->order_id ? 'selected' : '' }}
            >
                Order #{{ $o->order_id }} - {{ $o->product->product_name ?? 'Unknown Product' }} (Qty: {{ $o->quantity }})
            </option>
        @endforeach
    </select>

    <div id="orderInfo" class="mt-3 text-sm text-gray-600 hidden rounded-xl bg-gray-50 border border-gray-200 p-3">
        <p><strong>Product:</strong> <span id="productName"></span></p>
        <p><strong>Quantity:</strong> <span id="orderQuantity"></span></p>
        <p><strong>Order Date:</strong> <span id="orderDate"></span></p>
        <p><strong>Due Date:</strong> <span id="dueDate"></span></p>
    </div>
</div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Machine</label>
                                <select name="machine_id" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Select Machine</option>
                                    @foreach($machines as $m)
                                        <option value="{{ $m->machine_id }}" {{ old('machine_id') == $m->machine_id ? 'selected' : '' }}>
                                            {{ $m->machine_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Employee</label>
                                <select name="employee_id" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Select Employee</option>
                                    @foreach($employees as $e)
                                        <option value="{{ $e->employee_id }}" {{ old('employee_id') == $e->employee_id ? 'selected' : '' }}>
                                            {{ $e->first_name }} {{ $e->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Start Date</label>
                                <input type="date" name="start_date" id="startDate"
                                       value="{{ old('start_date') }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">End Date</label>
                                <input type="date" name="end_date" id="endDate"
                                       value="{{ old('end_date') }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                           <div class="md:col-span-2">
    <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
    <select name="production_status" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        <option value="">Select Status</option>
        <option value="waiting" {{ old('production_status') == 'waiting' ? 'selected' : '' }}>Waiting</option>
        <option value="in_production" {{ old('production_status') == 'in_production' ? 'selected' : '' }}>In Production</option>
        <option value="completed" {{ old('production_status') == 'completed' ? 'selected' : '' }}>Completed</option>
    </select>
</div>
                        </div>

                        <div class="mt-8 flex flex-wrap gap-3">
                            <button type="submit"
                                    class="rounded-xl bg-green-600 px-5 py-2.5 text-white font-medium hover:bg-green-700 transition">
                                Save Production
                            </button>

                            <a href="{{ route('production.index') }}"
                               class="rounded-xl bg-gray-500 px-5 py-2.5 text-white font-medium hover:bg-gray-600 transition">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
    const orderSelect = document.getElementById('orderSelect');
    const orderInfo = document.getElementById('orderInfo');
    const productNameSpan = document.getElementById('productName');
    const orderQuantitySpan = document.getElementById('orderQuantity');
    const orderDateSpan = document.getElementById('orderDate');
    const dueDateSpan = document.getElementById('dueDate');
    const startDateInput = document.getElementById('startDate');
    const endDateInput = document.getElementById('endDate');

    function updateOrderInfo() {
        const selected = orderSelect.options[orderSelect.selectedIndex];

        const orderDate = selected.getAttribute('data-order-date');
        const dueDate = selected.getAttribute('data-due-date');
        const productName = selected.getAttribute('data-product-name');
        const quantity = selected.getAttribute('data-quantity');

        if (orderDate && dueDate) {
            orderInfo.classList.remove('hidden');

            productNameSpan.textContent = productName;
            orderQuantitySpan.textContent = quantity;
            orderDateSpan.textContent = orderDate;
            dueDateSpan.textContent = dueDate;

            startDateInput.min = orderDate;
            endDateInput.max = dueDate;
        } else {
            orderInfo.classList.add('hidden');

            productNameSpan.textContent = '';
            orderQuantitySpan.textContent = '';
            orderDateSpan.textContent = '';
            dueDateSpan.textContent = '';

            startDateInput.removeAttribute('min');
            endDateInput.removeAttribute('max');
        }
    }

    orderSelect.addEventListener('change', updateOrderInfo);
    updateOrderInfo();
</script>
     
</x-layouts.admin>