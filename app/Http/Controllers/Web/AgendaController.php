<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\agenda;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class agendaController extends Controller
{
    public function index_agenda()
    {
        $agendas = agenda::paginate(6);
        $datennow = Carbon::now();
        return view('pengurus.Agenda.index', compact('agendas', 'datennow'));
    }

    public function showAgenda($id)
    {
//        $agendas = agenda::orderBy('nama_agenda','DESC')->select('*')->get();
        $agenda = agenda::where('id', $id)->first();
        $news = agenda::orderBy('created_at', 'desc')->take(5)->get();
        return view('pengurus.Agenda.detailAgenda', compact('agenda', 'news'));
    }

    public function adminindex()
    {
        $agendas = agenda::orderBy('nama_agenda', 'ASC')->get();
        return view('admin.agenda.index', compact('agendas'));
    }

    public function tambah_agenda()
    {
        return view('admin.agenda.tambah_agenda');
    }

    public function store_agenda(Request $request)
    {
        $file = $request->file('foto_agenda');
        $original = $file->getClientOriginalName();
        $original2 = pathinfo($original, PATHINFO_FILENAME);
        $file_name = Str::slug($original2, "-");

        $imageName = $file_name . '-' . time() . '.' . $file->extension();
        $file->storeAs('public/images/agenda/', $imageName);

        $store = agenda::create([
            'nama_agenda' => $request->nama_agenda,
            'isi_agenda' => $request->isi_agenda,
            'foto_agenda' => $imageName,
            'created_at' => $request->created_at,
        ]);
        return redirect()->route('agenda')->with('success', 'Tambah Agenda Berhasil!');
//        session()->flash('message', 'Article ' . $store['article_title'] . ' berhasil di tambahkan');
    }

    public function detailagenda($id)
    {
        $data = agenda::find($id);
        $idagenda = $id;
        return view('admin.agenda.edit_agenda', compact('data', 'idagenda'));
    }

    public function update_agenda(Request $request, $id)
    {
//        $idagenda = $id;
        $request->validate([
            'nama_agenda' => 'required',
            'isi_agenda' => 'required',
        ]);
        if ($request->hasFile('foto_agenda')) {
            // dd($request->file('foto'));
            $file = $request->file('foto_agenda');
            $original = $file->getClientOriginalName();
            $original2 = pathinfo($original, PATHINFO_FILENAME);
            $file_name = Str::slug($original2, "-");
            $imageName = $file_name . '-' . time() . '.' . $file->extension();
            $file->storeAs('public/images/agenda/', $imageName);
            $request->validate([
                'foto_agenda' => 'required'
            ]);

            agenda::where("id", $id)->update(['foto_agenda' => $imageName]);
        }

        agenda::where("id", $id)->update($request->except(['_token', '_method', 'foto_agenda']));

        return redirect()->route('agenda')->with('success', 'Update Artikel Berhasil');
    }

    public function hapus_agenda(Request $request)
    {
        agenda::where('id', $request->id)->delete();
        return redirect()->route('agenda');
    }
}
