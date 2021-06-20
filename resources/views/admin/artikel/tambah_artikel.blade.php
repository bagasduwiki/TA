@extends('layouts.admin.main')
@section('title', 'Tambah Artikel')
@section('content')
    <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md">
                        <h3 class="my-4 pl-2" style="border-left: solid black 5px">Tambah Artikel</h3>
                        <div class="card card-body" id="show">
                            <form method="POST" action="{{route('store_artikel')}}" enctype="multipart/form-data" id="formEdit">
                                @csrf
                                <div class="form-group">
                                    <label for="judul_artikel">Judul Artikel</label>
                                    <input type="text" name="judul_artikel" id="judul_artikel" class="form-control"
                                           autocomplete="off" placeholder="Masukkan Judul Artikel" required>
                                </div>
                                <div class="form-group">
                                    <label for="artikel_slug">Slug Artikel</label>
                                    <input  type="text" name="artikel_slug" id="artikel_slug" class="form-control"
                                          readonly autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label for="artikel_thumbnail">Thumbnail Artikel</label>
                                    <input type="file" name="artikel_thumbnail" id="artikel_thumbnail" class="form-control" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label for="artikel_content">Content Artikel</label>
                                    <textarea type="text" name="artikel_content" id="artikel_content" class="form-control"
                                              autocomplete="off" placeholder="Masukkan Konten" required></textarea>
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
            $('#artikel_content').summernote();
        });
        $("#judul_artikel").keyup(function() {
            var judul_artikel = $("#judul_artikel").val();
            judul_artikel = judul_artikel.toLowerCase();
            judul_artikel = judul_artikel.replace(/[^a-zA-Z0-9]+/g, '-');
            $("#artikel_slug").val(judul_artikel);
        });
    </script>
@endsection
