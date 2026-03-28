<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Employee Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">
                Welcome {{ auth()->user()->name }} 👋

                <div class="mt-4">
                    <p>Your role: {{ auth()->user()->role }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>