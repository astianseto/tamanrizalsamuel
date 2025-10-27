<x-app-layout>
   

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Aduan Sementara</h3>
                <div class="flex gap-2">
                    <!-- Tombol Hapus Semua -->
                    <form action="{{ route('admin.hapus.semua') }}" method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus semua data aduan?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-xl text-sm font-medium transition">
                            🗑️ Hapus Semua
                        </button>
                    </form>

                    <!-- Input Pencarian -->
                    <input type="text" placeholder="🔍 Cari aduan..." 
                           class="border border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none">
                </div>
            </div>

            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 text-left">
                            <th class="px-4 py-3 border-b">Kode Aduan</th>
                            <th class="px-4 py-3 border-b">Nama</th>
                            <th class="px-4 py-3 border-b">Isi Aduan</th>
                            <th class="px-4 py-3 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($aduan as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 border-b font-medium text-gray-800">
    <a href="{{ route('aduan.show', ['token' => Crypt::encryptString($item->kode_aduan)]) }}"
       class="text-blue-600 hover:underline">
        {{ $item->kode_aduan }}
    </a>
</td>
                                <td class="px-4 py-3 border-b">{{ $item->nama }}</td>
                                <td class="px-4 py-3 border-b">{{ $item->aduan }}</td>
                                <td class="px-4 py-3 border-b text-center space-x-2">
                                    <!-- Tombol Approve -->
                                <form action="{{ route('admin.approve', $item->kode_aduan) }}" 
                                    method="POST" 
                                    onsubmit="return confirm('Setujui aduan ini?');"
                                    class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="inline-flex items-center bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs transition">
                                        ✅ Approve
                                    </button>
                                </form>


                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('admin.hapus', $item->kode_aduan) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs transition"
                                            onclick="return confirm('Yakin ingin menghapus aduan ini?');">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-gray-500">Tidak ada data aduan 😕</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
