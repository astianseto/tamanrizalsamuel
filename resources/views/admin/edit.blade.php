<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">✏️ Jawab Aduan</h2>
            <a href="{{ route('admin.aduan') }}" 
               class="text-sm text-blue-600 hover:underline">
                ← Kembali ke Daftar Aduan
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-8">
            
            {{-- Formulir Jawaban --}}
            <form method="POST" action="{{ route('admin.update', $aduan->kode_aduan) }}" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Kode Aduan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Aduan</label>
                    <input type="text" 
                           value="{{ $aduan->kode_aduan }}" 
                           class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-100 cursor-not-allowed"
                           readonly>
                </div>

                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" 
                           value="{{ $aduan->nama }}" 
                           class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-100 cursor-not-allowed"
                           readonly>
                </div>

                {{-- Isi Aduan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Isi Aduan</label>
                    <textarea rows="4"
                              class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-100 cursor-not-allowed"
                              readonly>{{ $aduan->aduan }}</textarea>
                </div>

                {{-- Jawaban --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jawaban</label>
                    <textarea name="jawaban" rows="4"
                              class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none"
                              placeholder="Tulis jawaban untuk aduan ini...">{{ $aduan->detailAduan->jawaban ?? '' }}</textarea>
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" 
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none">
                        <option value="Proses" {{ ($aduan->detailAduan->status ?? '') == 'Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Selesai" {{ ($aduan->detailAduan->status ?? '') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('admin.aduan') }}" 
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
