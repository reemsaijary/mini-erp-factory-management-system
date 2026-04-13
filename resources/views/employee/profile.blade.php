<x-layouts.employee>

    <h1 class="text-2xl font-bold mb-6">My Profile</h1>

    <!-- TOP PROFILE CARD -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-6 flex items-center gap-4">
        
        <!-- Avatar -->
        <div class="w-16 h-16 rounded-full bg-blue-200 flex items-center justify-center text-2xl font-bold text-blue-700">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <!-- Info -->
        <div>
            <h2 class="text-xl font-semibold">{{ auth()->user()->name }}</h2>
            <p class="text-gray-500">{{ auth()->user()->email }}</p>
        </div>
    </div>

    <!-- INFO CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Employee ID -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 
                    transition-all duration-300 
                    hover:shadow-[0_10px_30px_rgba(59,130,246,0.2)] 
                    hover:-translate-y-1">
            <p class="text-gray-500 text-sm mb-2">Employee ID</p>
            <h2 class="text-xl font-semibold">{{ auth()->user()->employee_id }}</h2>
        </div>

        <!-- Role -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 
                    transition-all duration-300 
                    hover:shadow-[0_10px_30px_rgba(59,130,246,0.2)] 
                    hover:-translate-y-1">
            <p class="text-gray-500 text-sm mb-2">Employee Role</p>
            <h2 class="text-xl font-semibold">{{ ucfirst(auth()->user()->role) }}</h2>
        </div>

        <!-- Email -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 
                    transition-all duration-300 
                    hover:shadow-[0_10px_30px_rgba(59,130,246,0.2)] 
                    hover:-translate-y-1">
            <p class="text-gray-500 text-sm mb-2">Employee Email</p>
            <h2 class="text-lg font-medium">{{ auth()->user()->email }}</h2>
        </div>

        <!-- Phone -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 
                    transition-all duration-300 
                    hover:shadow-[0_10px_30px_rgba(59,130,246,0.2)] 
                    hover:-translate-y-1">
            <p class="text-gray-500 text-sm mb-2">Phone Number</p>
            <h2 class="text-lg font-medium">
              {{ auth()->user()->employee->phone ?? 'Not Available' }}
            </h2>
        </div>

        <!-- Date Joined (Full Width) -->
        <div class="md:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 
                    transition-all duration-300 
                    hover:shadow-[0_10px_30px_rgba(59,130,246,0.2)] 
                    hover:-translate-y-1">
            <p class="text-gray-500 text-sm mb-2">Date Joined</p>
            <h2 class="text-lg font-medium">
                {{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('d F Y') }}
            </h2>
        </div>

    </div>

</x-layouts.employee>