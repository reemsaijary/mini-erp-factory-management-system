<x-layouts.admin>

<div class="py-8 bg-gray-50 min-h-screen">
<div class="max-w-4xl mx-auto">

<div class="bg-white p-6 rounded-2xl shadow">

<h2 class="text-xl font-bold mb-6">Edit Production</h2>

<form method="POST" action="{{ route('production.update', $production->production_id) }}">
@csrf
@method('PUT')

<div class="grid grid-cols-2 gap-4">

    <!-- Order -->
    <div class="col-span-2">
        <label class="block text-sm mb-1 font-medium">Order</label>

        <select name="order_id" id="orderSelect" class="w-full border rounded p-2">
            <option value="">Select Order</option>

            @foreach($orders as $o)
                <option 
                    value="{{ $o->order_id }}"
                    data-order-date="{{ $o->order_date }}"
                    data-due-date="{{ $o->due_date }}"
                    data-product-name="{{ $o->product->product_name ?? '' }}"
                    data-quantity="{{ $o->quantity }}"
                    {{ $production->order_id == $o->order_id ? 'selected' : '' }}
                >
                    Order #{{ $o->order_id }} - {{ $o->product->product_name ?? '' }} (Qty: {{ $o->quantity }})
                </option>
            @endforeach
        </select>

        <!-- Order Info -->
        <div id="orderInfo" class="mt-2 text-sm text-gray-600 hidden">
            <p><strong>Product:</strong> <span id="productName"></span></p>
            <p><strong>Quantity:</strong> <span id="orderQuantity"></span></p>
            <p><strong>Order Date:</strong> <span id="orderDate"></span></p>
            <p><strong>Due Date:</strong> <span id="dueDate"></span></p>
        </div>
    </div>

    <!-- Machine -->
    <div>
        <label class="block text-sm mb-1 font-medium">Machine</label>
        <select name="machine_id" class="w-full border rounded p-2">
            @foreach($machines as $m)
                <option value="{{ $m->machine_id }}"
                    {{ $production->machine_id == $m->machine_id ? 'selected' : '' }}>
                    {{ $m->machine_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Employee -->
    <div>
        <label class="block text-sm mb-1 font-medium">Employee</label>
        <select name="employee_id" class="w-full border rounded p-2">
            @foreach($employees as $e)
                <option value="{{ $e->employee_id }}"
                    {{ $production->employee_id == $e->employee_id ? 'selected' : '' }}>
                    {{ $e->first_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Start Date -->
    <div>
        <label class="block text-sm mb-1 font-medium">Start Date</label>
        <input type="date" name="start_date" id="startDate"
               value="{{ $production->start_date }}"
               class="w-full border rounded p-2">
    </div>

    <!-- End Date -->
    <div>
        <label class="block text-sm mb-1 font-medium">End Date</label>
        <input type="date" name="end_date" id="endDate"
               value="{{ $production->end_date }}"
               class="w-full border rounded p-2">
    </div>

    <!-- Status -->
    <div class="col-span-2">
        <label class="block text-sm mb-1 font-medium">Status</label>
        <select name="production_status" class="w-full border rounded p-2">
            <option value="waiting" {{ $production->production_status == 'waiting' ? 'selected' : '' }}>Waiting</option>
            <option value="in_production" {{ $production->production_status == 'in_production' ? 'selected' : '' }}>In Production</option>
            <option value="completed" {{ $production->production_status == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
    </div>

</div>

<div class="mt-8 flex flex-wrap gap-3">
    <button type="submit"
            class="rounded-xl bg-blue-600 px-5 py-2.5 text-white font-medium hover:bg-blue-700 transition">
        Update Production
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

<!-- SCRIPT -->
<script>
const orderSelect = document.getElementById('orderSelect');
const orderInfo = document.getElementById('orderInfo');
const productName = document.getElementById('productName');
const orderQuantity = document.getElementById('orderQuantity');
const orderDate = document.getElementById('orderDate');
const dueDate = document.getElementById('dueDate');
const startDate = document.getElementById('startDate');
const endDate = document.getElementById('endDate');

function updateOrderInfo() {
    let selected = orderSelect.options[orderSelect.selectedIndex];

    let oDate = selected.getAttribute('data-order-date');
    let dDate = selected.getAttribute('data-due-date');
    let pName = selected.getAttribute('data-product-name');
    let qty = selected.getAttribute('data-quantity');

    if(oDate && dDate) {
        orderInfo.classList.remove('hidden');

        productName.innerText = pName;
        orderQuantity.innerText = qty;
        orderDate.innerText = oDate;
        dueDate.innerText = dDate;

        startDate.min = oDate;
        endDate.max = dDate;
    }
}

orderSelect.addEventListener('change', updateOrderInfo);

//  load data on page open
window.onload = updateOrderInfo;
</script>

</x-layouts.admin>