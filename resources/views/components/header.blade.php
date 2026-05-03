<div class="fixed top-0 left-0 right-0 z-50 h-20 bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between shadow-sm">    <div class="flex items-center gap-4">
       
        <div class="flex items-center gap-3">
    <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold shadow-sm">
        C
    </div>
    <h1 class="font-extrabold text-xl text-slate-800">
        CartonSys
    </h1>
</div>
    </div>

    <div class="hidden md:block w-full max-w-md">
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input
                type="text"
                placeholder="Search..."
                class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
        </div>
    </div>

    <div class="flex items-center gap-4">

         <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-sm font-medium text-rose-500 hover:text-rose-600 transition">
                Logout
            </button>
          </form>

        <div class="hidden sm:flex items-center gap-2">
             <span class="text-sm font-medium text-slate-700">{{ auth()->user()->name }}</span>
            <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-semibold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
           
        </div>

       
    </div>
</div>