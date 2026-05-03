<x-layouts.admin>
   <x-slot name="title">
        View Product
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">View Product</h3>
                    <p class="text-sm text-gray-500">Product details in read-only mode</p>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Product Name</label>
                            <input type="text" value="{{ $product->product_name }}"
                                   class="w-full rounded-xl border-gray-300 bg-gray-100 text-gray-700" readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Product Type</label>
                            <input type="text" value="{{ $product->product_type ?? '-' }}"
                                   class="w-full rounded-xl border-gray-300 bg-gray-100 text-gray-700" readonly>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Description</label>
                            <textarea rows="4"
                                      class="w-full rounded-xl border-gray-300 bg-gray-100 text-gray-700"
                                      readonly>{{ $product->description ?? '-' }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Unit Price</label>
                            <input type="text" value="${{ number_format($product->unit_price, 2) }}"
                                   class="w-full rounded-xl border-gray-300 bg-gray-100 text-gray-700" readonly>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('products.edit', $product->product_id) }}"
                           class="rounded-xl bg-blue-600 px-5 py-2.5 text-white font-medium hover:bg-blue-700 transition">
                            Edit
                        </a>

                        <a href="{{ route('products.index') }}"
                           class="rounded-xl bg-gray-500 px-5 py-2.5 text-white font-medium hover:bg-gray-600 transition">
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>