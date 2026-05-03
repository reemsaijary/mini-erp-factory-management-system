<x-layouts.admin>
   <x-slot name="title">
        Edit Product
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Edit Product</h3>
                    <p class="text-sm text-gray-500">Update product information</p>
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

                    <form method="POST" action="{{ route('products.update', $product->product_id) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Product Name</label>
                                <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Product Type</label>
                                <input type="text" name="product_type" value="{{ old('product_type', $product->product_type) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-600 mb-1">Description</label>
                                <textarea name="description" rows="4"
                                          class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Unit Price</label>
                                <input type="number" step="0.01" min="0" name="unit_price" value="{{ old('unit_price', $product->unit_price) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="mt-8 flex flex-wrap gap-3">
                            <button type="submit"
                                    class="rounded-xl bg-blue-600 px-5 py-2.5 text-white font-medium hover:bg-blue-700 transition">
                                Update Product
                            </button>

                            <a href="{{ route('products.index') }}"
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