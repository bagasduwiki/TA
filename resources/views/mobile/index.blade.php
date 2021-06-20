<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}
    <title>Detail Artikel</title>
    <link rel="icon" href="{{asset('images/LOGO himatika 2019.png')}}"
          type="image/x-icon">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset ('vendor/fontawesome-free/css/all.min.css')}}">
    <script src="{{ asset ('vendor/jquery/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<style>
    /*a:link { COLOR: white; TEXT-DECORATION: none; font-weight: normal }*/
    /*a:visited { COLOR: black; TEXT-DECORATION: none; font-weight: normal }*/
    /*a:active { margin-bottom: 1%; border-bottom: solid white 1px; TEXT-DECORATION: none }*/
    /*a:hover { COLOR: black; TEXT-DECORATION: none; font-weight: none }*/
</style>
    <div class="container">
{{--        <nav aria-label="breadcrumb" class="mt-4">--}}
{{--            <ol class="breadcrumb">--}}
{{--                <li class="breadcrumb-item"><a href="/"><i class="fa fa-home" aria-hidden="true"> </i> Home</a></li>--}}
{{--                <li class="breadcrumb-item active" aria-current="page">Article</li>--}}
{{--            </ol>--}}
{{--        </nav>--}}
        <h1 class="my-4 pl-2" style="border-left: solid black 5px">Artikel</h1>
        <div class="row">
            @foreach($artikel as $i)
                <div class="col-md-4 mt-3">
                    <div class="container">
                        <div class="card border-secondary" style="width: 100%; min-height: 400px;">
                            <div style="height: 150px; width: 100%">
                                <img class="card-img-top"
                                     src="{{ asset('storage/images/artikel/'.$i->artikel_thumbnail) }}"
                                     alt="Card image cap" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                            </div>
                            <div class="card-body" style="height: 100px;">
                                <div >
                                    <a href="{{route('mobiledetail', $i->artikel_slug)}}" style="text-decoration: none; color: black;"><h5 class="card-title" >{{$i->judul_artikel}}</h5></a>
                                    <p class="card-text">{!! \Illuminate\Support\Str::words($i->artikel_content, 20, '...') !!}</p>
                                    <p class="card-text"><small class="text-muted">Last updated {{$i->updated_at->diffForHumans()}}</small></p>
                                </div>
                            </div>
                            <div class="card-footer" style="background-color: #2C73D2;">
                                <a class="d-flex justify-content-end"
                                   href="{{route('mobiledetail', $i->artikel_slug)}}"  style="color: white"><strong>Read More</strong></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr>
        {!! $artikel->links('pagination::bootstrap-4')!!}
    </div>
</body>
{{--<footer class="footer" style="background: #2C73D2; height: 60px;">--}}
{{--    <div class="container">--}}
{{--        <p class="m-0 text-center" style="color: #fff;">Copyright &copy; HIMATIKA 2020</p>--}}
{{--    </div>--}}
{{--    <!-- /.container -->--}}
{{--</footer>--}}
</html>

