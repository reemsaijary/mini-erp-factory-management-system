<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Factory Management System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<!-- min-h-screen → full screen height -->
 <!-- bg-[#0b1730] → dark blue background -->
<body class="min-h-screen bg-[#0b1730]">
    <!-- Centering everything -->
    <div class="min-h-screen flex items-center justify-center px-4 py-10">
        <!-- Outer container (the big rounded card)-->
        <div class="w-full max-w-6xl rounded-3xl bg-[#dfeaf7] shadow-2xl p-6 md:p-8">
        <!--Split layout (LEFT + RIGHT)-->
            <div class="grid grid-cols-1 md:grid-cols-2 overflow-hidden rounded-2xl bg-white min-h-[520px]">

                <!-- Left Side -->
                <div class="relative flex flex-col justify-center bg-[#eef4fb] px-10 py-12 md:px-14">
                    <div class="relative z-10">
                        <h1 class="text-4xl md:text-5xl font-extrabold text-blue-600 mb-3">
                            CartonSys
                        </h1>

                        <p class="text-gray-700 text-lg leading-relaxed">
                            Carton Factory Management System
                        </p>

                        <p class="mt-6 text-sm text-gray-500 max-w-md">
                            Secure internal access for admin and employees to manage operations, orders, production, machines, maintenance, and reports.
                        </p>
                    </div>

                    <!-- Decorative factory illustration -->
                    <div class="absolute inset-x-0 bottom-0 h-56 opacity-15">
                        <svg viewBox="0 0 900 260" class="w-full h-full" fill="none" xmlns="http://www.w3.org/2000/svg">
                             <rect x="40" y="145" width="120" height="80" fill="#5b8fd6"/>
                            <rect x="180" y="115" width="170" height="110" fill="#5b8fd6"/>
                            <rect x="370" y="150" width="100" height="75" fill="#5b8fd6"/>
                            <rect x="500" y="125" width="130" height="100" fill="#5b8fd6"/>
                            <rect x="665" y="90" width="45" height="135" fill="#5b8fd6"/>
                            <rect x="725" y="70" width="38" height="155" fill="#5b8fd6"/>
                            <polygon points="180,115 265,70 350,115" fill="#5b8fd6"/>
                            <rect x="80" y="170" width="16" height="16" fill="white"/>
                            <rect x="103" y="170" width="16" height="16" fill="white"/>
                            <rect x="205" y="145" width="18" height="18" fill="white"/>
                            <rect x="229" y="145" width="18" height="18" fill="white"/>
                            <rect x="253" y="145" width="18" height="18" fill="white"/>
                            <rect x="277" y="145" width="18" height="18" fill="white"/>
                            <rect x="525" y="155" width="18" height="18" fill="white"/>
                            <rect x="550" y="155" width="18" height="18" fill="white"/>
                            <rect x="575" y="155" width="18" height="18" fill="white"/>
                            <line x1="0" y1="225" x2="900" y2="225" stroke="#5b8fd6" stroke-width="4"/>
                        </svg>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="flex items-center justify-center bg-[#f8fafc] px-6 py-10 md:px-10">
                    <div class="w-full max-w-md rounded-2xl bg-white border border-gray-100 shadow-xl p-8 md:p-10">

                        <div class="mb-8 text-center">
                            <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">
                                <i class="fa-solid fa-right-to-bracket text-xl"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-800">Login</h2>
                            <p class="mt-2 text-sm text-gray-500">Authorized users only</p>
                        </div>

                        @if (session('status'))
                            <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                                <ul class="space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="space-y-5">
                            @csrf

                            <div>
                                <label for="email" class="mb-2 block text-sm font-medium text-gray-700">
                                    Email
                                </label>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="Enter your email"
                                    class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                            </div>

                            <div>
                                <label for="password" class="mb-2 block text-sm font-medium text-gray-700">
                                    Password
                                </label>
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Enter your password"
                                    class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                            </div>

                            <div class="flex items-center">
                                <input
                                    id="remember_me"
                                    type="checkbox"
                                    name="remember"
                                    class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                >
                                <label for="remember_me" class="ml-2 text-sm text-gray-600">
                                    Remember me
                                </label>
                            </div>

                            <button
                                type="submit"
                               class="w-full rounded-xl bg-blue-600 px-4 py-3 text-white font-semibold shadow-md transition transform hover:scale-105 hover:bg-blue-700"
                            >
                                Login
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>