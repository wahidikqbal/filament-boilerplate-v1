<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Order BTUSUP</title>
    @vite('resources/css/app.css')
    @stack('styles')
</head>

<body class="bg-blue-50">
    
    <!-- Konten Utama -->
    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>

</html>