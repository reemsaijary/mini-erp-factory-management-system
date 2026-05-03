<x-layouts.admin>
    <x-slot name="title">
        Settings
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700 shadow-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Settings</h2>
                <p class="text-sm text-gray-500 mt-1">Manage company information, system preferences, and work shift settings.</p>
            </div>

            <form method="POST" action="{{ route('settings.update') }}">
                @csrf
                @method('PUT')

                <div class="space-y-6">

                    <!-- Company Information -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Company Information</h3>
                                <p class="text-sm text-gray-500">Manage factory name, address, and contact information.</p>
                            </div>
                            <span class="rounded-lg bg-green-100 px-3 py-1 text-sm font-medium text-green-700">Manage</span>
                        </div>

                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Factory Name</label>
                                <input type="text" name="factory_name" value="{{ old('factory_name', $setting->factory_name) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Phone</label>
                                <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email', $setting->email) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-600 mb-1">Address</label>
                                <textarea name="address" rows="3"
                                          class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('address', $setting->address) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- System Preferences -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">System Preferences</h3>
                                <p class="text-sm text-gray-500">Configure system preferences like currency and timezone.</p>
                            </div>
                            <span class="rounded-lg bg-blue-100 px-3 py-1 text-sm font-medium text-blue-700">Manage</span>
                        </div>

                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Default Currency</label>
                                <input type="text" name="currency" value="{{ old('currency', $setting->currency) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Timezone</label>
                                <input type="text" name="timezone" value="{{ old('timezone', $setting->timezone) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Work Shift Settings -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Work Shift Settings</h3>
                                <p class="text-sm text-gray-500">Set working hours and allowed late minutes.</p>
                            </div>
                            <span class="rounded-lg bg-gray-200 px-3 py-1 text-sm font-medium text-gray-700">Manage</span>
                        </div>

                        <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Shift Start</label>
                                <input type="time" name="shift_start" value="{{ old('shift_start', $setting->shift_start) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Shift End</label>
                                <input type="time" name="shift_end" value="{{ old('shift_end', $setting->shift_end) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Allowed Late Minutes</label>
                                <input type="number" min="0" name="late_after_minutes" value="{{ old('late_after_minutes', $setting->late_after_minutes) }}"
                                       class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mt-8 flex flex-wrap gap-3">
                    <button type="submit"
                            class="rounded-xl bg-green-600 px-6 py-2.5 text-white font-medium hover:bg-green-700 transition">
                        Save Settings
                    </button>

                    <a href="{{ route('admin.dashboard') }}"
                       class="rounded-xl bg-gray-500 px-6 py-2.5 text-white font-medium hover:bg-gray-600 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>