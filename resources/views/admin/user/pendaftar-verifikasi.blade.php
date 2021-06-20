@extends('layouts.admin.main')
@section('title', 'Verifikasi Pendaftar')
@section('content')

    <form method="POST" action="{{ route('updatestatus', $id_user) }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="col-md-12 col-sm-6">
            <div class="form-group">
                <label for="motivasi">{{ $soal[0]->{'soal'} }}</label>
                <textarea readonly type="text" name="motivasi"
                          class="form-control" autocomplete="off">{{$jawaban->jawaban1}} </textarea>
            </div>
            <div class="form-group">
                <label for="motivasi">{{ $soal[1]->{'soal'} }}</label>
                <textarea readonly type="text" name="motivasi"
                          class="form-control" autocomplete="off">{{$jawaban->jawaban2}} </textarea>
            </div>
            <div class="form-group">
                <label for="motivasi">{{ $soal[2]->{'soal'} }}</label>
                <textarea readonly type="text" name="motivasi"
                          class="form-control" autocomplete="off">{{$jawaban->jawaban3}} </textarea>
            </div>
            <div class="form-group">
                <label for="motivasi">{{ $soal[3]->{'soal'} }}</label>
                <textarea readonly type="text" name="motivasi"
                          class="form-control" autocomplete="off">{{$jawaban->jawaban4}} </textarea>
            </div>
            <div class="form-group">
                <label for="motivasi">{{ $soal[4]->{'soal'} }}</label>
                <textarea readonly type="text" name="motivasi"
                          class="form-control" autocomplete="off">{{$jawaban->jawaban5}} </textarea>
            </div>
            <div class="form-group">
                <label for="motivasi">{{ $soal[5]->{'soal'} }}</label>
                <textarea readonly type="text" name="motivasi"
                          class="form-control" autocomplete="off">{{$jawaban->jawaban6}} </textarea>
            </div>
            <div class="form-group">
                <label for="motivasi">{{ $soal[6]->{'soal'} }}</label>
                <textarea readonly type="text" name="motivasi"
                          class="form-control" autocomplete="off">{{$jawaban->jawaban7}} </textarea>
            </div>
            <div class="form-group">
                <label for="motivasi">{{ $soal[7]->{'soal'} }}</label>
                <textarea readonly type="text" name="motivasi"
                          class="form-control" autocomplete="off">{{$jawaban->jawaban8}} </textarea>
            </div>
            <div class="form-group">
                <label for="motivasi">{{ $soal[8]->{'soal'} }}</label>
                <textarea readonly type="text" name="motivasi"
                          class="form-control" autocomplete="off">{{$jawaban->jawaban9}} </textarea>
            </div>
            <div class="form-group">
                <label for="motivasi">{{ $soal[9]->{'soal'} }}</label>
                <textarea readonly type="text" name="motivasi"
                          class="form-control" autocomplete="off">{{$jawaban->jawaban10}} </textarea>
            </div>
            <hr style="margin-top:3%;">
            <button onclick="return confirm('Pendaftar dengan nama {{ $users->nama_pendek}} dinyatakan LULUS?')" style="margin-bottom: 2%; width: 7%;" class="btn btn-sm btn-success" type="submit"
                    name="submitbutton" value="LULUS"><i class="fas fa-check"></i>&nbsp; LULUS
            </button>
            <button onclick="return confirm('Pendaftar dengan nama {{ $users->nama_pendek}} dinyatakan Tidak Lulus?')" style="margin-bottom: 2%; width: 7%;" class="btn btn-sm btn-danger" type="submit"
                    name="submitbutton" value="GAGAL">GAGAL &nbsp;<i class="fas fa-times"></i>
            </button>

            <button style="margin-bottom: 2%; width: 7%; float:right;" class="btn btn-sm btn-primary" type="submit"
                    name="submitbutton" value="BACK"> Kembali
            </button>
        </div>
    </form>
    <style>
        textarea.form-control:read-only {
            background-color: #fff;
        }
    </style>
@endsection
