<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\pemilihan;
use App\Models\cakahim;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PemilihanController extends Controller
{
    public function adminindex()
    {
        $pemilihans = pemilihan::orderBy('id', 'ASC')->get();
        $namacakahim = pemilihan::join('cakahim', 'pemilihan.id_cakahim', 'cakahim.id')
        ->join('users', 'cakahim.id_user', 'users.id')
        ->groupBy('pemilihan.id_cakahim')
        ->get();
        $cakahims = cakahim::orderBy('id', 'ASC')->get();
        $totpemilihan = pemilihan::all()->count();
        $daftarkahims = cakahim::where('status', 'LULUS')->get();

        // $calon = cakahim::where('status', 'LULUS')->pluck('id');
        $hasil = pemilihan::selectRaw('count(id_cakahim) as hasil, pemilihan.*')->groupBy('id_cakahim')->get();

        return view('admin.pemilihan.index', compact('pemilihans', 'cakahims', 'totpemilihan', 'daftarkahims', 'hasil', 'namacakahim'));
    }

    public function tambah_agenda()
    {

    }

    public function store_agenda(Request $request)
    {

    }

    public function detailpemilihan($id)
    {
        $data = cakahim::find($id);
        $idcakahim = $id;
        return view('admin.pemilihan.detail_cakahim', compact('data', 'idcakahim'));
    }

    public function update_cakahim(Request $request, $id)
    {

    }

    public function hapus_daftarcakahim(Request $request)
    {
        cakahim::where('id',$request->id)->delete();
        return redirect()->route('pemilihan');
    }

    public function hapus_pemilihan($id)
    {
        pemilihan::destroy($id);
        return redirect()->route('pemilihan');
    }

    public function getpemilihan(){
      $data = pemilihan::all();
      return response()->json(
        $data
      );
    }
}
