<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Employees Management
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <h3 class="text-lg font-semibold text-gray-700">Employee List</h3>

                    <a href="{{ route('employees.create') }}"
                       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                        + Add New Employee
                    </a>
                </div>

                <form method="GET" action="{{ route('employees.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search by name"
                            class="w-full border rounded-lg p-2"
                        >
                    </div>

                    <div>
                        <select name="role" class="w-full border rounded-lg p-2">
                            <option value="">All Roles</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="employee" {{ request('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                        </select>
                    </div>

                    <div>
                        <select name="status" class="w-full border rounded-lg p-2">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="on_leave" {{ request('status') == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                            Filter
                        </button>

                        <a href="{{ route('employees.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                            Reset
                        </a>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="border p-3 text-left">ID</th>
                                <th class="border p-3 text-left">Name</th>
                                <th class="border p-3 text-left">Role</th>
                                <th class="border p-3 text-left">Phone</th>
                                <th class="border p-3 text-left">Email</th>
                                <th class="border p-3 text-left">Status</th>
                                <th class="border p-3 text-left">Salary</th>
                                <th class="border p-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employees as $employee)
                                <tr class="hover:bg-gray-50">
                                    <td class="border p-3">{{ $employee->employee_id }}</td>
                                    <td class="border p-3">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                    <td class="border p-3">{{ $employee->user->role ?? 'No Account' }}</td>
                                    <td class="border p-3">{{ $employee->phone }}</td>
                                    <td class="border p-3">{{ $employee->user->email ?? 'No Email' }}</td>
                                    <td class="border p-3">
                                        {{ ucfirst(str_replace('_', ' ', $employee->status)) }}
                                    </td>
                                    <td class="border p-3">{{ $employee->basic_salary }}</td>
                                    <td class="border p-3">
                                        <div class="flex gap-2">
                                            <a href="{{ route('employees.edit', $employee->employee_id) }}"
                                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                                                Edit
                                            </a>

                                            <form action="{{ route('employees.destroy', $employee->employee_id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="border p-4 text-center text-gray-500">
                                        No employees found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>