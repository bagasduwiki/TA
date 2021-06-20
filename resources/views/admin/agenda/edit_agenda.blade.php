@extends('layouts.admin.main')
@section('title', 'Edit Agenda')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md">
                        <h3 class="my-4 pl-2" style="border-left: solid black 5px">Edit Agenda</h3>
                        <div class="card card-body" id="show">
                            <form method="POST" action="{{route('update_agenda',$idagenda)}}" enctype="multipart/form-data" id="formEdit">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="nama_agenda">Nama Agenda</label>
                                    <input type="text" name="nama_agenda" id="nama_agenda" class="form-control"
                                           autocomplete="off" value="{{$data->nama_agenda}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="foto_agenda">Thumbnail Artikel</label>
                                    <p><img src="{{asset('storage/images/agenda/'.$data->foto_agenda)}}" alt="" style="max-width: 500px;"></p>
                                    <input type="file" name="foto_agenda" id="foto_agenda"
                                           class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="isi_agenda">Isi Agenda</label>
                                    <textarea type="text" name="isi_agenda" id="isi_agenda"
                                              class="form-control" autocomplete="off"
                                              required>{{$data->isi_agenda}}</textarea>
                                </div>
                                <hr>
                                <button class="btn btn-sm btn-primary" type="submit"> Update</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- /.container-fluid -->
    </div>

    <script>
        $(document).ready(function() {
            $('#isi_agenda').summernote();
        });

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
