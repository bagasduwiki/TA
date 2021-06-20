<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\agenda;
use App\Models\aspirasi;
use App\Models\cakahim;
use App\Models\pemilihan;
use App\Models\pendaftaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function adminindex()
    {
        $date = Carbon::now()->format('Y');
        $jumlah = DB::table('users')->selectRaw("count(id) as jumlah, year(created_at) as tahun")->where('created_at', '!=', 'null')->groupBy('tahun')->orderBy('tahun', 'ASC')->get();
        $tahun = DB::table('users')->selectRaw("year(created_at) as tahun")->groupBy('tahun')->where('created_at', '!=', 'null')->orderBy('tahun', 'ASC')->get();
        $agenda = DB::table('agenda')->selectRaw("count(id) as jumlah, year(created_at) as tahun")->groupBy('tahun')->orderBy('tahun', 'ASC')->get();
        $tahun_agenda = DB::table('agenda')->selectRaw("year(created_at) as tahun")->groupBy('tahun')->orderBy('tahun', 'ASC')->get();

        foreach ($jumlah as $i) {
            $jumlah_array[] = $i->jumlah;
        }

        foreach ($tahun as $i) {
            $tahun_array[] = $i->tahun;
        }
        foreach ($agenda as $i) {
            $agenda_array[] = $i->jumlah;
        }
        foreach ($tahun_agenda as $i) {
            $tahunagenda_array[] = $i->tahun;
        }


        $pengurus_aktif = User::where('as', 'pengurus')->count();
        $mahasiswa = User::where(DB::raw("DATE_FORMAT(created_at, '%Y')"), $date)->where('as', 'mahasiswa')->count();
        $jumlah_agenda = agenda::where(DB::raw("DATE_FORMAT(created_at, '%Y')"), $date)->count();
        $pendaftar = pendaftaran::where(DB::raw("DATE_FORMAT(created_at, '%Y')"), $date)->count();

        return view('admin.dashboard.web', compact('pengurus_aktif', 'mahasiswa', 'jumlah_agenda', 'pendaftar'))
            ->with('agenda', json_encode($agenda_array, JSON_NUMERIC_CHECK))
            ->with('tahun_agenda', json_encode($tahunagenda_array, JSON_NUMERIC_CHECK))
            ->with('jumlah', json_encode($jumlah_array, JSON_NUMERIC_CHECK))
            ->with('tahun', json_encode($tahun_array, JSON_NUMERIC_CHECK));
    }


    public function indexmobile()
    {
        $cakahims = cakahim::all()->count();
        $totaspirasi = aspirasi::all()->count();
        $daftarkahims = cakahim::where('status', 'LULUS')->count();
        $totpemilihan = pemilihan::all()->count();
        return view('admin.dashboard.mobile', compact('totpemilihan', 'daftarkahims', 'totaspirasi', 'cakahims'));
    }
}
