<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

//
//    /**
//     * Where to redirect users after login.
//     *
//     * @var string
//     */
//    protected $redirectTo = RouteServiceProvider::HOME;
//
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('nim', 'password');

        if (Auth::attempt($credentials)) {
            if (auth()->user()->as == 'admin') {
                return redirect()->route('dashboard');
            } elseif (auth()->user()->as == 'pengurus') {
                return redirect()->route('index_agenda');
            }
            return redirect('/');
        }
        return redirect('login')->withInput()->withErrors('NIM atau password salah!');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
