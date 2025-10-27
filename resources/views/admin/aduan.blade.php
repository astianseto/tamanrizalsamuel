<x-app-layout>
    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Notifikasi --}}
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
            {{-- Header --}}
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Aduan Sudah Approve</h3>
            </div>

            {{-- Filter --}}
<form method="GET" action="{{ route('admin.aduan') }}" class="flex flex-wrap items-end gap-4 mb-6">

    <!-- Filter Tanggal -->
    <div class="flex gap-2 items-center">
        <label class="text-sm text-gray-600">Tanggal:</label>
        <input type="date" name="start_date" value="{{ request('start_date') }}"
            class="border rounded-lg px-2 py-1 text-sm">
        <span class="text-gray-500">s/d</span>
        <input type="date" name="end_date" value="{{ request('end_date') }}"
            class="border rounded-lg px-2 py-1 text-sm">
    </div>

    <!-- Filter Status Jawaban -->
    <div>
        <label class="block text-sm text-gray-600 mb-1">Status Jawaban</label>
        <select name="jawaban_status" class="border rounded-lg px-3 py-2 text-sm">
            <option value="">Semua</option>
            <option value="sudah" {{ request('jawaban_status') == 'sudah' ? 'selected' : '' }}>Sudah Dijawab</option>
            <option value="belum" {{ request('jawaban_status') == 'belum' ? 'selected' : '' }}>Belum Dijawab</option>
        </select>
    </div>

    <!-- Tombol Filter & Reset -->
    <div class="flex gap-2">
        <button type="submit" 
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
            🔍 Filter
        </button>
        <a href="{{ route('admin.aduan') }}" 
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium transition">
            🔄 Reset
        </a>
    </div>

    <a href="{{ route('admin.export.unanswered') }}" 
   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
    📊 Download Aduan Yang Belum Dijawab
</a>

</form>


            {{-- Tabel Aduan --}}
            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 text-left">
                            <th class="px-4 py-3 border-b">Kode Aduan</th>
                            <th class="px-4 py-3 border-b">Nama</th>
                            <th class="px-4 py-3 border-b">Isi Aduan</th>
                            <th class="px-4 py-3 border-b text-center">Jawaban</th>
                            <th class="px-4 py-3 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($aduan as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 border-b font-medium text-gray-800">{{ $item->kode_aduan }}</td>
                                <td class="px-4 py-3 border-b">{{ $item->nama }}</td>
                                <td class="px-4 py-3 border-b">{{ Str::limit($item->aduan, 50) }}</td>
                                <td class="px-4 py-3 border-b text-center">
                                @if(!empty($item->detailAduan->jawaban))
                                    ✅
                                @else
                                    ⏳
                                @endif
                                </td>
                                <td class="px-4 py-3 border-b text-center space-x-2">
                                    <a href="{{ route('admin.edit', $item->kode_aduan) }}" 
                                       class="inline-flex items-center bg-sky-400 hover:bg-sky-500 text-white px-3 py-1.5 rounded-lg text-xs transition">
                                       💬 Jawab
                                    </a>
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
