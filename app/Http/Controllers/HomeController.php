<?php

namespace App\Http\Controllers;

use App\Models\agenda;
use App\Models\artikel;
use App\Models\aspirasi;
use App\Models\komentar_artikel;
use App\Models\pendaftaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

//     -->ini merupakan function ketika mengkases ini harus login dulu ges
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function main()
    {
        $id=Auth::id();
        $artikel = artikel::latest()->paginate(3);
        $aspirasis = aspirasi::latest()->take(3)->get();
        $agendas = agenda::latest()->take(3)->get();
        $cekvalid = pendaftaran::where('id_user',$id)->first();
        return view('main', compact('artikel', 'aspirasis', 'agendas','cekvalid'));
    }

    public function detailArtikel($artikel_slug)
    {
//        $usersID = Auth::user()->id;
//        $users = User::where('id', $usersID)->first();
        $artikel = artikel::where('artikel_slug', $artikel_slug)->first();
        $news = artikel::orderBy('created_at', 'desc')->take(5)->get();
        $komentars = komentar_artikel::where('artikel_id', $artikel->artikel_id)->get();
        $countkomen = komentar_artikel::where('artikel_id', $artikel->artikel_id)->count();

        return view('mahasiswa.Artikel.detailArtikel', compact('artikel', 'komentars', 'countkomen', 'news'));
    }

    public function storekomentar(Request $request)
    {
        komentar_artikel::create([
            'artikel_id' => $request->artikel_id,
            'nama' => $request->nama,
            'email' => $request->email,
            'komentar' => $request->komentar
        ]);
        return redirect()->back();
    }

    public function allArtikel()
    {
        $artikel = artikel::paginate(6);

        return view('mahasiswa.Artikel.index', compact('artikel'));
    }


}
