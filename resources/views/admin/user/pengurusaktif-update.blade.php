@extends('layouts.admin.main')
@section('title', 'Update Pengurus')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md">
                        <h3 class="my-4 pl-2" style="border-left: solid black 5px">Edit Pengurus</h3>
                        <div class="card card-body" id="show">
                            <form method="POST" action="{{route('updatepengurusaktif',$id_pengurus)}}"
                                  enctype="multipart/form-data" id="formEdit">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="nama_pendek">Nama Panggilan</label>
                                    <input type="text" name="nama_pendek" id="nama_pendek" class="form-control"
                                           autocomplete="off" value="{{$data->nama_pendek}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama_panjang">Nama Panjang</label>
                                    <input type="text" name="nama_panjang" id="nama_panjang" class="form-control"
                                           autocomplete="off" value="{{$data->nama_panjang}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="nim">NIM</label>
                                    <input type="text" name="nim" id="nim" class="form-control"
                                           autocomplete="off" value="{{$data->nim}}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kelas</label>
                                    <select class="custom-select" id="kelas" name="kelas">
                                        <option id="pilihkelas">--- pilih kelas ---</option>
                                        <option value="A" {{ "A"== $data->kelas ? 'selected="selected"' : '' }}>
                                            Kelas A
                                        </option>
                                        <option value="B" {{ "B"== $data->kelas ? 'selected="selected"' : '' }}>
                                            Kelas B
                                        </option>
                                        <option value="C" {{ "C"== $data->kelas ? 'selected="selected"' : '' }}>
                                            Kelas C
                                        </option>
                                        <option value="D" {{ "D"== $data->kelas ? 'selected="selected"' : '' }}>
                                            Kelas D
                                        </option>
                                        <option value="E" {{ "E"== $data->kelas ? 'selected="selected"' : '' }}>
                                            Kelas E
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea type="text" name="alamat" id="alamat" class="form-control"
                                              autocomplete="off" required>{{$data->alamat}} </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">No.Handphone</label>
                                    <input type="text" name="no_hp" id="no_hp" class="form-control"
                                           autocomplete="off" value="{{$data->no_hp}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                           autocomplete="off" value="{{$data->email}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password Default</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                           autocomplete="off"
                                           placeholder="Masukkan Password Baru, Jika Tidak Kosongkan!">
                                </div>
                                <hr>
                                <button class="btn btn-sm btn-primary" type="submit"
                                        style="margin-bottom: 2%; width: 8%; float:right;"> Update&nbsp;<i
                                        class="fa fa-check" aria-hidden="true"></i>
                                </button>
                                <input type="button" class="btn btn-sm btn-danger" value="Kembali"
                                       onclick="history.back()">
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- /.container-fluid -->
    </div>
@endsection
