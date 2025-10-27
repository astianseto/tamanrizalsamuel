<x-layout>Taman Rizal Samuel | Detail Aduan</x-layout>

<main class="max-w-4xl mx-auto bg-white rounded-2xl shadow-md mt-10 p-8">
    {{-- Judul dan Tanggal --}}
    <h2 class="text-2xl font-bold mb-2 text-gray-900"> Detail Aduan </h2>
    <hr class="my-4 border-t border-gray-300">
    <p class="text-gray-500 mb-6">
        Dikirim pada:
        <span class="font-semibold text-gray-700">
            {{ \Carbon\Carbon::parse($aduan->created_at ?? now())->translatedFormat('d F Y') }}
        </span>
<br>
        Kode Aduan:
        <span class="font-semibold text-gray-700">
           {{ $aduan->kode_aduan ?? 'Tidak ada kode' }}
        </span>
    </p>

    <hr class="my-4 border-t border-gray-300">
    {{-- Isi Aduan --}}
    <p class="leading-relaxed text-gray-700 mb-6">
        {{ $aduan->aduan ?? 'Tidak ada deskripsi aduan.' }}
    </p>
    {{-- Gambar --}}
    @if (!empty($aduan->file))
        <img src="{{ asset('storage/' . $aduan->file) }}"
             alt="Foto Aduan"
             class="w-full rounded-lg mb-6 shadow-sm">
    @else
        <div class="aspect-video bg-gray-100 flex items-center justify-center rounded-lg mb-6">
            <span class="text-gray-400 text-4xl">📷</span>
        </div>
    @endif



    {{-- Informasi Pelapor --}}
    <div class="mt-8 border-t pt-5">
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Informasi Pelapor</h3>
        <ul class="text-gray-700 space-y-1">
            <li><strong>Nama:</strong> {{ $aduan->nama ?? '-' }}</li>
            <li><strong>Alamat:</strong> {{ $aduan->alamat ?? '-' }}</li>
            {{-- <li><strong>Kontak:</strong> {{ $aduan->telfon ?? '-' }}</li> --}}
        </ul>
    </div>

    {{-- Jawaban Aduan --}}
    <div class="mt-8 border-t pt-5">
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Jawaban Aduan</h3>
        @if (!empty($aduan->jawaban))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                <p class="text-green-700">{{ $aduan->jawaban }}</p>
            </div>
        @else
            <p class="text-gray-500">Belum ada tanggapan.</p>
        @endif
    </div>

    {{-- Status Progress --}}
    <div class="mt-10 border-t pt-5">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Laporan</h3>

        @php
            $status = strtolower($aduan->latestDetail->status ?? 'ditinjau');
        @endphp

        <div class="flex items-center justify-between relative mb-6">
            <div class="flex-1 h-1 bg-gray-200 absolute left-0 right-0 top-1/2 transform -translate-y-1/2"></div>

            {{-- Step 1 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-8 h-8 flex items-center justify-center rounded-full 
                    {{ in_array($status, ['masuk','diproses','selesai']) ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-700' }}">
                    1
                </div>
                <p class="mt-2 text-sm font-semibold {{ $status == 'masuk' ? 'text-blue-600' : 'text-gray-700' }}">Pengaduan Masuk</p>
            </div>

            {{-- Step 2 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-8 h-8 flex items-center justify-center rounded-full 
                    {{ in_array($status, ['diproses','selesai']) ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-700' }}">
                    2
                </div>
                <p class="mt-2 text-sm {{ $status == 'diproses' ? 'text-blue-600 font-semibold' : 'text-gray-700' }}">Pengaduan diproses</p>
            </div>

            {{-- Step 3 --}}
            <div class="relative z-10 flex flex-col items-center">
                <div class="w-8 h-8 flex items-center justify-center rounded-full 
                    {{ $status == 'selesai' ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-700' }}">
                    3
                </div>
                <p class="mt-2 text-sm {{ $status == 'selesai' ? 'text-blue-600 font-semibold' : 'text-gray-700' }}">Pengaduan Selesai</p>
            </div>
        </div>


    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-10 text-center">
        <a href="{{ route('aduan.index') }}"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-sm transition">
            ← Kembali ke Daftar Aduan
        </a>
    </div>
</main>

<x-footer></x-footer>
