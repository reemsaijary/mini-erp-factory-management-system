<x-layouts.admin>
    @php
        $pageTitle = 'Orders';
    @endphp

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">Total Orders</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $orders->total() }}</h3>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">Active Filters</p>
                    <h3 class="text-lg font-semibold text-gray-800 mt-2">
                        {{ request('search') || request('order_status') || request('priority') || request('order_date') ? 'Applied' : 'None' }}
                    </h3>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">New Orders</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">
                        {{ $orders->where('order_status', 'new')->count() }}
                    </h3>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Orders Module</p>
                        <h3 class="text-lg font-semibold text-gray-800 mt-2">Admin Control</h3>
                    </div>

                    <a href="{{ route('orders.create') }}"
                       class="inline-flex items-center rounded-xl bg-green-600 px-4 py-2 text-white font-medium shadow hover:bg-green-700 transition">
                        + Add Order
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Orders List</h3>
                    <p class="text-sm text-gray-500">Manage order requests and track status</p>
                </div>

                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
                    <form method="GET" action="{{ route('orders.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Search</label>
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Product or employee"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                            <select name="order_status" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">All Status</option>
                                <option value="new" {{ request('order_status') == 'new' ? 'selected' : '' }}>New</option>
                                <option value="pending" {{ request('order_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ request('order_status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Priority</label>
                            <select name="priority" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">All Priority</option>
                                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                                <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Order Date</label>
                            <input
                                type="date"
                                name="order_date"
                                value="{{ request('order_date') }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>

                        <div class="flex items-end gap-2">
                            <button type="submit"
                                    class="rounded-xl bg-blue-600 px-4 py-2 text-white font-medium hover:bg-blue-700 transition">
                                Filter
                            </button>

                            <a href="{{ route('orders.index') }}"
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
                                <th class="px-4 py-3 text-left font-semibold">Product</th>
                                <th class="px-4 py-3 text-left font-semibold">Created By</th>
                                <th class="px-4 py-3 text-left font-semibold">Quantity</th>
                                <th class="px-4 py-3 text-left font-semibold">Order Date</th>
                                <th class="px-4 py-3 text-left font-semibold">Due Date</th>
                                <th class="px-4 py-3 text-left font-semibold">Priority</th>
                                <th class="px-4 py-3 text-left font-semibold">Status</th>
                                <th class="px-4 py-3 text-left font-semibold">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse($orders as $order)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-4 font-medium text-gray-700">
                                        #{{ $order->order_id }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-800 font-semibold">
                                        {{ $order->product->product_name ?? '-' }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-700">
                                        {{ $order->employee->first_name ?? '' }} {{ $order->employee->last_name ?? '' }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-700">
                                        {{ $order->quantity }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-700">
                                        {{ $order->order_date }}
                                    </td>

                                    <td class="px-4 py-4 text-gray-700">
                                        {{ $order->due_date }}
                                    </td>

                                    <td class="px-4 py-4">
                                        @if($order->priority === 'high')
                                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                High
                                            </span>
                                        @elseif($order->priority === 'medium')
                                            <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                                Medium
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                Low
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-4">
                                        @if($order->order_status === 'new')
                                            <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                                New
                                            </span>
                                        @elseif($order->order_status === 'pending')
                                            <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                                Pending
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                Confirmed
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('orders.edit', $order->order_id) }}"
                                               class="rounded-lg bg-blue-600 px-3 py-2 text-white text-xs font-medium hover:bg-blue-700 transition">
                                                Edit
                                            </a>

                                      @if($order->productions->count() > 0)
                                    <button type="button"
                                            class="rounded-lg bg-gray-400 px-3 py-2 text-white text-xs font-medium cursor-not-allowed">
                                        Assigned
                                    </button>

                                @elseif($order->order_status === 'confirmed')
                                    <a href="{{ route('production.create', ['order_id' => $order->order_id]) }}"
                                    class="rounded-lg bg-purple-600 px-3 py-2 text-white text-xs font-medium hover:bg-purple-700 transition">
                                        Assign to Production
                                    </a>

                                @else
                                    <button type="button"
                                            class="rounded-lg bg-gray-400 px-3 py-2 text-white text-xs font-medium"
                                            onclick="alert('Order needs to be confirmed first.')">
                                        Assign to Production
                                    </button>
                                @endif

                                            <form action="{{ route('orders.destroy', $order->order_id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this order?');">
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
                                    <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                                        No orders found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-100 bg-white">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>