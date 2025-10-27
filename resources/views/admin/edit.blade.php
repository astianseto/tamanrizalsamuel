<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            </h2>
            <a href="{{ route('dashboard') }}" 
               class="text-sm text-blue-600 hover:underline">
                ← Kembali ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-8">
            
            {{-- Judul --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">✏️ Jawab Aduan</h1>
                <p class="text-gray-500 text-sm mt-1">
                    Jawab aduan pengguna di bawah ini.
                </p>
            </div>

            {{-- Formulir Edit --}}
            <form method="POST" action="{{ route('admin.update', $aduan->kode_aduan) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Aduan</label>
                    <input type="text" 
                           name="nama"  
                           value="{{ $aduan->kode_aduan }}" 
                           class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none bg-gray-100 cursor-not-allowed"
                           readonly
                           tabindex="-1"
                           disabled>
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" 
                           name="nama" 
                           value="{{ $aduan->nama }}" 
                           class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none bg-gray-100 cursor-not-allowed"
                           readonly
                           tabindex="-1"
                           disabled>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Aduan</label>
                    <textarea name="aduan" 
                              rows="4"
                              class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none bg-gray-100 cursor-not-allowed"
                              readonly
                              tabindex="-1"
                              disabled>{{ $aduan->aduan }}</textarea>
                </div>

                {{-- Status (opsional jika ada kolom status di tabel) --}}
                @if(isset($aduan->status))
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" 
                                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none">
                            <option value="Proses" {{ $aduan->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                            <option value="Selesai" {{ $aduan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                @endif

                {{-- Tombol Aksi --}}
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-xl text-gray-600 hover:bg-gray-100 transition">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-5 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition">
                        💾 Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
