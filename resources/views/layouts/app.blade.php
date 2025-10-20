<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Form Order BTUSUP')</title>

    {{-- ✅ Vite asset (CSS + JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ✅ Livewire styles --}}
    @livewireStyles

    {{-- ✅ Stack tambahan dari child view --}}
    @stack('styles')
</head>

<body class="bg-blue-50 min-h-screen flex flex-col">

    {{-- ✅ Konten utama --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- ✅ Livewire scripts --}}
    @livewireScripts

    {{-- ✅ SweetAlert2 listener --}}
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('swal', (data) => {
                Swal.fire({
                    title: data.title || 'Keranjang Kosong',
                    text: data.text || 'Pesanan Anda Masih Kosong.',
                    icon: data.icon || 'info',
                    confirmButtonColor: '#10b981', // hijau lembut
                    confirmButtonText: 'OK',
                });
            });
        });
    </script>

    {{-- ✅ Stack script tambahan --}}
    @stack('scripts')
</body>
</html>
