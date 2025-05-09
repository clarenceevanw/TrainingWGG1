@extends('layout')

@section('content')
<div class="min-h-screen text-white flex items-center justify-center px-4">
    <div class="bg-[#131420] p-8 rounded-lg w-full max-w-md shadow-lg">
        <h1 class="text-2xl font-bold mb-2 text-center">Tambah Level Akses</h1>
        <p class="text-gray-400 text-sm text-center mb-6">Lengkapi data level akses di bawah ini</p>

        <form id="aksesForm">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm mb-1">Nama Level Akses</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 rounded bg-[#1a1b2e] border border-gray-700 focus:ring focus:border-blue-500 outline-none" required>
            </div>

            <div class="flex justify-between items-center space-x-2">
                <button type="button" class="submit-button w-full px-4 py-2 bg-[#aefcf3] text-black font-semibold rounded hover:bg-[#89e2d6]">
                    Simpan
                </button>
                <a href="{{ route('pegawai.index') }}" class="w-full text-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const submitButton = document.querySelector('.submit-button');
        
        submitButton.addEventListener('click', (e) => {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dimasukkan akan disimpan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#aefcf3',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    submitFormAjax();
                }
            });
        });

        document.addEventListener('keydown',  (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dimasukkan akan disimpan!",
                    icon: 'warning',
                    background: '#131420',
                    color: '#ffffff',
                    showCancelButton: true,
                    confirmButtonColor: '#aefcf3',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, simpan!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'rounded-lg',
                        confirmButton: 'text-black font-semibold',
                        cancelButton: 'text-white'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        submitFormAjax();
                    }
                });
            }
        })
        
    });
    
    async function submitFormAjax(e){
        const form = document.getElementById('aksesForm');
        const formData = new FormData(form);
        try{
            const res = await fetch('{{ route("pegawai.storeAkses") }}', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            if (data.success){
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.success,
                    background: '#131420',
                    color: '#ffffff',
                    confirmButtonColor: '#aefcf3',
                    customClass: {
                        popup: 'rounded-lg',
                        confirmButton: 'text-black font-semibold'
                    }
                }).then(() => {
                    window.location.href = '{{ route("pegawai.infoAkses") }}';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.error,
                    background: '#131420',
                    color: '#ffffff',
                    confirmButtonColor: '#aefcf3',
                    customClass: {
                        popup: 'rounded-lg',
                        confirmButton: 'text-black font-semibold'
                    }
                });
            }
        } catch (error){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                background: '#131420',
                color: '#ffffff',
                confirmButtonColor: '#aefcf3',
                customClass: {
                    popup: 'rounded-lg',
                    confirmButton: 'text-black font-semibold'
                }
            });
        }
    }
</script>
@endsection
