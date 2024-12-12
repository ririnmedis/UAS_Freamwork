<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Data Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="container p-4 mx-auto">
        <div class="overflow-x-auto">

            <!-- Button Tambah Data Mahasiswa (commented out) -->
            <a href="{{ route('mahasiswa.create') }}">
                <button class="px-6 py-4 text-white bg-green-500 border border-green-500 rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Tambah Data Mahasiswa
                </button>
            </a> 

            <!-- Button Export to Excel -->
            <a href="{{ route('mahasiswa.export.excel') }}" class="mb-4 inline-block">
                <button class="px-6 py-4 text-white bg-green-500 border border-green-500 rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Export to Excel
                </button>
            </a>

            <!-- Tabel Data Mahasiswa -->
            <table class="min-w-full border-collapse border border-gray-200 mt-4">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">ID</th>
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Nama</th>
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">NPM</th>
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Prodi</th>
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswas as $mahasiswa)
                        <tr class="bg-white">
                            <td class="px-4 py-2 border border-gray-200">{{ $mahasiswa->id }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $mahasiswa->nama }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $mahasiswa->npm }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $mahasiswa->prodi }}</td>
                            <td class="px-4 py-2 border border-gray-200">
                                <!-- <a href="{{ route('mahasiswa.detail', $mahasiswa->id) }}" class="text-blue-500 hover:underline">
                                    Detail
                                </a> -->
                                {{-- <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="px-2 text-blue-600 hover:text-blue-800">Edit</a> --}}
                                <button class="px-2 text-red-600 hover:text-red-800" onclick="confirmDelete({{ $mahasiswa->id }}, '{{ route('mahasiswa.destroy', $mahasiswa->id) }}')">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmDelete(id, deleteUrl) {
            if (confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?')) {
                // Membuat form secara dinamis untuk mengirim permintaan DELETE
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;

                // Menambahkan CSRF token
                let csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                // Menambahkan spoofing method DELETE
                let methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                // Menambahkan form ke body dan submit
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</x-app-layout>
