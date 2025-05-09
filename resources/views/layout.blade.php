<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: {{ $title }}</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-900 text-white font-sans leading-normal tracking-normal min-h-screen">


    <x-navbar></x-navbar>

    <!-- Main content -->
    <main class="container mx-auto py-6">
        @yield('content')
    </main>

    @yield('scripts')

    @if(session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                icon: 'success',
                background: '#131420',
                color: '#ffffff',
                confirmButtonColor: '#aefcf3',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'rounded-lg',
                    confirmButton: 'text-black font-semibold',
                }
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                title: 'Gagal!',
                text: '{{ session("error") }}',
                icon: 'error',
                background: '#131420',
                color: '#ffffff',
                confirmButtonColor: '#aefcf3',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'rounded-lg',
                    confirmButton: 'text-black font-semibold',
                }
            });
        </script>
    @endif
</body>
</html>
