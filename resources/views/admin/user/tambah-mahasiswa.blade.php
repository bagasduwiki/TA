@extends('layouts.admin.main')
@section('title', 'Tambah Mahasiswa')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md">
                    <h3 class="my-4 pl-2" style="border-left: solid black 5px">Tambah Mahasiswa</h3>
                    <div class="card card-body" id="show">
                        <form method="POST" action="{{route('storemahasiswa')}}" enctype="multipart/form-data"
                              id="formtambah">
                            @csrf
                            <div class="form-group">
                                <label for="nama_pendek">Nama Panggilan</label>
                                <input type="text" name="nama_pendek" id="nama_pendek" class="form-control"
                                       autocomplete="off" placeholder="Tony" >
                                @if ($errors->has('nama_pendek'))
                                    <span class="text-danger">{{ $errors->first('nama_pendek') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="nama_panjang">Nama Panjang</label>
                                <input type="text" name="nama_panjang" id="nama_panjang" class="form-control"
                                       autocomplete="off" placeholder="Tony Muhammad Saleh" >
                                @if ($errors->has('nama_panjang'))
                                    <span class="text-danger">{{ $errors->first('nama_panjang') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="nim">NIM</label>
                                <input type="text" name="nim" id="nim" class="form-control"
                                       autocomplete="off" placeholder="Masukkan NIM 1931.." >
                                @if ($errors->has('nim'))
                                    <span class="text-danger">{{ $errors->first('nim') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-label">Kelas</label>
                                <select class="custom-select" id="kelas" name="kelas">
                                    <option id="pilihkelas">--- pilih kelas ---</option>
                                    <option value="A">Kelas A</option>
                                    <option value="B">Kelas B</option>
                                    <option value="C">Kelas C</option>
                                    <option value="D">Kelas D</option>
                                    <option value="E">Kelas E</option>
                                </select>
                                @if ($errors->has('kelas'))
                                    <span class="text-danger">{{ $errors->first('kelas') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea type="text" name="alamat" id="alamat" class="form-control"
                                          autocomplete="off" placeholder="Masukkan Alamat.." ></textarea>
                                @if ($errors->has('alamat'))
                                    <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No.Handphone</label>
                                <input type="text" name="no_hp" id="no_hp" class="form-control"
                                       autocomplete="off" placeholder="0838XXXX" >
                                @if ($errors->has('no_hp'))
                                    <span class="text-danger">{{ $errors->first('no_hp') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                       autocomplete="off" placeholder="Angela@gmail.com" >
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">Password Default</label>
                                <input type="password" name="password" id="password" class="form-control"
                                       autocomplete="off" readonly required>
                            </div>
                            <br>
                            <button class="btn btn-sm btn-primary" type="submit"
                                    style="margin-bottom: 2%; width: 7%; float:right;">Kirim &nbsp;<i
                                    class="fa fa-check" aria-hidden="true"></i>
                            </button>
                            <input type="button" class="btn btn-sm btn-danger" value="Kembali" onclick="history.back()">
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        $('#pilihkelas').attr("disabled", true);
        $("#nim").keyup(function () {
            var password = $("#nim").val();
            $("#password").val(password);
        });
    </script>
@endsection
