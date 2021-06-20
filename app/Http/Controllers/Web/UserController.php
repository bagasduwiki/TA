<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Imports\MahasiswaImport;
use App\Imports\PengurusImport;
use App\Models\jawaban;
use App\Models\pendaftaran;
use App\Models\tes_tulis;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\Utils;

class UserController extends Controller
{
    public function pendaftar()
    {
        $date = Carbon::now()->format('Y');
        $pendaftars = pendaftaran::all();
        $pendlulus = pendaftaran::where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$date)->where('status', 'LULUS');
        $pendgagal = pendaftaran::where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$date)->where('status', 'GAGAL');

        return view('admin.user.pendaftar', compact('pendaftars', 'pendlulus', 'pendgagal'));
    }

    public function hapuspendaftar(Request $request)
    {
        pendaftaran::destroy($request->id);
        return redirect()->route('pendaftar');
    }

    public function verifikasipendaftar($id_user)
    {
        $id_user = $id_user;
        $users = User::where('id', $id_user)->first();
        $jawaban = jawaban::where('id_user', $id_user)->first();
        $soal = tes_tulis::all('soal');
        return view('admin.user.pendaftar-verifikasi', compact('jawaban', 'soal', 'id_user', 'users'));
    }

    public function updatestatus(Request $request, $id_user)
    {
//        pendaftaran::where("id_user", $id_user)->update(['status' => "LULUS"]);
//        return redirect()->route('pendaftar')->with('success', 'Verifikasi pendaftar berhasil');
        switch ($request->submitbutton) {
            case 'LULUS':
                pendaftaran::where("id_user", $id_user)->update(['status' => "LULUS"]);
                User::where("id", $id_user)->update(['as' => "pengurus"]);
//                return redirect()->route('editmultiimages', $product->id)->with('success', 'Product, ' . $product->title . ' updated, now you can edit images.');
                return redirect()->route('pendaftar')->with('success', 'Verifikasi LULUS pendaftar berhasil');
                break;
            case 'GAGAL':
                pendaftaran::where("id_user", $id_user)->update(['status' => "GAGAL"]);
//                Session::flash('success', 'Product, ' . $product->title . ' updated successfully.');
//                return redirect()->route('products.index', $product->id);
                return redirect()->route('pendaftar')->with('error', 'Verifikasi GAGAL pendaftar berhasil');
                break;
            case 'BACK':
                return redirect()->route('pendaftar');
                break;
        }
    }

    public function mahasiswa()
    {
        $mahasiswas = User::where('as', 'mahasiswa')->get();
        return view('admin.user.mahasiswa', compact('mahasiswas'));
    }
    public function mahasiswaexcel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_mahasiswa',$nama_file);

        // import data
        Excel::import(new MahasiswaImport, public_path('/file_mahasiswa/'.$nama_file));

        // alihkan halaman kembali
        return redirect()->route('mahasiswa')->with('success', 'Menambahkan Mahasiswa');
    }

    public function tambahmahasiswa()
    {
        return view('admin.user.tambah-mahasiswa');
    }

    public function storemahasiswa(Request $request)
    {
        $rules = [
            'nama_pendek' => ['required','min:3'],
            'nama_panjang' => ['required','min:3'],
            'nim' => ['required', 'max:12','unique:users'],
            'kelas' => ['required'],
            'alamat' => ['required', 'min:10'],
            'no_hp' => ['required', 'max:13','unique:users'],
            'email' => ['required','unique:users'],
        ];
        $messages = [
            'nama_pendek.required' =>'Wajib Diisi',
            'nama_panjang.required' =>'Wajib Diisi',
            'nim.required' =>'Wajib Diisi',
            'kelas.required' =>'Wajib Diisi',
            'alamat.required' =>'Wajib Diisi',
            'no_hp.required' =>'Wajib Diisi',
            'email.required' =>'Wajib Diisi',
            'nim.unique' =>'Nim Sudah Terdaftar',
            'email.unique' =>'Email Sudah Terdaftar',
            'no_hp.unique' =>'No Hp Sudah Terdaftar',
            'nim.max' =>'Maksiamal 12 Karakter',
            'no_hp.max' =>'Maksiamal 13 Karakter',
            'alamat.min' =>'Minimal 10 Karakter',
            'nama_pendek.min' =>'Minimal 3 Karakter',
            'nama_panjang.min' =>'Minimal 3 Karakter',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        User::create([
            'nama_pendek' => $request->nama_pendek,
            'nama_panjang' => $request->nama_panjang,
            'nim' => $request->nim,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('mahasiswa')->with('success', 'Menambahkan Mahasiswa');
//        session()->flash('message', 'Article ' . $store['article_title'] . ' berhasil di tambahkan');
    }


    public function idxupmahasiswa($id)
    {
        $data = User::find($id);
        $id_mahasiswa = $id;
        return view('admin.user.mahasiswa-upate', compact('data', 'id_mahasiswa'));
    }

    public function updatemahasiswa(Request $request, $id)
    {
//        $request->validate([
//            'nama_pendek' => 'required',
//            'nama_panjang' => 'required',
//            'nim' => 'required',
//            'kelas' => 'required',
//            'alamat' => 'required',
//            'no_hp' => 'required',
//            'email' => 'required',
//            'password' => 'required',
//        ]);

        User::where("id", $id)->update([
            'nama_pendek' => $request->nama_pendek,
            'nama_panjang' => $request->nama_panjang,
            'nim' => $request->nim,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('mahasiswa')->with('success', 'Mengubah data Mahasiswa');
    }

    public function hapusmahasiswa(Request $request)
    {
        $mahasiswa = User::findOrFail($request->id);
//        User::where('id', $request->id)->delete();
        $mahasiswa->delete();
//        User::destroy($id);
        return redirect()->route('mahasiswa');
    }

//pengurus aktif
    public function pengurusaktif()
    {
        $userId = Auth::user()->id;
        $pengurus = User::whereIn('as', ['pengurus', 'admin'])->where('id','!=',$userId)->get();
        return view('admin.user.pengurusaktif', compact('pengurus'));
    }
    public function changestatus(Request $request){
        if ($request->as == 'admin')
        {
            $pengurus = User::where('nim', $request->nim)->update([
                'as' => 'pengurus'
            ]);
        } else if($request->as == 'pengurus')
        {
            $pengurus = User::where('nim', $request->nim)->update([
                'as' => 'admin'
            ]);
        }
    }

    public function import_excel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_pengurus',$nama_file);

        // import data
        Excel::import(new PengurusImport, public_path('/file_pengurus/'.$nama_file));

        // alihkan halaman kembali
        return redirect()->route('pengurusaktif')->with('success', 'Menambahkan Pengurus');
    }

    public function tambahpengurusaktif()
    {
        return view('admin.user.tambah-pengurusaktif');
    }

    public function storepengurusaktif(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        User::create([
            'as' => 'pengurus',
            'nama_pendek' => $request->nama_pendek,
            'nama_panjang' => $request->nama_panjang,
            'nim' => $request->nim,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('pengurusaktif')->with('success', 'Menambahkan Pengurus');
//        session()->flash('message', 'Article ' . $store['article_title'] . ' berhasil di tambahkan');
    }


    public function idxuppengurusaktif($id)
    {
        $data = User::find($id);
        $id_pengurus = $id;
        return view('admin.user.pengurusaktif-update', compact('data', 'id_pengurus'));
    }

    public function updatepengurusaktif(Request $request, $id)
    {
        User::where("id", $id)->update([
            'nama_pendek' => $request->nama_pendek,
            'nama_panjang' => $request->nama_panjang,
            'nim' => $request->nim,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('pengurusaktif')->with('success', 'Mengubah Mahasiswa');
    }

    public function hapuspengurusaktif(Request $request)
    {
        $pengurus = User::findOrFail($request->id);
        $pengurus->delete();
        return redirect()->route('pengurusaktif');
    }
}
