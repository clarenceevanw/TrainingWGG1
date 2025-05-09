@extends('layout')

@section('content')
<div class="min-h-screen text-white flex items-center justify-center px-4">
    <div class="bg-[#131420] p-8 rounded-lg w-full max-w-md shadow-lg">
        <h1 class="text-2xl font-bold mb-2 text-center">Tambah Pegawai</h1>
        <p class="text-gray-400 text-sm text-center mb-6">Lengkapi data pegawai di bawah ini</p>

        <form action="{{ route('pegawai.store') }}" method="POST" class="space-y-5 form-create">
            @csrf
            <div>
                <label for="name" class="block text-sm mb-1">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="w-full px-4 py-2 rounded bg-[#1a1b2e] border border-gray-700 focus:ring focus:border-blue-500 outline-none">
                @error('name')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 rounded bg-[#1a1b2e] border border-gray-700 focus:ring focus:border-blue-500 outline-none">
                @error('email')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="division_id" class="block text-sm mb-1">Divisi</label>
                <select id="division_id" name="division_id"
                    class="w-full px-4 py-2 rounded bg-[#1a1b2e] border border-gray-700 focus:ring focus:border-blue-500 outline-none">
                    <option value="">-- Pilih Division --</option>
                    @foreach ($division as $div)
                        <option value="{{ $div->id }}" {{ old('division_id') == $div->name ? 'selected' : '' }}>
                            {{ $div->name }}
                        </option>
                    @endforeach
                </select>
                @error('division_id')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="level_akses_id" class="block text-sm mb-1">Level Akses</label>
                <select id="level_akses" name="level_akses_id"
                    class="w-full px-4 py-2 rounded bg-[#1a1b2e] border border-gray-700 focus:ring focus:border-blue-500 outline-none">
                    <option value="">-- Pilih Level Akses --</option>
                    @foreach ($level_akses as $akses)
                        <option value="{{ $akses->id }}" {{ old('level_akses_id') == $akses->name ? 'selected' : '' }}>
                            {{ $akses->name }}
                        </option>
                    @endforeach
                </select>
                @error('level_akses_id')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center space-x-2">
                <button type="button"
                    class="simpan-button w-full px-4 py-2 bg-[#aefcf3] text-black font-semibold rounded hover:bg-[#89e2d6]">
                    Simpan
                </button>
                <a href="{{ route('pegawai.index') }}"
                    class="w-full text-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const simpanButton = document.querySelector('.simpan-button');

        simpanButton.addEventListener('click', function (e) {
            e.preventDefault();
            const form = document.querySelector('.form-create');

            Swal.fire({
                title: 'Yakin ingin simpan?',
                text: "Data pegawai akan disimpan ke sistem.",
                icon: 'warning',
                background: '#131420',
                color: '#ffffff',
                showCancelButton: true,
                confirmButtonColor: '#aefcf3',
                cancelButtonColor: '#444',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-lg',
                    confirmButton: 'text-black font-semibold',
                    cancelButton: 'text-white'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection


