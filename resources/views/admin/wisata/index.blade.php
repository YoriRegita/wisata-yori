<x-app-layout>
    <div class="bg-surface min-h-screen">
        <div class="max-w-6xl mx-auto px-4 py-8 md:py-10">

            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold text-ink">Kelola Wisata</h1>
                    <p class="text-muted mt-1">Tambah, edit, dan hapus data wisata.</p>
                </div>

                <x-btn href="{{ route('admin.wisata.create') }}">+ Tambah Wisata</x-btn>
            </div>

            @if(session('success'))
                <div class="mt-4 p-3 rounded-xl bg-brand-50 border border-brand-100 text-brand-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mt-6 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-surface border-b border-gray-100">
                            <tr class="text-left text-muted">
                                <th class="px-4 py-3 font-medium">Foto</th>
                                <th class="px-4 py-3 font-medium">Judul</th>
                                <th class="px-4 py-3 font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($wisatas as $w)
                                <tr>
                                    <td class="px-4 py-3">
                                        @if($w->foto)
                                            <img src="{{ asset('storage/'.$w->foto) }}"
                                                 class="h-12 w-16 object-cover rounded-lg border" alt="">
                                        @else
                                            <div class="h-12 w-16 bg-surface rounded-lg border"></div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-ink font-medium">
                                        {{ $w->judul }}
                                        <div class="text-xs text-muted mt-1">
                                            <a href="{{ route('wisata.show', $w) }}" class="text-brand-700 hover:underline">
                                                Lihat detail
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap gap-2">
                                            <x-btn href="{{ route('admin.wisata.edit', $w) }}" variant="outline">Edit</x-btn>

                                            <form method="POST" action="{{ route('admin.wisata.destroy', $w) }}"
                                                  onsubmit="return confirm('Hapus wisata ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <x-btn type="submit" class="bg-red-600 hover:bg-red-700">Hapus</x-btn>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-10 text-center text-muted">
                                        Belum ada data wisata.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
