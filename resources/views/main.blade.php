@extends('layouts.app')
@section('title', 'HIMATIKA')
@section('content')
    <style>
        #pengumuman {
            position: absolute;
            top: 7%;
            left: 0%;
            /*background-color: red;*/
            /*color: white;*/
            width: 100%;
            text-align: center;
            padding-top: 1%;
        }
    </style>
    @auth
        @if(Auth::user()->as =="mahasiswa")
            @if(empty($cekvalid))
            @else
                    @if($cekvalid->status == 'GAGAL')
                        @if(\Carbon\Carbon::now()->subDays(7) < $cekvalid->created_at)
                            <section id="pengumuman">
                            <div class="container">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Maaf Anda Gagal Dalam Ujian Tes Tulis Dan Wawancara, Jangan Putus Semangat!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </section>
                    @endif
                @endif
            @endif
        @endif
    @endauth
    <style>
        header.masthead {
            padding-top: 5rem;
            /*padding-bottom: calc(10rem - 4.5rem);*/
            background: #2C73D2;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: scroll;
            background-size: cover;

        }

        hr.divider {
            max-width: 3.25rem;
            border-width: 0.2rem;
            border-color: #fff;
        }

        /*.btn-primary {*/
        /*    color: #fff;*/
        /*    background-color: #f4623a;*/
        /*    border-color: #f4623a;*/
        /*}*/
        .btn {
            border-radius: 14px;
        }

        .image {
            display: block;
            width: 100%;
            height: auto;
        }

        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            background-color: #273036;
        }

        #bingkai {
            position: relative;
            width: 100%;
        }

        #bingkai:hover .overlay {
            opacity: 0.3;
        }

        /*#devidertentangkami {*/
        /*    max-width: 3.25rem;*/
        /*    border-width: 0.2rem;*/
        /*    border-color: #2C73D2;*/
        /*}*/

        #agenart {
            background-color: #fff;
        }

        #aspirasi {
            background-color: #2C73D2;
        }

        #devideragenda {
            border-color: #2C73D2;
            /*color: white;*/
        }

        #deviderartikel {
            border-color: #2C73D2;
            /*color: black;*/
            padding-bottom: 3%;
        }

        #devideraspirasi {
            border-color: white;
        }
    </style>
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                title: 'Selamat!',
                text: '{{ $message }}',
                icon: 'success',
                confirmButtonText: 'Keluar'
            })
        </script>
    @endif
    <header class="masthead" style="margin-top: -100px;">
        <div class="container h-50">
            <div class="row h-30 align-items-center justify-content-center text-center" style="padding-top: 10%">
                <div class="col-lg-10 align-self-end">
                    <h1 class="text-uppercase text-white font-weight-bold">Selamat Datang di halaman HIMATIKA</h1>
                    <hr class="divider my-4"/>
                </div>
                <div class="col-lg-6 align-self-baseline">
                    <p class="text-white-75 font-weight-light text-white-50" style="margin-bottom: 10%;">HIMATIKA
                        merupakan wadah dalam pengembangan minat dan bakat mahasiswa program studi Manajemen
                        Informatika.</p>
                    {{--                    <a class="btn btn-light btn-xl js-scroll-trigger" id="daftar" href="#about">Find Out More</a>--}}
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#fff" fill-opacity="1"
                  d="M0,64L60,74.7C120,85,240,107,360,138.7C480,171,600,213,720,197.3C840,181,960,107,1080,69.3C1200,32,1320,32,1380,32L1440,32L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
        </svg>
    </header>
    <section id="agenart">
        <div class="container">
            @auth
                @if(Auth::user()->as =="pengurus")
                    <div class="row text-center">
                        <div class="col">
                            <h2 class="text-uppercase font-weight-bold text-black">Agenda</h2>
                            <hr class="divider my-4" id="devideragenda"/>
                        </div>
                    </div>
                    {{--                    <h3 class="my-4 pl-2" style="border-left: solid black 5px">Agenda</h3>--}}
                    <div class="container" style="margin-bottom: 4rem">
                        <div class="row">
                            @foreach($agendas as $agenda)
                                <div class="col-md-4">
                                    <div id="bingkai">
                                        <a href="{{route('showAgenda', $agenda->id)}}">
                                            <img src="{{ asset('storage/images/agenda/'.$agenda->foto_agenda) }}"
                                                 alt=""
                                                 class="image"></a>
                                        <a href="{{route('showAgenda', $agenda->id)}}">
                                            <div class="overlay">
                                            </div>
                                        </a>
                                    </div>
                                    <p style="margin-top: 10px;padding-left: 5px;font-weight: bold; ">
                                        <a class="text-black"
                                           href="{{route('showAgenda', $agenda->id)}}">{{$agenda->nama_agenda}}</a>
                                    </p>
                                    <p style="margin-top: -5%;padding-left: 5px;">
                                        <small
                                            class="text-black-50">Admin&nbsp;x&nbsp; {{Carbon\Carbon::parse($agenda->created_at)->isoFormat('D MMMM Y')}}</small>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endauth
            <div class="row text-center">
                <div class="col">
                    <h2 class="text-uppercase font-weight-bold text-black">Artikel</h2>
                    <hr class="divider my-4" id="deviderartikel"/>
                </div>
            </div>
            {{--                    <h3 class="my-4 pl-2" style="border-left: solid black 5px">Artikel</h3>--}}
            @forelse($artikel as $i)
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div style="width: 100%; height: 200px;">
                            <a href="{{route('detailArtikel', $i->artikel_slug)}}">
                                <img src="{{asset('storage/images/artikel/'.$i->artikel_thumbnail)}}" alt=""
                                     style="object-fit: cover;min-height: 100%; max-width: 100%; max-height: 100%; min-width: 100%;">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8 mb-3">
                        <a href="{{route('detailArtikel', $i->artikel_slug)}}"
                           style="color: black; text-decoration: none; font-family:sans-serif; font-size: 2em;">
                            <h4 class="" style="text-decoration: none;">
                                <strong class="text-black">{{$i->judul_artikel}}</strong>
                            </h4>
                        </a>
                        <p class="text-black-50">Oleh <strong>Admin</strong><span
                                class="text-muted"></span>
                            Pada {{Carbon\Carbon::parse($i->created_at)->isoFormat('D MMMM Y')}}</p>
                    </div>
                </div>
            @empty
            @endforelse
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{route('allArtikel')}}" class="btn btn-primary" type="button">Lihat Semua </a>
            </div>
        </div>

    </section>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#2C73D2" fill-opacity="1"
              d="M0,224L60,229.3C120,235,240,245,360,256C480,267,600,277,720,272C840,267,960,245,1080,234.7C1200,224,1320,224,1380,224L1440,224L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
    </svg>

    {{--        Aspirasi--}}
    <!-- Portfolio Section -->
    <section id="aspirasi">
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <h2 class="text-uppercase font-weight-bold text-white">aspirasi</h2>
                    <hr class="divider my-4" id="devideraspirasi"/>
                </div>
            </div>
            @forelse($aspirasis as $aspirasi)
                <div class="card mb-3" style="max-width: 100%;">
                    <div class="card-body text-dark">
                        <div class="row">
                            <div class="col-lg-8">
                                <h5 class="card-title">{{$aspirasi->User->nama_pendek}}</h5>
                            </div>
                            <div class="col-lg-4">
                                <p style="float: right;"> {{Carbon\Carbon::parse($aspirasi->created_at)->isoFormat('D MMMM Y')}}</p>
                            </div>
                        </div>
                        <p class="card-text">{{$aspirasi->deskripsi}}</p>
                    </div>
                </div>
            @empty
            @endforelse
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{route('list_aspirasi')}}" class="btn btn-light" type="button">Lihat Semua </a>
            </div>
            <br>
        </div>
    </section>

@endsection
