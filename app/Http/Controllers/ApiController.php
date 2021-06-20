<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use App\Models\aspirasi;
use App\Models\cakahim;
use App\Models\komentar_artikel;
use App\Models\pemilihan;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use League\CommonMark\Block\Element\Document;

class ApiController extends Controller
{
    public function tambahAspirasi(Request $request)
    {
        aspirasi::create([
            'id_user' => $request->id_user,
            'deskripsi' => $request->deskripsi,
        ]);
        return response()->json([
            'kode' => "Berhail Menambahkan Aspirasi",
        ]);
    }

    public function showCakahimID(Request $request)
    {
        $cakahimID = cakahim::where('id_user', $request->id_user)->first();
        return response()->json([
            $cakahimID,
        ]);
    }

    public function showCakahim()
    {
        $cakahim = cakahim::where('status', 'LULUS')->get();
        return response()->json([
            $cakahim,
        ]);
    }

    public function showAspirasiID(Request $request)
    {
        $aspirasi_id = aspirasi::where('id_user', $request->id_user)->get();
        return response()->json([
            $aspirasi_id,
        ]);
    }

    public function users(Request $request)
    {
        $users = User::all();
        return response()->json([
            $users,
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('nim', 'password');

        if(Auth::attempt($credentials)){
            $id=Auth::id();
            $user=User::where('id',$id)->first();
            $as=$user->as;
            return response()->json([
                'id'=>"$id",
                'as'=>$as,
                'kode'=>"222"
            ]);
        }else{
            return response()->json(['kode'=>"333"]);
        }
    }

    public function daftarPemilihan(Request $request)
    {
        $fotos = $request->file('file');
        $imgName = time() . '.' . $fotos->extension();
        $cvs = $request->file('file2');
        $imgNameCV = time() . '.' . $cvs->extension();
        $fotos->storeAs('public/foto-pemilihan', $imgName);
        $cvs->storeAs('public/cv-pemilihan', $imgNameCV);
        //  $document = new Document();

        $store = cakahim::create([
            'id_user' => $request->id_user,
            'ipk' => $request->ipk,
            'foto' => $imgName,
            'cv' => $imgNameCV,
            'visi' => $request->visi,
            'misi' => $request->misi,
        ]   );
        return response()->json([
            'kode' => "000"
        ]);
    }

    public function detailArtikel($artikel_slug)
    {
//        $usersID = Auth::user()->id;
//        $users = User::where('id', $usersID)->first();
        $artikel = artikel::where('artikel_slug', $artikel_slug)->first();
        $news = artikel::orderBy('created_at', 'desc')->take(5)->get();
        return view('mobile.detailArtikel', compact('artikel', 'news'));
    }

    public function allArtikel()
    {
        $artikel = artikel::paginate(6);

        return view('mobile.index', compact('artikel'));
    }
}
