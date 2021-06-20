@extends('layouts.app')
@section('title', 'Artikel')
@section('content')
    <div class="container">
        {{--        <nav aria-label="breadcrumb" class="mt-4">--}}
        {{--            <ol class="breadcrumb">--}}
        {{--                <li class="breadcrumb-item"><a href="/"><i class="fa fa-home" aria-hidden="true"> </i> Home</a></li>--}}
        {{--                <li class="breadcrumb-item active" aria-current="page">Article</li>--}}
        {{--            </ol>--}}
        {{--        </nav>--}}
        <h1 class="my-4 pl-2" style="border-left: solid black 5px">Artikel</h1>
        {{--        <div class="row">--}}
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($artikel as $i)
                <div class="col-md-4 mt-3">
                    <div class="card" style="width: 100%; height: 24rem;">
                        {{--                        <div style="height: 150px; width: 100%">--}}
                        <a href="{{route('detailArtikel', $i->artikel_slug)}}">
                            <img src="{{ asset('storage/images/artikel/'.$i->artikel_thumbnail) }}" class="card-img-top"
                                 alt="{{$i->judul_artikel}}" style="height: 16.5rem; width: 100%">
                        </a>
                        <div class="card-body">
                            <a href="{{route('detailArtikel', $i->artikel_slug)}}"
                               style=" color: black;"><h5
                                    class="card-title">{{\Illuminate\Support\Str::words($i->judul_artikel,8)}}</h5></a>
                            <p class="card-text"><small class="text-muted">Last
                                    updated {{$i->updated_at->diffForHumans()}}</small></p>
                        </div>
                    </div>
                </div>
            @endforeach
            {{--            @foreach($artikel as $i)--}}
            {{--                <div class="col-md-4 mt-3">--}}
            {{--                    <div class="container">--}}
            {{--                        <div class="card border-secondary" style="width: 100%; min-height: 400px;">--}}
            {{--                            <div style="height: 150px; width: 100%">--}}
            {{--                                <img class="card-img-top"--}}
            {{--                                     src="{{ asset('storage/images/artikel/'.$i->artikel_thumbnail) }}"--}}
            {{--                                     alt="Card image cap" style="max-width: 100%; max-height: 100%; object-fit: cover;">--}}
            {{--                            </div>--}}
            {{--                            <div class="card-body" style="height: 100px;">--}}
            {{--                                <div >--}}
            {{--                                    <a href="{{route('detailArtikel', $i->artikel_slug)}}" style="text-decoration: none; color: black;"><h5 class="card-title" >{{$i->judul_artikel}}</h5></a>--}}
            {{--                                    <p class="card-text">{!! \Illuminate\Support\Str::words($i->artikel_content, 20, '...') !!}</p>--}}
            {{--                                    <p class="card-text"><small class="text-muted">Last updated {{$i->updated_at->diffForHumans()}}</small></p>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="card-footer" style="background-color: #2C73D2;">--}}
            {{--                                <a class="d-flex justify-content-end"--}}
            {{--                                   href="{{route('detailArtikel', $i->artikel_slug)}}"  style="color: white"><strong>Read More</strong></a>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            @endforeach--}}
        </div>
        <hr>
        {!! $artikel->links('pagination::bootstrap-4')!!}
    </div>

@endsection
