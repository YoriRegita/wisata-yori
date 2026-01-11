<x-app-layout>
    <div class="bg-surface min-h-screen">
        <div class="max-w-3xl mx-auto px-4 py-8 md:py-10">

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h1 class="text-2xl font-semibold text-ink">Tambah Wisata</h1>
                <p class="text-muted mt-1">Masukkan judul, deskripsi, link maps, dan foto.</p>

                @if(session('success'))
                    <div class="mt-4 p-3 rounded-xl bg-brand-50 border border-brand-100 text-brand-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mt-4 p-3 rounded-xl bg-red-50 border border-red-200 text-red-700">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="mt-6"
                      method="POST"
                      action="{{ route('admin.wisata.store') }}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-ink">Judul</label>
                            <input name="judul" value="{{ old('judul') }}"
                                   class="mt-1 w-full rounded-lg border-gray-300 bg-white px-3 py-2 shadow-sm focus:border-brand-500 focus:ring-brand-500"
                                   placeholder="Contoh: Danau Tasik Aja">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-ink">Deskripsi</label>
                            <textarea name="deskripsi" rows="6"
                                      class="mt-1 w-full rounded-lg border-gray-300 bg-white px-3 py-2 shadow-sm focus:border-brand-500 focus:ring-brand-500"
                                      placeholder="Tulis deskripsi lengkap...">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-ink">Link Google Maps</label>
                            <input name="google_maps_url" value="{{ old('google_maps_url') }}"
                                   class="mt-1 w-full rounded-lg border-gray-300 bg-white px-3 py-2 shadow-sm focus:border-brand-500 focus:ring-brand-500"
                                   placeholder="https://maps.app.goo.gl/...">
                            <p class="text-xs text-muted mt-1">Google Maps → Share → Copy link.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-ink">Foto (opsional)</label>
                            <input type="file" name="foto" class="mt-1 w-full">
                            <p class="text-xs text-muted mt-1">jpg/jpeg/png/webp max 2MB.</p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-2 pt-2">
                            <x-btn type="submit">Simpan</x-btn>
                            <x-btn href="{{ route('admin.wisata.index') }}" variant="outline">Kembali</x-btn>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
