<x-app-layout>
    <div class="bg-surface min-h-screen">
        <div class="max-w-6xl mx-auto px-4 py-8 md:py-10">

            <a href="{{ route('home') }}" class="text-sm text-muted hover:text-ink">
                ← Kembali
            </a>

            <div class="mt-4 grid lg:grid-cols-3 gap-6">
                <!-- Left content -->
                <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    @if($wisata->foto)
                        <img src="{{ asset('storage/'.$wisata->foto) }}"
                             alt="{{ $wisata->judul }}"
                             class="w-full h-72 md:h-96 object-cover">
                    @else
                        <div class="w-full h-72 md:h-96 bg-surface"></div>
                    @endif

                    <div class="p-6">
                        <h1 class="text-2xl md:text-3xl font-semibold text-ink">
                            {{ $wisata->judul }}
                        </h1>

                        <p class="mt-4 text-muted leading-relaxed whitespace-pre-line">
                            {{ $wisata->deskripsi }}
                        </p>
                    </div>
                </div>

                <!-- Right sidebar -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-ink">Informasi</h2>
                    <p class="mt-2 text-sm text-muted">
                        Lihat lokasi di peta atau buka langsung di Google Maps.
                    </p>

                    @if(!empty($wisata->google_maps_url))
                        <div class="mt-4 h-52 rounded-xl overflow-hidden border">
                            <iframe
                                src="https://www.google.com/maps?q={{ urlencode($wisata->google_maps_url) }}&output=embed"
                                class="w-full h-full border-0"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>

                        <div class="mt-4 flex flex-col gap-2">
                            <x-btn href="{{ $wisata->google_maps_url }}" target="_blank">
                                Buka di Google Maps
                            </x-btn>

                            <x-btn href="{{ route('home') }}" variant="outline">
                                Lihat wisata lain
                            </x-btn>
                        </div>
                    @else
                        <div class="mt-4 p-4 rounded-xl bg-surface border border-gray-100 text-sm text-muted">
                            Lokasi belum tersedia.
                        </div>
                    @endif

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <div class="mt-6 pt-4 border-t border-gray-100">
                                <p class="text-xs text-muted">Admin Action</p>
                                <div class="mt-2 flex gap-2">
                                    <x-btn href="{{ route('admin.wisata.edit', $wisata) }}" variant="outline">Edit</x-btn>
                                    <form method="POST" action="{{ route('admin.wisata.destroy', $wisata) }}"
                                          onsubmit="return confirm('Hapus wisata ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-btn type="submit" class="bg-red-600 hover:bg-red-700">Hapus</x-btn>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
