@extends('layouts.app')
@section('title', 'Pendaftaran')
@section('content')
    <div class="container">
        <style>
            .box{
                display: none;
            }
        </style>
        <script>
            $(document).ready(function(){
                $('input[type="radio"]').click(function(){
                    var inputValue = $(this).attr("value");
                    var targetBox = $("." + inputValue);
                    $(".box").not(targetBox).hide();
                    $(targetBox).show();
                });
            });
        </script>
        <form method="POST" action="{{route('store_daftar')}}" enctype="multipart/form-data" id="formEdit">
            @csrf
            <input type="hidden" class="form-control-file" id="userid" name="userid" value="{{$userId}}">
            <div class="form-group">
                <label for="motivasi" style="border-left: solid black 4px;padding-left: 5px;">Motivasi</label>
                <textarea class="form-control" id="motivasi" name="motivasi" rows="3"></textarea>
                @if ($errors->has('motivasi'))
                    <span class="text-danger">{{ $errors->first('motivasi') }}</span>
                @endif
            </div>
            <section>
                <label for="pengorg" style="border-left: solid black 4px;padding-left: 5px;">Pernah Mengikuti
                    Organisasai Selama SMA/SMK?</label>
                <div style="padding-bottom:10px;padding-top:10px;">
                    <label><input type="radio" name="colorRadio" value="red">Pernah</label>
                    <label><input type="radio" name="colorRadio" value="green">Belum Pernah</label>
                </div>
            </section>
            <div class="red box" style="margin-bottom: 20px;">
                <textarea class="form-control" id="pengorg" name="pengorg" rows="3"></textarea>
                @if ($errors->has('pengorg'))
                    <span class="text-danger">{{ $errors->first('pengorg') }}</span>
                @endif

            </div>
            <div class="green box">
                <input hidden name="pengorg" value="Belum Pernah">
            </div>
            <div class="form-group">
                <label for="fototer" style="border-left: solid black 4px;padding-left: 5px;">Masukkan Foto
                    Terbaru</label>
                <input type="file" class="form-control" id="fototer" name="fototer">
                @if ($errors->has('fototer'))
                    <span class="text-danger">{{ $errors->first('fototer') }}</span>
                @endif
            </div>
            <button class="btn btn-sm btn-primary" type="submit" style="margin-bottom: 2%; width: 8%; float:right;">
                Kirim
                &nbsp;<i class="fa fa-check" aria-hidden="true"></i></button>
        </form>
    </div>

@endsection
