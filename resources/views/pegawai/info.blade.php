@extends('layout')

@section('content')
<div class="md:pl-[18rem] p-6 bg-gray-900 min-h-screen text-white flex flex-col items-center">

    <!-- Welcome di luar card -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold">Welcome, {{ $pegawai->name }}! 👋</h1>
    </div>

    <!-- Card Profil -->
    <div class="bg-gray-800 w-full max-w-2xl rounded-2xl shadow-xl p-8">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
            <div class="flex items-center justify-center w-24 h-24 rounded-full bg-green-500 text-black text-[3rem] text-center font-bold shadow-inner">
                {{ strtoupper(substr($pegawai->name, 0, 1)) }}
            </div>

            <div class="flex-1">
                <h2 class="text-2xl font-semibold mb-2">{{ $pegawai->name }}</h2>
                <p class="text-gray-400 mb-1"><span class="font-medium text-white">Email:</span> {{ $pegawai->email }}</p>
                <p class="text-gray-400 mb-1"><span class="font-medium text-white">Divisi:</span> {{ $pegawai->division->name ?? '-' }}</p>
                <p class="text-gray-400"><span class="font-medium text-white">Level Akses:</span> {{ $pegawai->levelAkses->name ?? '-' }}</p>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-sm font-medium">
                Edit Profil
            </a>
        </div>
    </div>
</div>
@endsection
