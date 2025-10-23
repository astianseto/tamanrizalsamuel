<x-layout>Taman Rizal Samuel | Form Aduan</x-layout>

<main class="max-w-3xl mx-auto py-12 px-6">
  <h2 class="text-3xl font-bold text-center mb-1 text-blue-700">Form Laporan</h2>
  <p class="text-center text-gray-500 mb-8">Isi form sesuai data Anda dengan benar</p>

  {{-- ✅ Form harus pakai method POST dan enctype multipart --}}
  <form action="{{ route('aduan.store') }}" method="POST" enctype="multipart/form-data" 
        class="bg-white shadow-lg rounded-2xl p-8 space-y-5 border border-gray-100">

    @csrf

    <!-- NIK -->
    <div>
      <label for="nik" class="block font-semibold mb-1">NIK <span class="text-red-500">*</span></label>
      <input type="text" id="nik" name="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK Anda" required
        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
      @error('nik') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <!-- Nama -->
    <div>
      <label for="nama" class="block font-semibold mb-1">Nama <span class="text-red-500">*</span></label>
      <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama Anda" required
        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
      @error('nama') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <!-- Alamat -->
    <div>
      <label for="alamat" class="block font-semibold mb-1">Alamat <span class="text-red-500">*</span></label>
      <input type="text" id="alamat" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan alamat Anda" required
        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
      @error('alamat') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <!-- Deskripsi -->
    <div>
      <label for="aduan" class="block font-semibold mb-1">Deskripsi Laporan <span class="text-red-500">*</span></label>
      <textarea id="aduan" name="aduan" rows="4" placeholder="Tuliskan detail laporan..." required
        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none resize-none">{{ old('aduan') }}</textarea>
      @error('aduan') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <!-- Telepon -->
    <div>
      <label for="telfon" class="block font-semibold mb-1">Telepon <span class="text-red-500">*</span></label>
      <input type="text" id="telfon" name="telfon" value="{{ old('telfon') }}" placeholder="Masukkan nomor telepon Anda" required
        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
      @error('telfon') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <!-- Lampiran -->
    <div>
      <label for="file" class="block font-semibold mb-1">Lampiran (opsional)</label>
      <input type="file" id="file" name="file" accept="image/*"
        class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 
               file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100" />
      @error('file') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <!-- Tombol -->
    <div class="flex justify-end gap-3 pt-4">
      <button type="reset"
        class="px-5 py-2 border border-gray-400 rounded-lg text-gray-600 hover:bg-gray-100 transition">
        Reset
      </button>
      <button type="submit"
        class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
        Kirim Laporan
      </button>
    </div>

    @if (session('success'))
      <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
      </div>
    @endif
  </form>
</main>

<x-footer></x-footer>
