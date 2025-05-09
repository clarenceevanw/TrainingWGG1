@extends('layout')

@section('content')
<div class="min-h-screen text-white flex items-center justify-center px-4">
    <div class="bg-[#131420] p-8 rounded-lg w-full max-w-md shadow-lg">
        <h1 class="text-2xl font-bold mb-2 text-center">Level Akses</h1>
        <p class="text-gray-400 text-sm text-center mb-6">Lengkapi data pegawai di bawah ini</p>

        <form action="{{ route('pegawai.updateAkses') }}" method="POST" class="space-y-5 form-create">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm mb-1">Nama Pegawai</label>
                <select id="name" name="name"
                class="w-full px-4 py-2 rounded bg-[#1a1b2e] border border-gray-700 focus:ring focus:border-blue-500 outline-none">
                <option value="">-- Pilih Pegawai --</option>
                @if($pegawais->isEmpty())
                    <option value="">Tidak ada pegawai</option>
                @else
                    @foreach ($pegawais as $pegawai )
                            <option value="{{ $pegawai->id }}" {{ old('name') == $pegawai['name'] ? 'selected' : '' }}>
                                {{ $pegawai['name'] }}
                            </option>
                    @endforeach
                @endif
                </select>
                    @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
            </div>

            <div>
                <label for="level_akses_id" class="block text-sm mb-1">Level Akses</label>
                <select id="level_akses" name="level_akses_id"
                    class="w-full px-4 py-2 rounded bg-[#1a1b2e] border border-gray-700 focus:ring focus:border-blue-500 outline-none">
                    <option value="">-- Pilih Level Akses --</option>
                    @foreach ($level_akses as $akses)
                        <option value="{{ $akses->id }}" {{ old('level_akses') == $akses->name ? 'selected' : '' }}>
                            {{ $akses->name }}
                        </option>
                    @endforeach
                </select>
                @error('level_akses')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center space-x-2">
                <button type="button"
                    class="simpan-button w-full px-4 py-2 bg-[#aefcf3] text-black font-semibold rounded hover:bg-[#89e2d6]">
                    Edit
                </button>
                <a href="{{ route('pegawai.infoAkses') }}"
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
        const pegawaiSelect = document.getElementById('name');
        const levelSelect = document.getElementById('level_akses');

        pegawaiSelect.addEventListener('change', function () {
            const selectedId = this.value;

            if (selectedId) {
                fetch(`/pegawai/get-level-akses/${selectedId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.level_akses_id) {
                            // Set dropdown level akses ke value yang sesuai
                            levelSelect.value = data.level_akses_id;
                        }
                    })
                .catch(error => {
                    console.error('Gagal mengambil level akses:', error);
                });
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const simpanButton = document.querySelector('.simpan-button');

        simpanButton.addEventListener('click', function (e) {
            e.preventDefault();
            const form = document.querySelector('.form-create');
            Swal.fire({
                title: 'Yakin ingin edit?',
                text: "Data pegawai akan diedit di sistem.",
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

