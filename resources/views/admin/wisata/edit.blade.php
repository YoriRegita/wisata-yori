<x-app-layout>
    <div class="bg-surface min-h-screen">
        <div class="max-w-3xl mx-auto px-4 py-8 md:py-10">

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h1 class="text-2xl font-semibold text-ink">Edit Wisata</h1>
                <p class="text-muted mt-1">Perbarui data wisata.</p>

                @if($errors->any())
                    <div class="mt-4 p-3 rounded-xl bg-red-50 border border-red-200 text-red-700">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="mt-6" method="POST" action="{{ route('admin.wisata.update', $wisata) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-ink">Judul</label>
                            <input name="judul" value="{{ old('judul', $wisata->judul) }}"
                                class="mt-1 w-full rounded-lg border-gray-300 bg-white px-3 py-2 shadow-sm focus:border-brand-500 focus:ring-brand-500">
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">
                                Kategori Wisata
                            </label>

                            <select name="category_id"
                                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                                required>
                                <option value="">-- Pilih Kategori --</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div>
                            <label class="block text-sm font-medium text-ink">Deskripsi</label>
                            <textarea name="deskripsi" rows="6"
                                class="mt-1 w-full rounded-lg border-gray-300 bg-white px-3 py-2 shadow-sm focus:border-brand-500 focus:ring-brand-500">{{ old('deskripsi', $wisata->deskripsi) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-ink">Link Google Maps</label>
                            <input name="google_maps_url" value="{{ old('google_maps_url', $wisata->google_maps_url) }}"
                                class="mt-1 w-full rounded-lg border-gray-300 bg-white px-3 py-2 shadow-sm focus:border-brand-500 focus:ring-brand-500">

                            @if(!empty($wisata->google_maps_url))
                                <div class="mt-3 h-44 rounded-xl overflow-hidden border">
                                    <iframe
                                        src="https://www.google.com/maps?q={{ urlencode($wisata->google_maps_url) }}&output=embed"
                                        class="w-full h-full border-0" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-ink">Foto saat ini</label>
                            @if($wisata->foto)
                                <img src="{{ asset('storage/' . $wisata->foto) }}"
                                    class="mt-2 h-40 w-full object-cover rounded-xl border" alt="">
                            @else
                                <div class="mt-2 p-3 rounded-xl bg-surface border border-gray-100 text-sm text-muted">
                                    Belum ada foto.
                                </div>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-ink">Ganti Foto (opsional)</label>
                            <input type="file" name="foto" class="mt-1 w-full">
                            <p class="text-xs text-muted mt-1">Jika diisi, foto lama akan diganti.</p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-2 pt-2">
                            <x-btn type="submit">Update</x-btn>
                            <x-btn href="{{ route('admin.wisata.index') }}" variant="outline">Kembali</x-btn>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>