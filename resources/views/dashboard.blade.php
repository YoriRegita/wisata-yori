<x-app-layout>
    <div class="bg-surface min-h-screen">
        <div class="max-w-6xl mx-auto px-4 py-8 md:py-10">
            <h1 class="text-2xl font-semibold text-ink">Dashboard</h1>
            <p class="text-muted mt-1">Ringkasan singkat akun dan website.</p>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <p class="text-sm text-muted">Status</p>
                    <p class="mt-2 text-lg font-semibold text-ink">Login Berhasil</p>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <p class="text-sm text-muted">Role</p>
                    <p class="mt-2 text-lg font-semibold text-ink">{{ auth()->user()->role }}</p>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <p class="text-sm text-muted">Aksi cepat</p>
                    <div class="mt-3 flex gap-2">
                        <x-btn href="{{ route('home') }}" variant="outline">Ke Beranda</x-btn>

                        @if(auth()->user()->role === 'admin')
                            <x-btn href="{{ route('admin.wisata.index') }}">Kelola Wisata</x-btn>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
