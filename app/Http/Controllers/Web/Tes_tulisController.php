<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\artikel;
use App\Models\jawaban;
use App\Models\tes_tulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

//testulis untuk mahasiswa yang telah melakukan pendaftaran
class tes_tulisController extends Controller
{

    public function tespendaftar()
    {
        $userId = Auth::user()->id;
        $soal = tes_tulis::all('soal');
        $check = jawaban::where("id_user", $userId)->get();
        if ($check->count() == 1) {
//            return response()->view('errors.403', [], 403); --default
            return response()->view('errors.sudah-ujian');
        } else {
            return view('mahasiswa.tes_tulis.index', compact('soal', 'userId'));
        }
    }

    public function kirimtes(Request $request)
    {
        $rules = [
            'jawaban1' => ['required', 'string', 'min:20'],
            'jawaban2' => ['required', 'string', 'min:20'],
            'jawaban3' => ['required', 'string', 'min:20'],
            'jawaban4' => ['required', 'string', 'min:20'],
            'jawaban5' => ['required', 'string', 'min:20'],
            'jawaban6' => ['required', 'string', 'min:20'],
            'jawaban7' => ['required', 'string', 'min:20'],
            'jawaban8' => ['required', 'string', 'min:20'],
            'jawaban9' => ['required', 'string', 'min:20'],
            'jawaban10' => ['required', 'string', 'min:20'],
        ];
        $messages = [
            'jawaban1.required' =>'Wajib Diisi',
            'jawaban1.string' =>'Jangan Hanya Angka Saja',
            'jawaban1.min' =>'Minimal 20 Karakter',
            'jawaban2.required' =>'Wajib Diisi',
            'jawaban2.string' =>'Jangan Hanya Angka Saja',
            'jawaban2.min' =>'Minimal 20 Karakter',
            'jawaban3.required' =>'Wajib Diisi',
            'jawaban3.string' =>'Jangan Hanya Angka Saja',
            'jawaban3.min' =>'Minimal 20 Karakter',
            'jawaban4.required' =>'Wajib Diisi',
            'jawaban4.string' =>'Jangan Hanya Angka Saja',
            'jawaban4.min' =>'Minimal 20 Karakter',
            'jawaban5.required' =>'Wajib Diisi',
            'jawaban5.string' =>'Jangan Hanya Angka Saja',
            'jawaban5.min' =>'Minimal 20 Karakter',
            'jawaban6.required' =>'Wajib Diisi',
            'jawaban6.string' =>'Jangan Hanya Angka Saja',
            'jawaban6.min' =>'Minimal 20 Karakter',
            'jawaban7.required' =>'Wajib Diisi',
            'jawaban7.string' =>'Jangan Hanya Angka Saja',
            'jawaban7.min' =>'Minimal 20 Karakter',
            'jawaban8.required' =>'Wajib Diisi',
            'jawaban8.string' =>'Jangan Hanya Angka Saja',
            'jawaban8.min' =>'Minimal 20 Karakter',
            'jawaban9.required' =>'Wajib Diisi',
            'jawaban9.string' =>'Jangan Hanya Angka Saja',
            'jawaban9.min' =>'Minimal 20 Karakter',
            'jawaban10.required' =>'Wajib Diisi',
            'jawaban10.string' =>'Jangan Hanya Angka Saja',
            'jawaban10.min' =>'Minimal 20 Karakter',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $store = jawaban::create([
            'id_user' => $request->id_user,
            'jawaban1' => $request->jawaban1,
            'jawaban2' => $request->jawaban2,
            'jawaban3' => $request->jawaban3,
            'jawaban4' => $request->jawaban4,
            'jawaban5' => $request->jawaban5,
            'jawaban6' => $request->jawaban6,
            'jawaban7' => $request->jawaban7,
            'jawaban8' => $request->jawaban8,
            'jawaban9' => $request->jawaban9,
            'jawaban10' => $request->jawaban10
        ]);
        return redirect()->route('main')->with('success', 'Berhasil Menjawab Pertanyaan!');
//        session()->flash('message', 'Article ' . $store['article_title'] . ' berhasil di tambahkan');
    }

//tes tulis untuk admin
    public function adminindex()
    {
        if (tes_tulis::all()->count() == 10) {
            $cukup = 'Soal Sudah mencapai 10';
        } elseif (tes_tulis::all()->count() < 10) {
            $cukup = 'Soal Kurang Dari 10, Tambahkan Soal Lagi!';
        }
        $testulis = tes_tulis::all();
        return view('admin.tes_tulis.index', compact('testulis', 'cukup'));
    }

    public function store_testulis(Request $request)
    {
        if (tes_tulis::all()->count() == 10) {
            return redirect()->route('testulis')->with('error', 'Tidak bisa ditambahkan lagi, Jumlah Soal Sudah Mencapai 10!');
        } else {
            tes_tulis::create([
                'soal' => $request->soal,
            ]);
            return redirect()->route('testulis')->with('success', 'Soal Berhasil Ditambahkan!');

        }
//        session()->flash('message', 'Product ' . $store['product_name'] . ' berhasil di tambahkan');
    }

    public function hapus_testulis(Request $request)
    {
        tes_tulis::where('id', $request->id)->delete();
        return redirect()->route('testulis');
    }

    public function update_testulis(Request $request)
    {
//        $idid = $id;

//        $request->validate([
//            'soal' => 'required',
//        ]);
        tes_tulis::where('id', $request->id)->update(['soal' => $request->soal]);
        return redirect()->route('testulis')->with('success', 'Soal Berhasil Diubah!');
    }

}
