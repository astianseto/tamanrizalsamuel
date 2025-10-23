<x-layout>Taman Rizal Samuel | Aduan</x-layout>

<section class="max-w-6xl mx-auto py-14 px-6">
    <h2 class="text-3xl font-bold text-center text-blue-700 mb-2">Daftar Aduan</h2>
    <p class="text-center text-gray-500 mb-10">
        Ikuti perkembangan aduan dan laporan masyarakat yang ditangani Pemerintah Kabupaten Sigi
    </p>

    <!-- 🔍 Box Pencarian Kode Aduan -->
    <div class="rounded-2xl p-6 mb-10">
      
        <form method="GET" action="{{ route('aduan.cari') }}" class="flex flex-col md:flex-row items-center justify-center gap-3">
            <input
                type="text"
                name="kode_aduan"
                placeholder="Masukkan Nomor Aduan untuk melihat perkembangan aduan Anda"
                required
                class="w-full md:w-2/3 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
            >
            <button
                type="submit"
                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition"
            >
                Cari
            </button>
        </form>

        @if(session('not_found'))
            <div class="mt-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg text-red-700">
                Kode aduan tidak ditemukan. Pastikan kode yang Anda masukkan benar.
            </div>
        @endif
    </div>

    <!-- 🧾 Grid Daftar Aduan -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($aduan as $item)
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-5">
            @if($item->file)
                <img src="{{ asset('storage/'.$item->file) }}" alt="File Aduan" class="aspect-video object-cover rounded-xl">
            @else
                <div class="aspect-video bg-blue-100 flex items-center justify-center rounded-xl text-5xl">📸</div>
            @endif

            <div class="mt-5">
                <p class="text-sm text-gray-400 mb-1">
                    {{ $item->created_at->format('d M Y') }}
                </p>
                <h3 class="font-semibold text-lg mb-2 text-gray-800">
                    {{ Str::limit($item->aduan, 60) }}
                </h3>
                <p class="text-gray-600 mb-4">
                    <strong>{{ $item->nama }}</strong><br>
                    {{ Str::limit($item->aduan, 100) }}
                </p>

                <a href="{{ route('aduan.show', ['token' => rawurlencode(\Illuminate\Support\Facades\Crypt::encryptString($item->kode_aduan))]) }}"
                   class="text-blue-600 font-medium hover:underline">
                    Baca Selengkapnya →
                </a>
            </div>
        </div>
        @empty
        <p class="text-center col-span-3 text-gray-500">Belum ada aduan yang dikirim.</p>
        @endforelse
    </div>
</section>

<!-- PAGINATION -->
<div class="mt-10 flex flex-col items-center">
    <div class="mb-2">
        {{ $aduan->links('pagination::tailwind') }}
    </div>
</div>

<x-footer></x-footer>
