<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\artikel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function listArtikel()
    {
        $artikels = artikel::paginate(6);;
//        $artikels = artikel::orderBy('judul_artikel', 'DESC')->get();
        $i = 1;
        return view('admin.artikel.index', compact('i', 'artikels'));
    }

    public function tambah_artikel()
    {
        return view('admin.artikel.tambah_artikel');
    }

    public function store_artikel(Request $request)
    {
        $file = $request->file('artikel_thumbnail');
        $original = $file->getClientOriginalName();
        $original2 = pathinfo($original, PATHINFO_FILENAME);
        $file_name = Str::slug($original2, "-");

        $imageName = $file_name . '-' . time() . '.' . $file->extension();
        $file->storeAs('public/images/artikel/', $imageName);

        $store = artikel::create([
            'judul_artikel' => $request->judul_artikel,
            'artikel_slug' => $request->artikel_slug,
            'artikel_thumbnail' => $imageName,
            'artikel_content' => $request->artikel_content
        ]);
        return redirect()->route('artikel')->with('success', 'Tambah Artikel Berhasil!');
    }

    public function detail($artikel_id)
    {
        $data = artikel::find($artikel_id);
        $id = $artikel_id;
        return view('admin.artikel.edit_artikel', compact('data', 'id'));
    }

    public function update_artikel(Request $request, $artikel_id)
    {
        $id = $artikel_id;
        $request->validate([
            'judul_artikel' => 'required',
            'artikel_slug' => 'required',
            'artikel_content' => 'required',
        ]);
        if ($request->hasFile('artikel_thumbnail')) {
            // dd($request->file('foto'));
            $file = $request->file('artikel_thumbnail');
            $original = $file->getClientOriginalName();
            $original2 = pathinfo($original, PATHINFO_FILENAME);
            $file_name = Str::slug($original2, "-");
            $imageName = $file_name . '-' . time() . '.' . $file->extension();
            $file->storeAs('public/images/artikel/', $imageName);
            $request->validate([
                'artikel_thumbnail' => 'required'
            ]);

            artikel::where("artikel_id", $id)->update(['artikel_thumbnail' => $imageName]);
        }
        artikel::where("artikel_id", $id)->update($request->except(['_token', '_method', 'artikel_thumbnail']));
        return redirect()->route('artikel')->with('success', 'Update Artikel Berhasil');
    }

    public function hapus_artikel(Request $request)
    {
        artikel::where('artikel_id', $request->id)->delete();
        return redirect()->route('artikel');
    }
}
