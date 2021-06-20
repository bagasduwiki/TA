@extends('layouts.admin.main')
@section('title', 'Tambah Agenda')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md">
                    <h3 class="my-4 pl-2" style="border-left: solid black 5px">Tambah Agenda</h3>
                    <div class="card card-body" id="show">
                        <form method="POST" action="{{route('store_agenda')}}" enctype="multipart/form-data" id="formEdit">
                            @csrf
                            <div class="form-group">
                                <label for="nama_agenda">Nama Agenda</label>
                                <input type="text" name="nama_agenda" id="nama_agenda" class="form-control"
                                       autocomplete="off" placeholder="Masukkan Nama Agenda.." required>
                            </div>
                            <div class="form-group">
                                <label for="foto_agenda">Foto Agenda</label>
                                <input type="file" name="foto_agenda" id="foto_agenda" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="isi_agenda">Isi Agenda</label>
                                <textarea type="text" name="isi_agenda" id="isi_agenda" class="form-control"
                                          autocomplete="off" placeholder="Masukkan Isi Agenda.." required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="created_at">Masukkan Tanggal Agenda</label>
                            <input type="date" id="created_at" name="created_at" class="form-control">
                            </div>
                            <br>
                            <button class="btn btn-sm btn-primary" type="submit"
                                    style="margin-bottom: 2%; width: 7%; float:right;">Kirim &nbsp;<i
                                    class="fa fa-check" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#isi_agenda').summernote();
        });
    </script>
@endsection
