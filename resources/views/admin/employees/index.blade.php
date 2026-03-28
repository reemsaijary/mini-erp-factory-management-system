<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Employees
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('employees.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">
                    + Add New Employee
                </a>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6 overflow-x-auto">
                <table class="w-full border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Name</th>
                            <th class="border p-2">Role</th>
                            <th class="border p-2">Phone</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td class="border p-2">{{ $employee->employee_id }}</td>
                                <td class="border p-2">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                <td class="border p-2">{{ $employee->user->role ?? 'No Account' }}</td>
                                <td class="border p-2">{{ $employee->phone }}</td>
                                <td class="border p-2">{{ $employee->user->email ?? 'No Email' }}</td>
                                <td class="border p-2">{{ $employee->status }}</td>
                                <td class="border p-2">{{ $employee->basic_salary }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="border p-4 text-center">No employees found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>