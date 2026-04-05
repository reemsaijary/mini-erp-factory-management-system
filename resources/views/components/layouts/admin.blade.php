<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .collapsed .sidebar-item {
            justify-content: center;
        }
    </style>
</head>
<body class="bg-[#eef4fb] overflow-x-hidden text-slate-800">

    {{-- Top header --}}
    @include('components.header')

    <div class="flex min-h-[calc(100vh-80px)]">
        {{-- Sidebar --}}
        @include('components.sidebar')

        {{-- Main page content --}}
        <main class="flex-1 p-6 md:p-8 transition-all duration-300 bg-[#eef4fb]">
            {{ $slot }}

            @include('components.footer')
        </main>
    </div>

    <script>
        const toggleBtn = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const title = document.getElementById('sidebarTitle');

        let collapsed = false;

        toggleBtn.addEventListener('click', function () {
            collapsed = !collapsed;

            if (collapsed) {
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-20');
                sidebar.classList.add('collapsed');

                title.classList.add('hidden');

                document.querySelectorAll('.label').forEach(el => {
                    el.classList.add('hidden');
                });
            } else {
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-64');
                sidebar.classList.remove('collapsed');

                title.classList.remove('hidden');

                document.querySelectorAll('.label').forEach(el => {
                    el.classList.remove('hidden');
                });
            }
        });
    </script>

</body>
</html>