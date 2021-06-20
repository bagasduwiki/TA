@extends('layouts.admin.main')
@section('title', 'Detail Cakahim')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md">
                        <h3 class="my-4 pl-2" style="border-left: solid black 5px">Detail Calon Ketua HIMATIKA</h3>
                        <div class="card card-body" id="show">
                          <form method="POST" action="" enctype="multipart/form-data">
                              @csrf
                              <div class="col-md-12 col-sm-6">
                                <div class="form-group">
                                    <label for="nama_cakahim">Nama Cakahim</label>
                                    <input type="text" name="nama_agenda" id="nama_agenda" class="form-control"
                                           autocomplete="off" value="{{$data->User->nama_pendek}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nama_mahasiswa">Kelas</label>
                                    <input type="text" name="kelas" id="kelas" class="form-control"
                                           autocomplete="off" value="3{{$data->User->kelas}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="ipk">IPK</label>
                                    <input type="text" name="ipk" id="ipk" class="form-control"
                                           autocomplete="off" value="{{$data->ipk}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <p><img src="{{asset('images/image/'.$data->foto)}}" alt="" style="max-width: 500px;"></p>
                                    <!-- <input type="file" name="foto_aspirasi" id="foto_aspirasi"
                                           class="form-control" autocomplete="off"> -->
                                </div>
                                <div class="form-group">
                                    <label for="cv">CV</label>
                                    <p><img src="{{asset('images/image/'.$data->cv)}}" alt="" style="max-width: 500px;"></p>
                                    <!-- <input type="file" name="foto_aspirasi" id="foto_aspirasi"
                                           class="form-control" autocomplete="off"> -->
                                </div>
                                <div class="form-group">
                                    <label for="visi">Visi</label>
                                    <textarea type="text" name="visi" id="visi"
                                              class="form-control" autocomplete="off" disabled
                                              required>{{$data->visi}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="misi">Misi</label>
                                    <textarea type="text" name="misi" id="misi"
                                              class="form-control" autocomplete="off" disabled
                                              required>{{$data->misi}}</textarea>
                                </div>
                                  <!-- <hr style="margin-top:3%;">
                                  <button style="margin-bottom: 2%; width: 7%;" class="btn btn-sm btn-success" type="submit"
                                          name="submitbutton" value="LULUS"> LULUS
                                  </button>
                                  <button style="margin-bottom: 2%; width: 7%;" class="btn btn-sm btn-danger" type="submit"
                                          name="submitbutton" value="GAGAL"> GAGAL
                                  </button>
                                  <button style="margin-bottom: 2%; width: 7%; float:right;" class="btn btn-sm btn-primary" type="submit"
                                          name="submitbutton" value="BACK"> Kembali
                                  </button> -->
                              </div>
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
