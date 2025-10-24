<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-bold mb-4">Data Aduan</h3>
            <table class="min-w-full border border-gray-300 text-sm">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="border px-4 py-2">Kode Aduan</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Telepon</th>
                        <th class="border px-4 py-2">Tanggal Aduan</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aduan as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $item->kode_aduan }}</td>
                            <td class="border px-4 py-2">{{ $item->nama }}</td>
                            <td class="border px-4 py-2">{{ $item->telfon }}</td>
                            <td class="border px-4 py-2">{{ $item->created_at->format('d/m/Y') }}</td>
                            <td class="border px-4 py-2 text-center">

    <a href="{{ route('admin.edit', $item->kode_aduan) }}" 
       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm transition">
       ✏️ Edit
    </a>

    <form action="{{ route('admin.destroy', $item->kode_aduan) }}" 
          method="POST" 
          class="inline-block"
          onsubmit="return confirm('Yakin ingin menghapus aduan ini?');">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm transition">
            🗑️ Hapus
        </button>
    </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
