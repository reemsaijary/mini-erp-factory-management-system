<x-layouts.admin>
    @php
        $pageTitle = 'Reports';
    @endphp

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Reports & Analytics</h2>
                <p class="text-sm text-gray-500 mt-1">Overview of factory operations across all modules.</p>
            </div>

            <!-- Quick Insights -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <a href="{{ route('orders.index') }}"
                   class="flex items-center gap-3 rounded-2xl bg-blue-50 border border-blue-100 px-4 py-3 transition duration-200 hover:shadow-lg hover:-translate-y-1">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">{{ $confirmedOrders }} Confirmed Orders</p>
                        <p class="text-xs text-gray-500">Ready for workflow action</p>
                    </div>
                </a>

                <a href="{{ route('production.index') }}"
                   class="flex items-center gap-3 rounded-2xl bg-purple-50 border border-purple-100 px-4 py-3 transition duration-200 hover:shadow-lg hover:-translate-y-1">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-purple-100 text-purple-600">
                        <i class="fa-solid fa-industry"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">{{ $inProduction }} Productions In Progress</p>
                        <p class="text-xs text-gray-500">Factory floor active</p>
                    </div>
                </a>

                <a href="{{ route('machines.index') }}"
                   class="flex items-center gap-3 rounded-2xl bg-yellow-50 border border-yellow-100 px-4 py-3 transition duration-200 hover:shadow-lg hover:-translate-y-1">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">{{ $maintenanceMachines }} Machines Under Maintenance</p>
                        <p class="text-xs text-gray-500">Needs attention</p>
                    </div>
                </a>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">

                <a href="{{ route('products.index') }}"
                   class="group bg-white rounded-2xl shadow-md border border-gray-100 p-5 border-t-4 border-t-emerald-500 transition duration-200 hover:shadow-lg hover:-translate-y-1 block">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500">Total Products</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalProducts }}</h3>
                            <p class="text-xs text-emerald-600 mt-2 font-medium">Factory catalog items</p>
                        </div>
                        <div class="bg-emerald-100 text-emerald-600 p-3 rounded-xl group-hover:bg-emerald-200 transition">
                            <i class="fa-solid fa-box"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('orders.index') }}"
                   class="group bg-white rounded-2xl shadow-md border border-gray-100 p-5 border-t-4 border-t-blue-500 transition duration-200 hover:shadow-lg hover:-translate-y-1 block">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500">Total Orders</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalOrders }}</h3>
                            <p class="text-xs text-blue-600 mt-2 font-medium">{{ $confirmedOrders }} confirmed</p>
                        </div>
                        <div class="bg-blue-100 text-blue-600 p-3 rounded-xl group-hover:bg-blue-200 transition">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('production.index') }}"
                   class="group bg-white rounded-2xl shadow-md border border-gray-100 p-5 border-t-4 border-t-purple-500 transition duration-200 hover:shadow-lg hover:-translate-y-1 block">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500">Production</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalProduction }}</h3>
                            <p class="text-xs text-purple-600 mt-2 font-medium">{{ $inProduction }} in progress</p>
                        </div>
                        <div class="bg-purple-100 text-purple-600 p-3 rounded-xl group-hover:bg-purple-200 transition">
                            <i class="fa-solid fa-industry"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('machines.index') }}"
                   class="group bg-white rounded-2xl shadow-md border border-gray-100 p-5 border-t-4 border-t-amber-500 transition duration-200 hover:shadow-lg hover:-translate-y-1 block">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500">Machines</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalMachines }}</h3>
                            <p class="text-xs text-amber-600 mt-2 font-medium">{{ $maintenanceMachines }} under maintenance</p>
                        </div>
                        <div class="bg-amber-100 text-amber-600 p-3 rounded-xl group-hover:bg-amber-200 transition">
                            <i class="fa-solid fa-gears"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('maintenance.index') }}"
                   class="group bg-white rounded-2xl shadow-md border border-gray-100 p-5 border-t-4 border-t-rose-500 transition duration-200 hover:shadow-lg hover:-translate-y-1 block">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500">Maintenance Records</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalMaintenance }}</h3>
                            <p class="text-xs text-rose-600 mt-2 font-medium">{{ $resolvedMaintenance }} resolved</p>
                        </div>
                        <div class="bg-rose-100 text-rose-600 p-3 rounded-xl group-hover:bg-rose-200 transition">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('employees.index') }}"
                   class="group bg-white rounded-2xl shadow-md border border-gray-100 p-5 border-t-4 border-t-indigo-500 transition duration-200 hover:shadow-lg hover:-translate-y-1 block">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500">Total Employees</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalEmployees }}</h3>
                            <p class="text-xs text-indigo-600 mt-2 font-medium">Workforce overview</p>
                        </div>
                        <div class="bg-indigo-100 text-indigo-600 p-3 rounded-xl group-hover:bg-indigo-200 transition">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('payroll.index') }}"
                   class="group bg-white rounded-2xl shadow-md border border-gray-100 p-5 border-t-4 border-t-cyan-500 transition duration-200 hover:shadow-lg hover:-translate-y-1 block">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500">Payroll Records</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalPayrollRecords }}</h3>
                            <p class="text-xs text-cyan-600 mt-2 font-medium">Salary management data</p>
                        </div>
                        <div class="bg-cyan-100 text-cyan-600 p-3 rounded-xl group-hover:bg-cyan-200 transition">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                    </div>
                </a>

            </div>

            <!-- Detailed Reports -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <a href="{{ route('orders.index') }}"
                   class="group bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden transition duration-200 hover:shadow-lg hover:-translate-y-1 block">
                    <div class="px-6 py-5 border-b border-gray-100 border-l-4 border-l-blue-500 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Orders Report</h3>
                        </div>
                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">Live</span>
                    </div>
                    <div class="p-6 space-y-4 text-sm">
                        <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                            <span class="text-gray-600">Total</span>
                            <span class="font-semibold text-gray-800">{{ $totalOrders }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">New</span>
                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">{{ $newOrders }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Pending</span>
                            <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">{{ $pendingOrders }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Confirmed</span>
                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">{{ $confirmedOrders }}</span>
                        </div>
                    </div>
                </a>

                <a href="{{ route('production.index') }}"
                   class="group bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden transition duration-200 hover:shadow-lg hover:-translate-y-1 block">
                    <div class="px-6 py-5 border-b border-gray-100 border-l-4 border-l-purple-500 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-50 text-purple-600">
                                <i class="fa-solid fa-industry"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Production Report</h3>
                        </div>
                        <span class="rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700">Workflow</span>
                    </div>
                    <div class="p-6 space-y-4 text-sm">
                        <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                            <span class="text-gray-600">Total</span>
                            <span class="font-semibold text-gray-800">{{ $totalProduction }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Waiting</span>
                            <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">{{ $waitingProduction }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">In Production</span>
                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">{{ $inProduction }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Completed</span>
                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">{{ $completedProduction }}</span>
                        </div>
                    </div>
                </a>

                <a href="{{ route('machines.index') }}"
                   class="group bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden transition duration-200 hover:shadow-lg hover:-translate-y-1 block">
                    <div class="px-6 py-5 border-b border-gray-100 border-l-4 border-l-amber-500 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                                <i class="fa-solid fa-gears"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Machines Report</h3>
                        </div>
                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">Operations</span>
                    </div>
                    <div class="p-6 space-y-4 text-sm">
                        <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                            <span class="text-gray-600">Total</span>
                            <span class="font-semibold text-gray-800">{{ $totalMachines }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Working</span>
                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">{{ $workingMachines }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Maintenance</span>
                            <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">{{ $maintenanceMachines }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Inactive</span>
                            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">{{ $inactiveMachines }}</span>
                        </div>
                    </div>
                </a>

                <a href="{{ route('maintenance.index') }}"
                   class="group bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden transition duration-200 hover:shadow-lg hover:-translate-y-1 block">
                    <div class="px-6 py-5 border-b border-gray-100 border-l-4 border-l-rose-500 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
                                <i class="fa-solid fa-screwdriver-wrench"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Maintenance Report</h3>
                        </div>
                        <span class="rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-700">Service</span>
                    </div>
                    <div class="p-6 space-y-4 text-sm">
                        <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                            <span class="text-gray-600">Total</span>
                            <span class="font-semibold text-gray-800">{{ $totalMaintenance }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Pending</span>
                            <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">{{ $pendingMaintenance }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">In Progress</span>
                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">{{ $inProgressMaintenance }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Resolved</span>
                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">{{ $resolvedMaintenance }}</span>
                        </div>
                    </div>
                </a>

            </div>

        </div>
    </div>
</x-layouts.admin>