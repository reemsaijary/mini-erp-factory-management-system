<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 gap-6">

            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-bold">Employees</h3>
                <p class="text-2xl">{{ \App\Models\Employee::count() }}</p>
            </div>

            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-bold">Orders</h3>
                <p class="text-2xl">{{ \App\Models\Order::count() }}</p>
            </div>

            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-bold">Products</h3>
                <p class="text-2xl">{{ \App\Models\Product::count() }}</p>
            </div>

        </div>
    </div>
</x-app-layout>