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
                                     style="max-width: 100%;max-height: 100%; object-fit: cover;">
                                <div class="overlay">
                                    <div class="judultengah"><a href="{{route('mobiledetail', $new->artikel_slug)}}"
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
</body>
{{--<footer class="footer" style="background: #2C73D2; height: 60px;">--}}
{{--    <div class="container">--}}
{{--        <p class="m-0 text-center" style="color: #fff;">Copyright &copy; HIMATIKA 2020</p>--}}
{{--    </div>--}}
{{--    <!-- /.container -->--}}
{{--</footer>--}}
</html>

