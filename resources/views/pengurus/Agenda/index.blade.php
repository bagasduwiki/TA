@extends('layouts.app')
@section('title', 'Agenda')
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
        <h1 class="my-4 pl-2" style="border-left: solid black 5px">Agenda</h1>
        <div class="row">
            @foreach($agendas as $agenda)
                <div class="col-sm-4">
                    <div id="bingkai" style="margin-left: 10px;margin-right:10px;margin-top: 5px;">
                        <a href="{{route('showAgenda', $agenda->id)}}">
                            <img src="{{ asset('storage/images/agenda/'.$agenda->foto_agenda) }}" alt="" class="image" style="height: 12rem;"></a>
{{--                        @if(\Carbon\Carbon::now()->subDays(16) >= $agenda->created_at )--}}
                        @if(\Carbon\Carbon::now() >= $agenda->created_at )
                            <a href="{{route('showAgenda', $agenda->id)}}">
                                <div class="overlay">
                                    <p style="text-align: right; color: white;font-weight: bold;">{{Carbon\Carbon::parse($agenda->created_at)->isoFormat('D MMMM Y')}}</p>
                                    <i class="fa fa-check-circle fa-xs" aria-hidden="true" id="text"></i>
                                </div>
                            </a>
                        @endif
                    </div>
                    <p style="margin-top: 10px; margin-left: 10px;margin-right:10px;border-left: solid black 3px;padding-left: 5px;font-weight: bold; ">
                        <a href="{{route('showAgenda', $agenda->id)}}"
                           style="color: black;">{{$agenda->nama_agenda}}</a></p>
                </div>

            @endforeach
        </div>
        <hr>
        {!! $agendas->links('pagination::bootstrap-4')!!}
    </div>

@endsection
