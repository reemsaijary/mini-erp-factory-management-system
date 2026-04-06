<x-layouts.employee>
    <h1 class="text-2xl font-bold">Employee Dashboard</h1>

    <div class="mt-6 bg-white p-6 rounded-lg shadow">
        <p>Welcome {{ auth()->user()->name }} 👋</p>

        <div class="mt-4">
            <p>Your role: {{ auth()->user()->role }}</p>
        </div>
    </div>
</x-layouts.employee>