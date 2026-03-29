<div class="bg-[#1f2a37] text-white px-6 py-4 flex items-center justify-between shadow">
    <div class="flex items-center gap-4">
        <button id="sidebarToggle" class="text-white text-xl font-bold">
            ☰
        </button>
        <h1 class="font-semibold text-lg">Dashboard</h1>
    </div>

    <div class="hidden md:block w-1/3">
        <input type="text"
               placeholder="Search..."
               class="w-full px-4 py-2 rounded-lg text-black focus:outline-none">
    </div>

    <div class="flex items-center gap-4">
        <span class="text-sm">{{ auth()->user()->name }}</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-sm text-red-300 hover:text-red-500">
                Logout
            </button>
        </form>
    </div>
</div>