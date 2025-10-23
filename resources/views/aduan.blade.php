<x-layout>Taman Rizal Samuel | Aduan</x-layout>

<section class="max-w-6xl mx-auto py-14 px-6">
    <h2 class="text-3xl font-bold text-center text-blue-700 mb-2">Daftar Aduan</h2>
    <p class="text-center text-gray-500 mb-10">
        Ikuti perkembangan aduan dan laporan masyarakat yang ditangani Pemerintah Kabupaten Sigi
    </p>

    <!-- Grid Aduan -->
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
    <!-- Pagination -->
    <div class="mb-2">
        {{ $aduan->links('pagination::tailwind') }}
    </div>




</div>
</section>

<x-footer></x-footer>
