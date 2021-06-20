<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\aspirasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AspirasiController extends Controller
{
    public function adminindex()
    {
        $aspirasis = aspirasi::orderBy('id', 'ASC')->get();
        return view('admin.aspirasi.index', compact('aspirasis'));
    }

    public function detailaspirasi($id)
    {
        $data = aspirasi::find($id);
        $idaspirasi = $id;
        return view('admin.aspirasi.edit_aspirasi', compact('data', 'idaspirasi'));
    }

    public function update_aspirasi(Request $request, $id)
    {
        $id = $id;
        // $request->validate([
        //     'deskripsi' => 'required',
        //     'id_user' => 'required',
        //     'komentar' => 'required',
        // ]);
        // aspirasi::where("id", $id)->update($request->except(['_token','_method']));
        //
        // return redirect()->route('aspirasi');
        aspirasi::where("id", $id)->update([
            'komentar' => $request->komentar,
            // 'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);
        return redirect()->route('aspirasi')->with('success', 'Berhasil menambahkan');
    }
    public function hapus_aspirasi(Request $request)
    {
        aspirasi::where('id',$request->id)->delete();
        return redirect()->route('aspirasi');
    }

    public function list_aspirasi(Request $request)
    {
        $aspirasis = aspirasi::paginate(9);
        return view('mahasiswa.Aspirasi.index', compact('aspirasis'));
    }

    public function pengurusaspirasi(Request $request)
    {
        $aspirasis = aspirasi::paginate(9);
        return view('pengurus.Aspirasi.index', compact('aspirasis'));
    }
}
