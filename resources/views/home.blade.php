<x-layout>Taman Rizal Samuel | Home</x-layout>

<!-- Main Section -->
  <main class="py-12">
    <div class="text-center mb-10">
    <h2 class="text-3xl font-bold text-center text-blue-700 mb-2">Tampa Mpangadu Rizal Samuel</h2>
      <p class="text-gray-500 mt-2">Pilih kanal pengaduan sesuai kebutuhan Anda</p>
    </div>

    <div class="flex flex-col md:flex-row justify-center items-center gap-8 px-6">
      <!-- Card 1 -->
      <div class="bg-white rounded-2xl shadow-sm p-8 w-full md:w-80 text-center hover:shadow-md transition">
        <div class="bg-red-500 text-white w-14 h-14 mx-auto rounded-full flex items-center justify-center mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19a1 1 0 01-1.447.894l-2.724-1.362A2 2 0 015 16.764V7.236a2 2 0 011.829-1.768l2.724-1.362A1 1 0 0111 5.882zm0 0L20 3v18l-9-2.118" />
      </svg>
        </div>
        <h2 class="font-semibold text-lg mb-2">Isi Formulir Pengaduan</h2>
        <p class="text-gray-500 mb-4">Gunakan untuk membuat laporan aduan.</p>
        <a href="form_aduan" class="text-red-600 font-semibold hover:underline">Laporkan Sekarang →</a>
      </div>

      <!-- Card 2 -->
      <div class="bg-white rounded-2xl shadow-sm p-8 w-full md:w-80 text-center hover:shadow-md transition">
        <div class="bg-yellow-500 text-white w-14 h-14 mx-auto rounded-full flex items-center justify-center mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
      </svg>
        </div>
        <h2 class="font-semibold text-lg mb-2">Cek Aduan</h2>
        <p class="text-gray-500 mb-4">Gunakan untuk melihat progres aduan.</p>
        <a href="aduan" class="text-yellow-600 font-semibold hover:underline">Lihat Status →</a>
      </div>
    </div>
  </main>

  @if (session('success'))
    <div id="popupSuccess"
        class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm z-50 opacity-0 scale-90 transition-all duration-300">
        <div class="bg-white rounded-2xl shadow-xl p-8 max-w-sm w-full text-center transform transition-all duration-300">
            <div class="text-5xl text-blue-500 mb-3 animate-bounce">✅</div>
            <h3 class="text-2xl font-semibold text-blue-600 mb-2">Berhasil!</h3>
           <p class="text-gray-700 mb-5">{!! session('success') !!}</p>

            <button id="closePopup"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                Tutup
            </button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const popup = document.getElementById('popupSuccess');
            if (popup) {
                setTimeout(() => {
                    popup.classList.remove('opacity-0', 'scale-90');
                    popup.classList.add('opacity-100', 'scale-100');
                }, 100);

                const closeBtn = document.getElementById('closePopup');
                if (closeBtn) {
                    closeBtn.addEventListener('click', () => {
                        popup.classList.add('opacity-0', 'scale-90');
                        setTimeout(() => popup.remove(), 300);
                    });
                }

                // Auto close setelah 3 detik
                setTimeout(() => {
                    popup.classList.add('opacity-0', 'scale-90');
                    setTimeout(() => popup.remove(), 300);
                }, 100000);
            }
        });
    </script>
@endif


<x-footer></x-footer>