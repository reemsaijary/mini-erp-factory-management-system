<x-layouts.admin>
    
    {{-- Page Title --}}

    <x-slot name="title">
        Dashboard
    </x-slot>
    
      {{-- Data Preparation --}}

    @php
       
        $summaryCards = [
            ['title' => 'Employees', 'count' => $totalEmployees, 'icon' => 'fa-users', 'bg' => 'bg-indigo-100', 'text' => 'text-indigo-600'],
            ['title' => 'Orders', 'count' => $totalOrders, 'icon' => 'fa-cart-shopping', 'bg' => 'bg-blue-100', 'text' => 'text-blue-600'],
            ['title' => 'Products', 'count' => $totalProducts, 'icon' => 'fa-box', 'bg' => 'bg-emerald-100', 'text' => 'text-emerald-600'],
            ['title' => 'Machines', 'count' => $totalMachines, 'icon' => 'fa-gears', 'bg' => 'bg-amber-100', 'text' => 'text-amber-600'],
            ['title' => 'Production', 'count' => $totalProduction, 'icon' => 'fa-industry', 'bg' => 'bg-purple-100', 'text' => 'text-purple-600'],
            ['title' => 'Maintenance', 'count' => $totalMaintenance, 'icon' => 'fa-screwdriver-wrench', 'bg' => 'bg-rose-100', 'text' => 'text-rose-600'],
        ];

        $quickLinks = [
            ['title' => 'Orders', 'desc' => 'Manage customer orders', 'route' => 'orders.index', 'icon' => 'fa-cart-shopping', 'bg' => 'bg-blue-50', 'border' => 'border-blue-100', 'hover' => 'hover:bg-blue-100', 'titleColor' => 'text-blue-800', 'textColor' => 'text-blue-600'],
            ['title' => 'Production', 'desc' => 'Track factory production', 'route' => 'production.index', 'icon' => 'fa-industry', 'bg' => 'bg-purple-50', 'border' => 'border-purple-100', 'hover' => 'hover:bg-purple-100', 'titleColor' => 'text-purple-800', 'textColor' => 'text-purple-600'],
            ['title' => 'Machines', 'desc' => 'View machine records', 'route' => 'machines.index', 'icon' => 'fa-gears', 'bg' => 'bg-amber-50', 'border' => 'border-amber-100', 'hover' => 'hover:bg-amber-100', 'titleColor' => 'text-amber-800', 'textColor' => 'text-amber-600'],
            ['title' => 'Maintenance', 'desc' => 'Manage maintenance', 'route' => 'maintenance.index', 'icon' => 'fa-screwdriver-wrench', 'bg' => 'bg-rose-50', 'border' => 'border-rose-100', 'hover' => 'hover:bg-rose-100', 'titleColor' => 'text-rose-800', 'textColor' => 'text-rose-600'],
            ['title' => 'Employees', 'desc' => 'Manage employee records', 'route' => 'employees.index', 'icon' => 'fa-users', 'bg' => 'bg-indigo-50', 'border' => 'border-indigo-100', 'hover' => 'hover:bg-indigo-100', 'titleColor' => 'text-indigo-800', 'textColor' => 'text-indigo-600'],
            ['title' => 'Attendance', 'desc' => 'Review attendance records', 'route' => 'attendance.index', 'icon' => 'fa-clock', 'bg' => 'bg-sky-50', 'border' => 'border-sky-100', 'hover' => 'hover:bg-sky-100', 'titleColor' => 'text-sky-800', 'textColor' => 'text-sky-600'],
            ['title' => 'Payroll', 'desc' => 'Manage salary records', 'route' => 'payroll.index', 'icon' => 'fa-wallet', 'bg' => 'bg-emerald-50', 'border' => 'border-emerald-100', 'hover' => 'hover:bg-emerald-100', 'titleColor' => 'text-emerald-800', 'textColor' => 'text-emerald-600'],
            ['title' => 'Reports', 'desc' => 'View analytics', 'route' => 'reports.index', 'icon' => 'fa-chart-pie', 'bg' => 'bg-cyan-50', 'border' => 'border-cyan-100', 'hover' => 'hover:bg-cyan-100', 'titleColor' => 'text-cyan-800', 'textColor' => 'text-cyan-600'],
        ];
    @endphp

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-6 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-2xl font-bold text-gray-800">Admin Dashboard</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Overview of factory operations and quick access to system modules.
                </p>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 mb-8">
                @foreach($summaryCards as $card)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 border-t-4 border-t-blue-600 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-500">{{ $card['title'] }}</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $card['count'] }}</h3>
                            </div>

                            <div class="{{ $card['bg'] }} {{ $card['text'] }} p-3 rounded-xl">
                                <i class="fa-solid {{ $card['icon'] }}"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Quick Access -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Quick Access</h3>
                    <p class="text-sm text-gray-500">Open important modules quickly.</p>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                    @foreach($quickLinks as $link)
                        <a href="{{ route($link['route']) }}"
                           class="flex items-start gap-3 rounded-xl {{ $link['bg'] }} px-4 py-4 border {{ $link['border'] }} {{ $link['hover'] }} hover:-translate-y-1 hover:shadow-md transition">
                            <i class="fa-solid {{ $link['icon'] }} {{ $link['textColor'] }} mt-1"></i>

                            <div>
                                <h4 class="font-semibold {{ $link['titleColor'] }}">{{ $link['title'] }}</h4>
                                <p class="text-sm {{ $link['textColor'] }} mt-1">{{ $link['desc'] }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Analytics Charts -->
            <div class="mb-4">
                <h3 class="text-lg font-bold text-gray-800">Analytics Overview</h3>
                <p class="text-sm text-gray-500">Status-based insights from factory operations.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-8">

                <!-- Orders Chart -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800">Orders Status</h3>
                    <p class="text-sm text-gray-500 mb-4">Current order progress.</p>

                    <div class="h-64">
                        <canvas id="ordersChart"></canvas>
                    </div>
                </div>

                <!-- Production Chart -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800">Production Status</h3>
                    <p class="text-sm text-gray-500 mb-4">Factory production progress.</p>

                    <div class="h-64">
                        <canvas id="productionChart"></canvas>
                    </div>
                </div>

                <!-- Machines Chart -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800">Machine Status</h3>
                    <p class="text-sm text-gray-500 mb-4">Machine availability overview.</p>

                    <div class="h-64">
                        <canvas id="machinesChart"></canvas>
                    </div>
                </div>
            </div>

            <p class="text-xs text-gray-400 text-center">
                Data updates based on system activity.
            </p>

        </div>
    </div>

    <!-- Chart.js -->
    <!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart Data -->
<script type="application/json" id="ordersData">
    @json([$ordersNew, $ordersPending, $ordersConfirmed])
</script>

<script type="application/json" id="productionData">
    @json([$productionWaiting, $productionInProgress, $productionCompleted])
</script>

<script type="application/json" id="machinesData">
    @json([$machinesWorking, $machinesUnderMaintenance, $machinesInactive])
</script>

<script>
    function getChartData(id) {
        return JSON.parse(document.getElementById(id).textContent);
    }

    function createDoughnutChart(id, labels, data, colors) {
        new Chart(document.getElementById(id), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors,
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '55%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        enabled: true
                    }
                }
            }
        });
    }

    createDoughnutChart(
        'ordersChart',
        ['New', 'Pending', 'Confirmed'],
        getChartData('ordersData'),
        ['#3B82F6', '#F59E0B', '#10B981']
    );

    createDoughnutChart(
        'productionChart',
        ['Waiting', 'In Production', 'Completed'],
        getChartData('productionData'),
        ['#3B82F6', '#F59E0B', '#10B981']
    );

    createDoughnutChart(
        'machinesChart',
        ['Working', 'Under Maintenance', 'Inactive'],
        getChartData('machinesData'),
        ['#10B981', '#EF4444', '#9CA3AF']
    );
</script>
</x-layouts.admin>