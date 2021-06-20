@extends('layouts.admin.main')
@section('title', 'Edit Cakahim')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md">
                        <h3 class="my-4 pl-2" style="border-left: solid black 5px">Komentar Aspirasi</h3>
                        <div class="card card-body" id="show">
                          <form method="POST" action="/admin/aspirasi/update/{{$idaspirasi}}" enctype="multipart/form-data" id="formEdit">
                              @csrf
                              @method('patch')
                              <div class="form-group">
                                  <label for="nama_mahasiswa">Nama Mahasiswa</label>
                                  <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control"
                                         autocomplete="off" value="{{$data->User->nama_panjang}}" disabled>
                              </div>
                              <div class="form-group">
                                  <label for="nama_mahasiswa">Kelas</label>
                                  <input type="text" name="kelas" id="kelas" class="form-control"
                                         autocomplete="off" value="3{{$data->User->kelas}}" disabled>
                              </div>
                              <div class="form-group">
                                  <label for="deskripsi">deskripsi</label>
                                  <input readonly type="text" name="deskripsi" id="deskripsi"
                                         class="form-control" autocomplete="off" value="{{$data->deskripsi}}" disabled>
                              </div>
                              <div class="form-group">
                                  <label for="article_thumbnail">Foto</label>
                                  <p><img src="{{asset('images/aspirasi/'.$data->foto_aspirasi)}}" alt="" style="max-width: 500px;"></p>
                                  <!-- <input type="file" name="foto_aspirasi" id="foto_aspirasi"
                                         class="form-control" autocomplete="off"> -->
                              </div>
                              <div class="form-group">
                                  <label for="komentar">Komentar</label>
                                  <textarea type="text" name="komentar" id="komentar"
                                            class="form-control" autocomplete="off"
                                            required>{{$data->komentar}}</textarea>
                              </div>
                              <hr>
                              <button class="btn btn-sm btn-primary" type="submit"> Update</button>
                          </form>
                          <style>
                              textarea.form-control:read-only {
                                  background-color: #fff;
                              }
                          </style>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- /.container-fluid -->
    </div>

    <script>

        var select_fields = document.getElementsByTagName('select')
        var input_fields = document.getElementsByTagName('input')

        for (var field in select_fields) {
            select_fields[field].className += ' form-control'
        }
        for (var field in input_fields) {
            input_fields[field].className += ' form-control'
        }
    </script>

@endsection
