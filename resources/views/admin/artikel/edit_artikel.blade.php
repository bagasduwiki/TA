@extends('layouts.admin.main')
@section('title', 'Edit Artikel')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md">
                        <h3 class="my-4 pl-2" style="border-left: solid black 5px">Edit Artikel</h3>
                        <div class="card card-body" id="show">
                            <form method="POST" action="/admin/artikel/update/{{$id}}" enctype="multipart/form-data" id="formEdit">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="article_title">Judul Artikel</label>
                                    <input type="text" name="judul_artikel" id="judul_artikel" class="form-control"
                                           autocomplete="off" value="{{$data->judul_artikel}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="article_slug">Slug Artikel</label>
                                    <input readonly type="text" name="artikel_slug" id="artikel_slug"
                                           class="form-control" autocomplete="off" required value="{{$data->artikel_slug}}">
                                </div>
                                <div class="form-group">
                                    <label for="article_thumbnail">Thumbnail Artikel</label>
                                    <p><img src="{{asset('storage/images/artikel/'.$data->artikel_thumbnail)}}" alt="" style="max-width: 500px;"></p>
                                    <input type="file" name="artikel_thumbnail" id="artikel_thumbnail"
                                           class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="article_content">Content Artikel</label>
                                    <textarea type="text" name="artikel_content" id="artikel_content"
                                              class="form-control" autocomplete="off"
                                              required>{{$data->artikel_content}}</textarea>
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
            $('#artikel_content').summernote();
        });
        $("#judul_artikel").keyup(function() {
            var judul_artikel = $("#judul_artikel").val();
            judul_artikel = judul_artikel.toLowerCase();
            judul_artikel = judul_artikel.replace(/[^a-zA-Z0-9]+/g, '-');
            $("#artikel_slug").val(judul_artikel);
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
