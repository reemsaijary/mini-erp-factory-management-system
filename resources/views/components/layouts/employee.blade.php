<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Panel</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .collapsed .sidebar-item {
            justify-content: center;
        }
    </style>
</head>

<body class="bg-gray-100">

    @include('components.header')

    <div class="flex min-h-screen">
        @include('components.employee-sidebar')

        <div class="flex flex-col flex-1">
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>

            @include('components.employee-footer')
        </div>
    </div>

    <!-- for collapse to work -->
    <script>
        const toggleBtn = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const title = document.getElementById('sidebarTitle');

        let collapsed = false;

        if (toggleBtn && sidebar && title) {
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
        }
    </script>
</body>
</html>