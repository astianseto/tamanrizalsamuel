<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Admin') }}
            </h2>
            <span class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded-full">Active</span>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        {{-- Statistik Ringkas --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl shadow-sm p-5 border border-gray-100">
                <p class="text-sm text-gray-500">Total Aduan</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $aduan->count() }}</h3>
            </div>
            <div class="bg-white rounded-2xl shadow-sm p-5 border border-gray-100">
                <p class="text-sm text-gray-500">Aduan Baru Bulan Ini</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">
                    {{ $aduan->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count() }}
                </h3>
            </div>
            <div class="bg-white rounded-2xl shadow-sm p-5 border border-gray-100">
                <p class="text-sm text-gray-500">Terselesaikan</p>
                <h3 class="text-2xl font-bold text-green-600 mt-1">
                    {{ $aduan->where('status', 'Selesai')->count() }}
                </h3>
            </div>
            <div class="bg-white rounded-2xl shadow-sm p-5 border border-gray-100">
                <p class="text-sm text-gray-500">Dalam Proses</p>
                <h3 class="text-2xl font-bold text-yellow-500 mt-1">
                    {{ $aduan->where('status', 'Proses')->count() }}
                </h3>
            </div>
        </div>

        {{-- Tabel Data Aduan --}}
        <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">📋 Data Aduan</h3>
                <input 
                    type="text" 
                    placeholder="🔍 Cari aduan..." 
                    class="border border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none"
                >
            </div>

            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 text-left">
                            <th class="px-4 py-3 border-b">Kode Aduan</th>
                            <th class="px-4 py-3 border-b">Nama</th>
                            <th class="px-4 py-3 border-b">Telepon</th>
                            <th class="px-4 py-3 border-b">Tanggal Aduan</th>
                            <th class="px-4 py-3 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($aduan as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 border-b text-gray-800 font-medium">{{ $item->kode_aduan }}</td>
                                <td class="px-4 py-3 border-b">{{ $item->nama }}</td>
                                <td class="px-4 py-3 border-b">{{ $item->telfon }}</td>
                                <td class="px-4 py-3 border-b">{{ $item->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-3 border-b text-center space-x-2">
                                    <a href="{{ route('admin.edit', $item->kode_aduan) }}" 
                                       class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs transition">
                                        ✏️ Edit
                                    </a>

                                    <form action="{{ route('admin.destroy', $item->kode_aduan) }}" 
                                          method="POST" 
                                          class="inline-block"
                                          onsubmit="return confirm('Yakin ingin menghapus aduan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs transition">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-gray-500">
                                    Tidak ada data aduan 😕
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
