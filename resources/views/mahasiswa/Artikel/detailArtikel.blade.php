@extends('layouts.app')
@section('title', 'Artikel')
@section('content')
    <div class="container">
        <style>
            .overlay {
                /*background: rgba(0, 0, 0, 0.8);*/
                background-color: #2C73D2;
                opacity: 0.9;
                width: 100%;
                height: 100%;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                position: absolute;
            }

            #newpost {
                position: relative;
                color: white;
                font-weight: bold;
            }

            .judultengah {
                margin-top: 15%;
                text-align: center;
                font-size: 17px;
                padding-left: 10px;
                padding-right: 10px;
            }
        </style>
        <div class="row">

            <!-- Post Content Column -->
            <div class="col-lg-8">

                <!-- Title -->
                <h1 class="mt-2">{{$artikel->judul_artikel}}</h1>
                <!-- Date/Time -->
                <p class="text-muted"> Oleh <strong>Admin</strong>
                    pada {{Carbon\Carbon::parse($artikel->created_at)->isoFormat('D MMMM Y')}}</p>
                <hr>
                <img title="{{$artikel->judul_artikel}}" class="img-fluid rounded"
                     src="{{asset('storage/images/artikel/'.$artikel->artikel_thumbnail)}}"
                     alt="{{$artikel->judul_artikel}}">
                <!-- Post Content -->
                <hr>
                <p class="" style="font-size: 20px; font-weight: 350;">{!!$artikel->artikel_content!!}</p>
                <hr>

                {{--                komentar--}}
                @if (Auth::check())
                    <h4 class="my-4 pl-2" style="border-left: solid black 5px;">Masukkan Komentar</h4>
                    <br>
                    <form method="POST" action="{{route('storekomentar')}}" enctype="multipart/form-data"
                          id="formtambah" class="mb-4">
                        @csrf
                        <input hidden value="{{$users= App\Models\User::where('id', Auth::user()->id)->first()}}">
                        <input type="text" class="form-control"
                               value="{{$artikel->artikel_id}}" hidden name="artikel_id" id="artikel_id">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email address</label>
                            <input type="email" class="form-control" id="email"
                                   name="email" value="{{$users->email}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama"
                                   value="{{$users->nama_panjang}}"name="nama" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Masukkan Komentar</label>
                            <textarea class="form-control" id="komentar" rows="3" name="komentar" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                @else
                    <div class="alert alert-primary" role="alert">
                        Login untuk memberikan komentar :)
                    </div>
                @endif
                {{--                    <hr>--}}
                <section class="d-flex justify-content-end">
                    <strong> {{$countkomen}}&nbsp;Komentar</strong>
                </section>
                <hr>
                @forelse($komentars as $komentar)
                    <div class="card mb-3" style="max-width: 100%;">
                        {{--                        <div class="card-header">{{$komentar->nama}}</div>--}}
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h5 class="card-title">{{$komentar->nama}}</h5>
                                </div>
                                <div class="col-lg-4">
                                    <p style="float: right;">{{Carbon\Carbon::parse($komentar->created_at)->isoFormat('D MMMM Y')}}</p>
                                </div>
                            </div>
                            <p class="card-text">{{$komentar->komentar}}</p>
                        </div>
                    </div>
                @empty
                @endforelse
                {{--            end komentar--}}
            </div>

            <div class="col-lg-4">
                <div class="container" style="margin-top: 30%;">
                    <h2 class="my-4 pl-2" style="border-left: solid black 5px;">Artikel Terbaru</h2>
                    {{-- garis bawah                   <h2 class="mt-2" style="margin-bottom: 10%; border-bottom: solid black 4px">Artikel Terbaru</h2>--}}
                    @forelse($news as $new)
                        <div class="card text-right" style="width: 18rem;margin-bottom: 2%">
                            <div class="container" id="newpost">
                                <img class="img-fluid rounded"
                                     src="{{asset('storage/images/artikel/'.$new->artikel_thumbnail)}}"
                                     style="width: 100%;height: 9rem; object-fit: cover;">
                                <div class="overlay">
                                    <div class="judultengah"><a href="{{route('detailArtikel', $new->artikel_slug)}}"
                                                                style="color: white;text-decoration: none;">{{$new->judul_artikel}}</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
