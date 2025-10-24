<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Aduan</h1>

       <form method="POST" action="{{ route('admin.update', $aduan->kode_aduan) }}">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="block mb-1">Nama</label>
                <input type="text" name="nama" value="{{ $aduan->nama }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-3">
                <label class="block mb-1">Aduan</label>
                <textarea name="aduan" class="w-full border p-2 rounded">{{ $aduan->aduan }}</textarea>
            </div>

            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan Perubahan</button>
        </form>
    </div>
</x-app-layout>
