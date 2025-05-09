<!-- HAMBURGER BUTTON -->
<!-- Letakkan DI LUAR sidebar agar tidak ketumpuk -->
<div class="lg:hidden fixed top-4 left-4 z-50">
    <button id="toggleSidebar" class="bg-gray-700 text-white p-2 rounded focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

<!-- OVERLAY -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

<!-- SIDEBAR -->
<div id="sidebar" class="fixed top-0 left-0 w-64 bg-gray-800 text-white h-full transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-50 lg:z-auto">
    <div class="p-6 border-b border-gray-700">
        <h2 class="text-xl font-bold">Admin Panel</h2>
    </div>
    <nav class="mt-6 flex flex-col space-y-2 px-4">
        <a href="{{ route('pegawai.info') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('pegawai.info') ? 'bg-gray-700' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.31.535 6.121 1.481M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Profil Saya
        </a>        
        @if(session('level_akses_name') == 'Admin' || session('level_akses_name') == 'Bos')
        <a href="{{ route('pegawai.dashboard') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('pegawai.dashboard') ? 'bg-gray-700' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
            </svg>
            Dashboard
        </a>
        <a href="{{ route('pegawai.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('pegawai.index') ? 'bg-gray-700' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 0112 3v0a9 9 0 016.879 14.804M15 11h.01M9 11h.01M7 15a4 4 0 0010 0" />
            </svg>
            Pegawai
        </a>
        <a href="{{ route('pegawai.infoAkses') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('pegawai.infoAkses') ? 'bg-gray-700' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h1m4 0h-1a4 4 0 00-4 4v2m0 0h6" />
            </svg>
            Level Akses
        </a>        
        @endif
        <form method="POST" action="{{ route('pegawai.logout') }}">
            @csrf
            <button type="submit" class="w-full text-left flex items-center px-4 py-2 rounded hover:bg-gray-700">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>
                Logout
            </button>
        </form>
    </nav>
</div>

<script>
    const toggleSidebar = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    toggleSidebar.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>

