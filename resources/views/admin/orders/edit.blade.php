<x-layouts.admin>
   <x-slot name="title">
        Edit Order
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Edit Order</h3>
                    <p class="text-sm text-gray-500">Update order information</p>
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

                    <form method="POST" action="{{ route('orders.update', $order->order_id) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Product</label>
                                <select name="product_id" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    @foreach($products as $product)
                                        <option value="{{ $product->product_id }}" {{ old('product_id', $order->product_id) == $product->product_id ? 'selected' : '' }}>
                                            {{ $product->product_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Quantity</label>
                                <input type="number" name="quantity" min="1" value="{{ old('quantity', $order->quantity) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Order Date</label>
                                <input type="date" name="order_date" value="{{ old('order_date', $order->order_date) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Due Date</label>
                                <input type="date" name="due_date" value="{{ old('due_date', $order->due_date) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Priority</label>
                                <select name="priority" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="high" {{ old('priority', $order->priority) == 'high' ? 'selected' : '' }}>High</option>
                                    <option value="medium" {{ old('priority', $order->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="low" {{ old('priority', $order->priority) == 'low' ? 'selected' : '' }}>Low</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Order Status</label>
                                <select name="order_status" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="new" {{ old('order_status', $order->order_status) == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="pending" {{ old('order_status', $order->order_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ old('order_status', $order->order_status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-wrap gap-3">
                            <button type="submit"
                                    class="rounded-xl bg-blue-600 px-5 py-2.5 text-white font-medium hover:bg-blue-700 transition">
                                Update Order
                            </button>

                            <a href="{{ route('orders.index') }}"
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