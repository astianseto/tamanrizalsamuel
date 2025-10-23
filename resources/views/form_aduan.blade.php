<x-layout>Taman Rizal Samuel | Form Aduan</x-layout>

<!-- MAIN CONTENT -->
   <main class="max-w-3xl mx-auto py-12 px-6">
    <h2 class="text-3xl font-bold text-center mb-1 text-blue-700">Form Laporan</h2>
    <p class="text-center text-gray-500 mb-8">Isi form sesuai data Anda dengan benar</p>

    <form class="bg-white shadow-lg rounded-2xl p-8 space-y-5 border border-gray-100">
      <!-- NIK -->
      <div>
        <label for="nik" class="block font-semibold mb-1">NIK <span class="text-red-500">*</span></label>
        <input type="text" id="nik" placeholder="Masukkan NIK Anda" required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
      </div>

      <!-- Nama -->
      <div>
        <label for="nama" class="block font-semibold mb-1">Nama <span class="text-red-500">*</span></label>
        <input type="text" id="nama" placeholder="Masukkan nama Anda" required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
      </div>

      <!-- Alamat -->
      <div>
        <label for="alamat" class="block font-semibold mb-1">Alamat <span class="text-red-500">*</span></label>
        <input type="text" id="alamat" placeholder="Masukkan alamat Anda" required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
      </div>

      <!-- Deskripsi -->
      <div>
        <label for="deskripsi" class="block font-semibold mb-1">Deskripsi Laporan <span class="text-red-500">*</span></label>
        <textarea id="deskripsi" rows="4" placeholder="Tuliskan detail laporan..." required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none resize-none"></textarea>
      </div>

      <!-- Telp -->
      <div>
        <label for="telp" class="block font-semibold mb-1">Telepon <span class="text-red-500">*</span></label>
        <input type="text" id="telp" placeholder="Masukkan nomor telepon Anda" required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
      </div>

      <!-- Lampiran -->
      <div>
        <label for="lampiran" class="block font-semibold mb-1">Lampiran (opsional)</label>
        <input type="file" id="lampiran" accept="image/*"
          class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100" />
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
    </form>
  </main>

<x-footer></x-footer>