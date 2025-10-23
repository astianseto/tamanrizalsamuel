<x-layout>Taman Rizal Samuel | 404 Not Found</x-layout>

<div class="flex justify-center items-center py-20 px-5">
    <!-- CARD 404 -->
    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-8 max-w-md text-center">
         <h1 class="text-5xl font-bold text-blue-500 mb-2">404</h1>
        <h2 class="text-2xl font-semibold text-blue-800 mb-4">Halaman Tidak Ditemukan</h2>
        <p class="text-gray-600 mb-6">
            Maaf, halaman yang kamu cari tidak tersedia. Silakan kembali ke beranda atau cek link lainnya.
        </p>
        <a href="{{ url('/') }}" class="px-6 py-3 bg-blue-500 text-white rounded hover:bg-blue-600 transition font-medium">
            Kembali ke Beranda
        </a>
    </div>
</div>


<x-footer></x-footer>