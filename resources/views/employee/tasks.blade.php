<x-layouts.employee>

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-slate-800">My Tasks</h1>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <p class="text-sm text-gray-500 mb-2">Total Tasks</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $totalTasks }}</h3>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <p class="text-sm text-gray-500 mb-2">Waiting</p>
            <h3 class="text-2xl font-bold text-yellow-600">{{ $waitingTasks }}</h3>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <p class="text-sm text-gray-500 mb-2">In Production</p>
            <h3 class="text-2xl font-bold text-blue-600">{{ $inProductionTasks }}</h3>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <p class="text-sm text-gray-500 mb-2">Completed</p>
            <h3 class="text-2xl font-bold text-green-600">{{ $completedTasks }}</h3>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
        <form method="GET" action="{{ route('employee.tasks') }}">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by Order ID or Product"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select
                        name="status"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">All Statuses</option>
                        <option value="waiting" {{ request('status') == 'waiting' ? 'selected' : '' }}>Waiting</option>
                        <option value="in_production" {{ request('status') == 'in_production' ? 'selected' : '' }}>In Production</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div class="flex items-end gap-3">
                    <button
                        type="submit"
                        class="rounded-xl bg-blue-600 px-5 py-2.5 text-white font-medium hover:bg-blue-700 transition"
                    >
                        Filter
                    </button>

                    <a
                        href="{{ route('employee.tasks') }}"
                        class="rounded-xl bg-gray-200 px-5 py-2.5 text-gray-700 font-medium hover:bg-gray-300 transition"
                    >
                        Reset
                    </a>
                </div>

            </div>
        </form>
    </div>

    <!-- Tasks Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-slate-800">Assigned Tasks</h2>
            <span class="text-sm text-gray-500">Total Records: {{ $tasks->total() }}</span>
        </div>

        @if($tasks->isEmpty())
            <div class="p-10 text-center text-gray-500">
                No assigned tasks found.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold">ID</th>
                            <th class="px-6 py-4 text-sm font-semibold">Order</th>
                            <th class="px-6 py-4 text-sm font-semibold">Product</th>
                            <th class="px-6 py-4 text-sm font-semibold">Machine</th>
                            <th class="px-6 py-4 text-sm font-semibold">Start Date</th>
                            <th class="px-6 py-4 text-sm font-semibold">End Date</th>
                            <th class="px-6 py-4 text-sm font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($tasks as $task)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-700">#{{ $task->production_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">#{{ $task->order_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $task->order && $task->order->product ? $task->order->product->product_name : '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $task->machine ? $task->machine->machine_name : '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ \Carbon\Carbon::parse($task->start_date)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $task->end_date ? \Carbon\Carbon::parse($task->end_date)->format('d M Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if($task->production_status === 'waiting')
                                        <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-yellow-700 font-medium">
                                            Waiting
                                        </span>
                                    @elseif($task->production_status === 'in_production')
                                        <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-blue-700 font-medium">
                                            In Production
                                        </span>
                                    @elseif($task->production_status === 'completed')
                                        <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-green-700 font-medium">
                                            Completed
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-100">
                {{ $tasks->withQueryString()->links() }}
            </div>
        @endif
    </div>

</x-layouts.employee>