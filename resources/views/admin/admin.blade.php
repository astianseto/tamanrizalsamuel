<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Admin') }}
            </h2>
            <span class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded-full">Active</span>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        {{-- ============================================================
             📊 Statistik Ringkas
        ============================================================ --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- Total Aduan --}}
            <div class="bg-white rounded-2xl shadow-sm p-5 border border-gray-100">
                <p class="text-sm text-gray-500">Total Aduan</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">
                    {{ $totalAduan ?? 0 }}
                </h3>
            </div>

            {{-- Aduan Bulan Ini --}}
            <div class="bg-white rounded-2xl shadow-sm p-5 border border-gray-100">
                <p class="text-sm text-gray-500">Aduan Baru Bulan Ini</p>
                <h3 class="text-2xl font-bold text-blue-600 mt-1">
                    {{ $aduanBulanIni ?? 0 }}
                </h3>
                <p class="text-xs text-gray-400 mt-1">
                    {{ now()->format('F Y') }}
                </p>
            </div>

            {{-- Sudah Approve --}}
            <div class="bg-white rounded-2xl shadow-sm p-5 border border-gray-100">
                <p class="text-sm text-gray-500">Sudah Approve</p>
                <h3 class="text-2xl font-bold text-green-600 mt-1">
                    {{ $aduanApprove ?? 0 }}
                </h3>
                <p class="text-xs text-gray-400 mt-1">Telah disetujui admin</p>
            </div>

            {{-- Belum Approve --}}
            <div class="bg-white rounded-2xl shadow-sm p-5 border border-gray-100">
                <p class="text-sm text-gray-500">Belum Approve</p>
                <h3 class="text-2xl font-bold text-yellow-500 mt-1">
                    {{ $aduanBelumApprove ?? 0 }}
                </h3>
                <p class="text-xs text-gray-400 mt-1">Menunggu proses</p>
            </div>
        </div>

        {{-- ============================================================
             📁 CTA (Menu ke halaman aduan)
        ============================================================ --}}
        <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100 text-center">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Lihat Data Aduan</h3>
            <p class="text-gray-500 mb-6">Kelola data aduan masuk, setujui, atau hapus aduan di halaman berikut.</p>
            
            <div class="flex justify-center space-x-4">
                <a href="{{ route('admin.aduantemp') }}" 
                   class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg text-sm transition">
                    📥 Aduan Belum Approve
                </a>
                <a href="{{ route('admin.aduan') }}" 
                   class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg text-sm transition">
                    ✅ Aduan Disetujui
                </a>
            </div>
        </div>

    </div>
</x-app-layout>
