<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    public function showProfile(Request $request)
    {
        $datauser = User::where('id', Auth::id());
        return view('Profile.index', compact('datauser'));
    }

    public function indexSandi()
    {
//        $datauser = User::where('id', Auth::id());
        return view('Profile.ubah_password');
    }
    public function ubahSandi(Request $request)
    {
        $request->validate([
//            'new_password' => 'min:8',
            'current_password' => [new MatchOldPassword],
            'new_password' => ['min:8'],
            'new_confirm_password' => ['same:new_password'],
//           'no_hp'=> 'integer|max:13',
        ]);
        $input = $request->all();
        User::where('id', Auth::id())->update([
            'password' => Hash::make($input['new_password']),
        ]);

        return back()->with(['success' => 'Ubah Sandi Berhasil']);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
           'no_hp'=> 'min:11|max:13',
        ]);
        $input = $request->all();
        User::where('id', Auth::id())->update([
            'nama_pendek' => $input['nama_pendek'],
            'nama_panjang' => $input['nama_panjang'],
            'email' => $input['email'],
            'no_hp' => $input['no_hp'],
            'alamat' => $input['alamat'],
//            'password' => Hash::make($input['new_password']),

        ]);

        return back()->with(['success' => 'Edit Profil Berhasil']);
    }
}
