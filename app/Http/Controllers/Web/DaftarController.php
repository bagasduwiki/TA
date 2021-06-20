<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pendaftaran;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DaftarController extends Controller
{

    public function daftarindex()
    {
        $userId = Auth::user()->id;
        $check = pendaftaran::where("id_user", $userId )->get();
        if ($check->count() == 1) {
            return response()->view('errors.403', [], 403);
        }
        else{
            return view('mahasiswa.Pendaftaran.index', compact('userId'));
        }
    }

    public function store_daftar(Request $request)
    {
        $rules = [
            'motivasi' => ['required', 'min:20'],
//            'pengorg' => ['required', 'min:20'],
            'fototer' => ['required'],
        ];
        $messages = [
            'motivasi.required' =>'Wajib Diisi',
            'motivasi.min' =>'Minimal 20 Karakter',
            'pengorg.required' =>'Wajib Diisi',
            'pengorg.min' =>'Minimal 20 Karakter',
            'fototer.required' =>'Wajib Diisi',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $file = $request->file('fototer');
        $original = $file->getClientOriginalName();
        $original2 = pathinfo($original, PATHINFO_FILENAME);
        $file_name = Str::slug($original2, "-");

        $imageName = $file_name . '-' . time() . '.' . $file->extension();
        $file->storeAs('public/images/pendaftaran/', $imageName);

        $store = pendaftaran::create([
            'id_user' => $request->userid,
            'motivasi' => $request->motivasi,
            'pengalaman_org' => $request->pengorg,
            'foto_pendaftar' => $imageName,
        ]);
        return redirect()->route('main')->with('success', 'Berhasil Mendaftar!');
    }


}
