@extends('layout')

@section('content')
<div class="md:pl-[18rem] p-10 md:p-6 bg-gray-900 min-h-screen text-white">
    <div class="w-full flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold mb-6">Pegawai</h1>
        <div class="flex gap-3">
            <a href="{{ route('pegawai.create') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded-lg text-sm font-medium">
                + Tambah Pegawai
            </a>
        </div>
    </div>
    <div class="overflow-x-auto rounded-lg">
        <table class="min-w-full bg-gray-800 text-sm">
            <thead class="bg-gray-700">
                <tr>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Division</th>
                    <th class="p-3 text-left">Level Akses</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pegawais as $pegawai)
                <tr class="border-b border-gray-700 hover:bg-gray-700">
                    <td class="p-3 flex items-center space-x-2">
                        <div class="w-7 h-7 flex items-center justify-center text-center rounded-full bg-green-400 text-black font-bold">
                            {{ strtoupper(substr($pegawai['name'], 0, 1)) }}
                        </div>
                        <span>{{ $pegawai->name }}</span>
                    </td>
                    <td class="p-3">{{ $pegawai->email }}</td>
                    <td class="p-3">{{ $pegawai->division->name }}</td>
                    <td class="p-3">{{ $pegawai->levelAkses->name }}</td>
                    <td class="p-3 flex justify-center lg:justify-start space-x-2">
                        <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="ml-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded">Edit</a>
                        <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="ml-2 px-4 py-2 bg-red-600 hover:bg-red-700 rounded text-white delete-button">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="p-3 text-center">No pegawai found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');

                Swal.fire({
                    title: 'Are you sure ?',
                    text: "Data tidak bisa dikembalikan setelah dihapus!",
                    icon: 'warning',
                    background: '#131420',
                    color: '#ffffff',
                    showCancelButton: true,
                    confirmButtonColor: '#aefcf3',
                    cancelButtonColor: '#444',
                    confirmButtonText: 'Ya, hapus!',
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
    });
</script>
@endsection
