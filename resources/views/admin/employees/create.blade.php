<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Employee
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('employees.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="w-full border rounded p-2">
                        </div>

                        <div>
                            <label class="block mb-1">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="w-full border rounded p-2">
                        </div>

                        <div>
                            <label class="block mb-1">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded p-2">
                        </div>

                        <div>
                            <label class="block mb-1">Basic Salary</label>
                            <input type="number" step="0.01" name="basic_salary" value="{{ old('basic_salary') }}" class="w-full border rounded p-2">
                        </div>

                        <div>
                            <label class="block mb-1">Status</label>
                            <select name="status" class="w-full border rounded p-2">
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="on_leave" {{ old('status') == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                            </select>
                        </div>

                        <div>
                            <label class="block mb-1">Role</label>
                            <select name="role" class="w-full border rounded p-2">
                                <option value="">Select Role</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                            </select>
                        </div>

                        <div>
                            <label class="block mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded p-2">
                        </div>

                        <div>
                            <label class="block mb-1">Password</label>
                            <input type="password" name="password" class="w-full border rounded p-2">
                        </div>

                        <div>
                            <label class="block mb-1">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="w-full border rounded p-2">
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                            Add Employee
                        </button>

                        <a href="{{ route('employees.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>