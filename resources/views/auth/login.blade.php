<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: {{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen px-4">
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


    <div class="bg-gradient-to-b from-gray-800 to-gray-900 p-8 rounded-2xl shadow-2xl w-full max-w-md border border-gray-700">
        <div class="text-center mb-6">
            <img src="https://cdn-icons-png.flaticon.com/512/5956/5956617.png" alt="Admin Icon" class="w-16 h-16 mx-auto mb-3">
            <h1 class="text-3xl font-bold">Login Pegawai</h1>
            <p class="text-gray-400 text-sm mt-1">Akses web admin pegawai dengan akun Google</p>
        </div>

        {{-- Tombol Login Google --}}
        <a href="{{ route('auth.google.redirect') }}"
           class="flex items-center justify-center gap-3 w-full bg-white hover:bg-gray-100 text-gray-900 font-semibold py-2.5 px-4 rounded-lg transition duration-200 shadow-sm">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5">
            Login dengan Google
        </a>

        <p class="text-center text-gray-500 text-xs mt-6">Powered by clarenceevanw</p>
    </div>
</body>
</html>
