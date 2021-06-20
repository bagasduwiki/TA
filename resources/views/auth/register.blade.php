@extends('layouts.app')
@section('title', 'Register')
@section('content')
    <style>
        body {
            background: #2C73D2;
            /*background: linear-gradient(to right, #0062E6, #33AEFF);*/
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{--                    <div class="card-header">{{ __('Register') }}</div>--}}

                    <div class="card-body">
                        <h4 class="text-center mb-4 mt-2">Register</h4>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="nama_pendek"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Nama Panggilan') }}</label>

                                <div class="col-md-6">
                                    <input id="nama_pendek" type="text" class="form-control" name="nama_pendek"
                                           autofocus placeholder="Nama Pendek" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_panjang"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Nama Lengkap') }}</label>

                                <div class="col-md-6">
                                    <input id="nama_panjang" type="text" class="form-control" name="nama_panjang"
                                           autofocus placeholder="Nama Panjang" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nim" class="col-md-4 col-form-label text-md-right">{{ __('NIM') }}</label>
                                <div class="col-md-6">
                                    <input id="nim" type="text"
                                           class="form-control @error('nim') is-invalid @enderror" name="nim"
                                           value="{{ old('nim') }}" required autocomplete="nim" placeholder="NIM">
                                    @error('nim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>NIM Sudah Terdaftar/Maksimal 11 Karakter</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nim" class="col-md-4 col-form-label text-md-right">{{ __('Kelas') }}</label>
                                <div class="col-md-6">
                                    <select class="custom-select" id="kelas" name="kelas">
                                        <option value="A">
                                            Kelas A
                                        </option>
                                        <option value="B">
                                            Kelas B
                                        </option>
                                        <option value="C">
                                            Kelas C
                                        </option>
                                        <option value="D">
                                            Kelas D
                                        </option>
                                        <option value="E">
                                            Kelas E
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

                                <div class="col-md-6">
                                    <input id="alamat" type="text" class="form-control" name="alamat" autofocus required
                                           placeholder="Alamat">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_hp"
                                       class="col-md-4 col-form-label text-md-right">{{ __('No HP') }}</label>

                                <div class="col-md-6">
                                    <input id="no_hp" type="text" class="form-control" name="no_hp" autofocus required
                                           placeholder="No Telp/HP">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Email Sudah Terdaftar/Tidak Valid</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password" placeholder="Masukkan Password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Password Minimal 8 Karakter/Kosong</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password"
                                           placeholder="Confirm Password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
