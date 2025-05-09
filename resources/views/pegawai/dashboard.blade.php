@extends('layout')

@section('content')
<div class="md:pl-[18rem] p-10 md:p-6 bg-gray-900 min-h-screen text-white">
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

    {{-- Statistik Singkat --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-gray-800 p-4 rounded-lg shadow">
            <h2 class="text-sm text-gray-400">Total Pegawai</h2>
            <p class="text-2xl font-bold">{{ $totalPegawai }}</p>
        </div>
        <div class="bg-gray-800 p-4 rounded-lg shadow">
            <h2 class="text-sm text-gray-400">Divisi Terbanyak</h2>
            <p class="text-lg">{{ $topDivisionName }} ({{ $topDivisionCount }})</p>
        </div>
        <div class="bg-gray-800 p-4 rounded-lg shadow">
            <h2 class="text-sm text-gray-400">Level Akses Terbanyak</h2>
            <p class="text-lg">{{ $topLevelName }} ({{ $topLevelCount }})</p>
        </div>
    </div>

    {{-- Daftar Pegawai Terbaru --}}
    <div class="bg-gray-800 rounded-lg overflow-auto shadow">
        <div class="p-4 border-b border-gray-700">
            <h2 class="text-xl font-semibold">Pegawai Terbaru</h2>
        </div>
        <table class="min-w-full text-sm">
            <thead class="bg-gray-700">
                <tr>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Divisi</th>
                    <th class="p-3 text-left">Level Akses</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentPegawai as $pegawai)
                <tr class="border-b border-gray-700 hover:bg-gray-700">
                    <td class="p-3">{{ $pegawai->name }}</td>
                    <td class="p-3">{{ $pegawai->email }}</td>
                    <td class="p-3">{{ $pegawai->division->name }}</td>
                    <td class="p-3">{{ $pegawai->levelAkses->name }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="p-3 text-center">Tidak ada data pegawai terbaru.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
