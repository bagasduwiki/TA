@extends('layouts.app')
@section('title', 'Agenda')
@section('content')
    <div class="container" >
        <style>
            .overlay{
                background-color: #2C73D2;
                width: 100%;
                height: 100%;
                top: 50%;
                left: 50%;
                opacity: 0.9;
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
                font-size: 17px;;
            }
        </style>
        <div class="row">

            <!-- Post Content Column -->
            <div class="col-lg-8">

                <!-- Title -->
                <h1 class="mt-2">{{$agenda->nama_agenda}}</h1>
                <!-- Date/Time -->
                <p class="text-muted"> Oleh <strong>Admin</strong> pada {{Carbon\Carbon::parse($agenda->created_at)->isoFormat('D MMMM Y')}}</p>
                <hr>
                <img title="{{$agenda->nama_agenda}}" class="img-fluid rounded" src="{{asset('storage/images/agenda/'.$agenda->foto_agenda)}}"
                     alt="{{$agenda->nama_agenda}}">
                <!-- Post Content -->
                <hr>
                <p class="" style="font-size: 20px; font-weight: 350;">{!! $agenda->isi_agenda !!}</p>
                <br>
                <hr>

            </div>
            <div class="col-lg-4">
                <div class="container" style="margin-top: 30%;">
                    <h2 class="my-4 pl-2" style="border-left: solid black 5px;">Agenda Terbaru</h2>
                    {{-- garis bawah                   <h2 class="mt-2" style="margin-bottom: 10%; border-bottom: solid black 4px">Artikel Terbaru</h2>--}}
                    @forelse($news as $new)
                        <div class="card text-right" style="width: 18rem;margin-bottom: 2%">
                            <div class="container" id="newpost">
                                <img class="img-fluid rounded" src="{{asset('storage/images/agenda/'.$new->foto_agenda)}}" style="width: 100%;height: 10rem; object-fit: cover;">
                                <div class="overlay">
                                    <div class="judultengah"><a href="{{route('showAgenda', $new->id)}}" style="color: white; padding-left: 5px;padding-right: 5px;">{{$new->nama_agenda}}</a></div>
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
