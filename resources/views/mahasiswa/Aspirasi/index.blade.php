@extends('layouts.app')
@section('title', 'Aspirasi')
@section('content')
    <style>
        #bingkai {
            position: relative;
            width: 100%;
        }

        .image {
            display: block;
            width: 100%;
            height: auto;
            /*background-color: #008CBA;*/
            /*margin-right: 5%;*/
            /*margin-left: 5%;*/
        }

        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0.9;
            background-color: #2C73D2;
        }

        #text {
            color: white;
            font-size: 50px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>
    <div class="container">
        <h1 class="my-4 pl-2" style="border-left: solid black 5px">Aspirasi</h1>
        <div class="row">
            @foreach($aspirasis as $aspirasi)
                <div class="col-sm-4">
                  <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header bg-transparent border-dark">{{$aspirasi->User->nama_panjang}}</div>
                    <div class="card-body text-dark">
                      <!-- <h5 class="card-title">Success card title</h5> -->
                      <p class="card-text">{{$aspirasi->deskripsi}}</p>
                    </div>
                    <div class="card-footer bg-transparent border-dark">Respon : "{{$aspirasi->komentar}}"</div>

                  </div>
                </div>

            @endforeach
        </div>
        <hr>
        {!! $aspirasis->links('pagination::bootstrap-4')!!}
    </div>

@endsection
