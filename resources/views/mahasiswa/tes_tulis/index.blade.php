@extends('layouts.app')
@section('title', 'Tes Tulis')
@section('content')
    <div class="container">
        <form method="POST" action="{{route('kirimtes')}}" enctype="multipart/form-data" id="formEdit">
            @csrf
            <input hidden type="text" name="id_user" id="id_user" class="form-control"
                   autocomplete="off" value="{{$userId}}">
            <div class="col-md-12 col-sm-6">
                <div class="form-group">
                    <label for="motivasi">{{ $soal[0]->{'soal'} }}</label>
                    <textarea type="text" name="jawaban1"
                              class="form-control" autocomplete="off" ></textarea>
                    @if ($errors->has('jawaban1'))
                        <span class="text-danger">{{ $errors->first('jawaban1') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="motivasi">{{ $soal[1]->{'soal'} }}</label>
                    <textarea type="text" name="jawaban2"
                              class="form-control" autocomplete="off" > </textarea>
                    @if ($errors->has('jawaban2'))
                        <span class="text-danger">{{ $errors->first('jawaban2') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="motivasi">{{ $soal[2]->{'soal'} }}</label>
                    <textarea type="text" name="jawaban3"
                              class="form-control" autocomplete="off" > </textarea>
                    @if ($errors->has('jawaban3'))
                        <span class="text-danger">{{ $errors->first('jawaban3') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="motivasi">{{ $soal[3]->{'soal'} }}</label>
                    <textarea type="text" name="jawaban4"
                              class="form-control" autocomplete="off" > </textarea>
                    @if ($errors->has('jawaban4'))
                        <span class="text-danger">{{ $errors->first('jawaban4') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="motivasi">{{ $soal[4]->{'soal'} }}</label>
                    <textarea type="text" name="jawaban5"
                              class="form-control" autocomplete="off" ></textarea>
                    @if ($errors->has('jawaban5'))
                        <span class="text-danger">{{ $errors->first('jawaban5') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="motivasi">{{ $soal[5]->{'soal'} }}</label>
                    <textarea type="text" name="jawaban6"
                              class="form-control" autocomplete="off" > </textarea>
                    @if ($errors->has('jawaban6'))
                        <span class="text-danger">{{ $errors->first('jawaban6') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="motivasi">{{ $soal[6]->{'soal'} }}</label>
                    <textarea type="text" name="jawaban7"
                              class="form-control" autocomplete="off" > </textarea>
                    @if ($errors->has('jawaban7'))
                        <span class="text-danger">{{ $errors->first('jawaban7') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="motivasi">{{ $soal[7]->{'soal'} }}</label>
                    <textarea type="text" name="jawaban8"
                              class="form-control" autocomplete="off" > </textarea>
                    @if ($errors->has('jawaban8'))
                        <span class="text-danger">{{ $errors->first('jawaban8') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="motivasi">{{ $soal[8]->{'soal'} }}</label>
                    <textarea type="text" name="jawaban9"
                              class="form-control" autocomplete="off" ></textarea>
                    @if ($errors->has('jawaban9'))
                        <span class="text-danger">{{ $errors->first('jawaban9') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="motivasi">{{ $soal[9]->{'soal'} }}</label>
                    <textarea type="text" name="jawaban10"
                              class="form-control" autocomplete="off" >  </textarea>
                    @if ($errors->has('jawaban10'))
                        <span class="text-danger">{{ $errors->first('jawaban10') }}</span>
                    @endif
                </div>
                <hr>
                <button style="margin-bottom: 2%; width: 7%;" class="btn btn-sm btn-primary" type="submit"
                        name="submitbutton">Kirim &nbsp;<i class="fa fa-check" aria-hidden="true"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
