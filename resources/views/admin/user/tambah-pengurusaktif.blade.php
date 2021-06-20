@extends('layouts.admin.main')
@section('title', 'Tambah Pengurus')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md">
                    <h3 class="my-4 pl-2" style="border-left: solid black 5px">Tambah Pengurus</h3>
                    <div class="card card-body" id="show">
                        <form method="POST" action="{{route('storepengurusaktif')}}" enctype="multipart/form-data"
                              id="formEdit">
                            @csrf
                            {{--                            <input type="text" value="pengurus" name="sebagai" id="sebagai">--}}
                            <div class="form-group">
                                <label for="nama_pendek">Nama Panggilan</label>
                                <input type="text" name="nama_pendek" id="nama_pendek" class="form-control"
                                       autocomplete="off" placeholder="Tony" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_panjang">Nama Panjang</label>
                                <input type="text" name="nama_panjang" id="nama_panjang" class="form-control"
                                       autocomplete="off" placeholder="Tony Muhammad Saleh" required>
                            </div>
                            <div class="form-group">
                                <label for="nim">NIM</label>
                                <input type="text" name="nim" id="nim" class="form-control"
                                       autocomplete="off" placeholder="Masukkan NIM 1931.." required>
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
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea type="text" name="alamat" id="alamat" class="form-control"
                                          autocomplete="off" placeholder="Masukkan Alamat.." required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No.Handphone</label>
                                <input type="text" name="no_hp" id="no_hp" class="form-control"
                                       autocomplete="off" placeholder="0838XXXX" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                       autocomplete="off" placeholder="Angela@gmail.com" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password Default</label>
                                <input type="password" name="password" id="password" class="form-control"
                                       autocomplete="off" readonly required>
                            </div>
                            <br>
                            <button class="btn btn-sm btn-primary" type="submit"
                                    style="margin-bottom: 2%; width: 8%; float:right;"> Kirim&nbsp;<i
                                    class="fa fa-check" aria-hidden="true"></i></button>
                            <input type="button" class="btn btn-sm btn-danger" value="Kembali"
                                   onclick="history.back()">
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
