<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    @include('components.header')

    <div class="flex">
        @include('components.sidebar')

        <main class="flex-1 p-6 transition-all duration-300">
            {{ $slot }}
        </main>
    </div>

    <script>
        const toggleBtn = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarTitle = document.getElementById('sidebarTitle');

        let collapsed = false;

        toggleBtn.addEventListener('click', function () {
            collapsed = !collapsed;

            if (collapsed) {
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-20');
                sidebarTitle.classList.add('hidden');
            } else {
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-64');
                sidebarTitle.classList.remove('hidden');
            }
        });
    </script>

</body>
</html>