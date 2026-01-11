<x-app-layout>
    <div class="bg-surface min-h-screen">
        <!-- HERO -->
        <section class="max-w-6xl mx-auto px-4 py-10 md:py-14">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl font-semibold text-ink leading-tight">
                        Jelajahi <span class="text-brand-600">Wisata Paluta</span>
                    </h1>
                    <p class="mt-4 text-muted leading-relaxed">
                        Temukan beragam destinasi wisata unggulan di Kabupaten Padang Lawas Utara. Jelajahi keindahan alam, serta informasi lengkap mulai dari deskripsi, galeri foto, hingga lokasi terintegrasi dengan Google Maps.
                    </p>

                    <div class="mt-6 flex flex-col sm:flex-row gap-3">
                        <form method="GET" action="{{ route('wisata.index') }}" class="flex-1">
                            <div class="flex gap-2">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari wisata..."
                                    class="w-full rounded-lg border-gray-300 bg-white px-3 py-2 focus:border-brand-500 focus:ring-brand-500">
                                <x-btn type="submit">Cari</x-btn>
                            </div>
                        </form>

                        @auth
                            @if(auth()->user()->role === 'admin')
                                <x-btn href="{{ route('admin.wisata.create') }}" variant="outline">
                                    + Tambah
                                </x-btn>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="hidden md:block">
                    <div class="rounded-2xl bg-white border border-gray-100 shadow-sm p-6">
                        <div class="rounded-2xl bg-surface border border-gray-100 overflow-hidden">
                            <img src="{{ asset('images/hero-tourism.png') }}" alt="Ilustrasi wisata"
                                class="w-full h-[320px] object-contain p-6">
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- LIST -->
        <section class="max-w-6xl mx-auto px-4 pb-12">
            <div>
                <h2 class="text-2xl font-semibold text-ink">Daftar Wisata</h2>
                <p class="text-muted mt-1">Klik kartu untuk melihat informasi lengkap.</p>
            </div>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($wisatas as $w)
                    <a href="{{ route('wisata.show', $w) }}"
                        class="group bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition">
                        @if ($w->foto)
                            <img src="{{ asset('storage/' . $w->foto) }}" alt="{{ $w->judul }}"
                                class="h-48 w-full object-cover group-hover:opacity-95 transition">
                        @else
                            <div class="h-48 bg-surface"></div>
                        @endif

                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-ink group-hover:text-brand-700 transition">
                                {{ $w->judul }}
                            </h3>

                            <p class="mt-2 text-sm text-muted line-clamp-3 leading-relaxed">
                                {{ $w->deskripsi }}
                            </p>

                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-sm font-medium text-brand-700">Lihat detail →</span>
                                @if(!empty($w->google_maps_url))
                                    <span
                                        class="text-xs px-2 py-1 rounded-full bg-brand-50 text-brand-700 border border-brand-100">
                                        Ada lokasi
                                    </span>
                                @endif
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center text-ink mt-10">
                        @if(request('search'))
                            Tidak ada wisata dengan kata kunci
                            <span class="font-semibold">"{{ request('search') }}"</span>.
                        @else
                            Belum ada data wisata.
                        @endif
                    </div>
                @endforelse
            </div>

            <div class="mt-10">
                {{ $wisatas->links() }}
            </div>
        </section>
    </div>
</x-app-layout>