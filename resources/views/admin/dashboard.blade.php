<x-layouts.admin>
    @php
        $pageTitle = 'Dashboard';
    @endphp

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Admin Dashboard</h2>
                <p class="text-sm text-gray-500 mt-1">Overview of factory operations and system modules.</p>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 mb-8">

                <!-- Employees -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 border-t-4 border-t-indigo-500 
            transition-all duration-300 ease-in-out 
            hover:shadow-xl hover:-translate-y-1 hover:scale-[1.01] cursor-pointer">                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500">Employees</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalEmployees }}</h3>
                        </div>
                        <div class="bg-indigo-100 text-indigo-600 p-3 rounded-xl">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                </div>

                <!-- Orders -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 border-t-4 border-t-indigo-500 
            transition-all duration-300 ease-in-out 
            hover:shadow-xl hover:-translate-y-1 hover:scale-[1.01] cursor-pointer">                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500">Orders</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalOrders }}</h3>
                        </div>
                        <div class="bg-blue-100 text-blue-600 p-3 rounded-xl">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                    </div>
                </div>

                <!-- Products -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 border-t-4 border-t-indigo-500 
            transition-all duration-300 ease-in-out 
            hover:shadow-xl hover:-translate-y-1 hover:scale-[1.01] cursor-pointer">                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500">Products</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalProducts }}</h3>
                        </div>
                        <div class="bg-emerald-100 text-emerald-600 p-3 rounded-xl">
                            <i class="fa-solid fa-box"></i>
                        </div>
                    </div>
                </div>

                <!-- Machines -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 border-t-4 border-t-indigo-500 
            transition-all duration-300 ease-in-out 
            hover:shadow-xl hover:-translate-y-1 hover:scale-[1.01] cursor-pointer">                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500">Machines</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalMachines }}</h3>
                        </div>
                        <div class="bg-amber-100 text-amber-600 p-3 rounded-xl">
                            <i class="fa-solid fa-gears"></i>
                        </div>
                    </div>
                </div>

                <!-- Production -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 border-t-4 border-t-indigo-500 
            transition-all duration-300 ease-in-out 
            hover:shadow-xl hover:-translate-y-1 hover:scale-[1.01] cursor-pointer">                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500">Production</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalProduction }}</h3>
                        </div>
                        <div class="bg-purple-100 text-purple-600 p-3 rounded-xl">
                            <i class="fa-solid fa-industry"></i>
                        </div>
                    </div>
                </div>

                <!-- Maintenance -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 border-t-4 border-t-indigo-500 
            transition-all duration-300 ease-in-out 
            hover:shadow-xl hover:-translate-y-1 hover:scale-[1.01] cursor-pointer">                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500">Maintenance</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalMaintenance }}</h3>
                        </div>
                        <div class="bg-rose-100 text-rose-600 p-3 rounded-xl">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Quick Access -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 border-t-4 border-t-indigo-500 
            transition-all duration-300 ease-in-out 
            hover:shadow-xl hover:-translate-y-1 hover:scale-[1.01] cursor-pointer">                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Quick Access</h3>
                    <p class="text-sm text-gray-500">Open important modules quickly.</p>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 ">

                    <a href="{{ route('orders.index') }}"
                       class="flex items-start gap-3 rounded-xl bg-blue-50 px-4 py-4 border border-blue-100 hover:bg-blue-100 transition">
                        <i class="fa-solid fa-cart-shopping text-blue-600 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-blue-800">Orders</h4>
                            <p class="text-sm text-blue-600 mt-1">Manage customer orders</p>
                        </div>
                    </a>

                    <a href="{{ route('production.index') }}"
                       class="flex items-start gap-3 rounded-xl bg-purple-50 px-4 py-4 border border-purple-100 hover:bg-purple-100 transition">
                        <i class="fa-solid fa-industry text-purple-600 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-purple-800">Production</h4>
                            <p class="text-sm text-purple-600 mt-1">Track factory production</p>
                        </div>
                    </a>

                    <a href="{{ route('machines.index') }}"
                       class="flex items-start gap-3 rounded-xl bg-amber-50 px-4 py-4 border border-amber-100 hover:bg-amber-100 transition">
                        <i class="fa-solid fa-gears text-amber-600 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-amber-800">Machines</h4>
                            <p class="text-sm text-amber-600 mt-1">View machine records</p>
                        </div>
                    </a>

                    <a href="{{ route('maintenance.index') }}"
                       class="flex items-start gap-3 rounded-xl bg-rose-50 px-4 py-4 border border-rose-100 hover:bg-rose-100 transition">
                        <i class="fa-solid fa-screwdriver-wrench text-rose-600 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-rose-800">Maintenance</h4>
                            <p class="text-sm text-rose-600 mt-1">Manage maintenance</p>
                        </div>
                    </a>

                    <a href="{{ route('employees.index') }}"
                       class="flex items-start gap-3 rounded-xl bg-indigo-50 px-4 py-4 border border-indigo-100 hover:bg-indigo-100 transition">
                        <i class="fa-solid fa-users text-indigo-600 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-indigo-800">Employees</h4>
                            <p class="text-sm text-indigo-600 mt-1">Manage employee records</p>
                        </div>
                    </a>

                    <a href="{{ route('reports.index') }}"
                       class="flex items-start gap-3 rounded-xl bg-cyan-50 px-4 py-4 border border-cyan-100 hover:bg-cyan-100 transition">
                        <i class="fa-solid fa-chart-pie text-cyan-600 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-cyan-800">Reports</h4>
                            <p class="text-sm text-cyan-600 mt-1">View analytics</p>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </div>
</x-layouts.admin>