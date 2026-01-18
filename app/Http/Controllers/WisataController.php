<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    // publik: lihat daftar
    public function index(Request $request)
    {
        $search = $request->query('search');

        $wisatas = Wisata::when($search, function ($query, $search) {
            $query->where('judul', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(6)
            ->withQueryString(); // supaya pagination + search nyambung

        return view('wisata.index', compact('wisatas', 'search'));

    }

    // admin: list wisata (table)
    public function adminIndex()
    {
        $wisatas = Wisata::latest()->get();
        return view('admin.wisata.index', compact('wisatas'));
    }

    // admin: form tambah
    public function create()
    {
        $categories = \App\Models\Category::orderBy('nama')->get();
        return view('admin.wisata.create', compact('categories'));
    }
    //show detail
    public function show(Wisata $wisata)
    {
        return view('wisata.show', compact('wisata'));
    }

    // admin: simpan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'google_maps_url' => ['required', 'url', 'max:2000'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('wisata', 'public');
        }

        Wisata::create($validated);

        return redirect()->route('admin.wisata.create')
            ->with('success', 'Wisata berhasil ditambahkan.');
    }

    // admin: form edit
    public function edit(Wisata $wisata)
    {
        $categories = \App\Models\Category::orderBy('nama')->get();
        return view('admin.wisata.edit', compact('wisata', 'categories'));
    }


    // admin: update data
    public function update(Request $request, Wisata $wisata)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'google_maps_url' => ['required', 'url', 'max:2000'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            if ($wisata->foto) {
                Storage::disk('public')->delete($wisata->foto);
            }
            $validated['foto'] = $request->file('foto')->store('wisata', 'public');
        }

        $wisata->update($validated);

        return redirect()->route('admin.wisata.index')
            ->with('success', 'Wisata berhasil diupdate');
    }

    // admin: hapus
    public function destroy(Wisata $wisata)
    {
        if ($wisata->foto) {
            Storage::disk('public')->delete($wisata->foto);
        }

        $wisata->delete();

        return redirect()->route('admin.wisata.index')
            ->with('success', 'Wisata berhasil dihapus');
    }

}
