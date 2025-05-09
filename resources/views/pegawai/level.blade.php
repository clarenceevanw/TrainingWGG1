@extends('layout')

@section('content')
<div class="md:pl-[18rem] p-6 bg-gray-900 min-h-screen text-white">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Daftar Pegawai Berdasarkan Level Akses</h1>
        <div class="flex gap-3">
            <a href="{{ route('pegawai.createAkses') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded-lg text-sm font-medium">
                + Tambah Level Akses
            </a>
            <a href="{{ route('pegawai.akses') }}" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 rounded-lg text-sm font-medium">
                Edit Level Akses
            </a>
        </div>
    </div>

    @forelse($levels as $level)
        <div class="mb-8 bg-gray-800 rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold text-yellow-400 mb-4">{{ $level['name'] }}</h2>

            @if($level['pegawais']->isEmpty())
                <p class="text-gray-400">Tidak ada pegawai di level ini.</p>
            @else
                <ul class="space-y-2">
                    @foreach($level->pegawais as $pegawai)
                        <li class="flex items-center space-x-3 bg-gray-700 p-3 rounded hover:bg-gray-600">
                            <div class="w-8 h-8 flex items-center justify-center rounded-full bg-green-400 text-black font-bold">
                                {{ strtoupper(substr($pegawai['name'], 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-medium text-white">{{ $pegawai['name'] }}</p>
                                <p class="text-sm text-gray-400">{{ $pegawai['email'] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @empty
        <p class="text-gray-400">Tidak ada data level akses.</p>
    @endforelse
</div>
@endsection
