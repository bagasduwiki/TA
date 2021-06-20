@extends('layouts.admin.main')
@section('title', 'Admin - Artikel')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800" style="border-left: solid black 5px">&nbsp;Artikel</h1>
                <a href="{{route('tambah_artikel')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-tags fa-sm text-white-50"></i>&nbsp; Tambah Artikel</a>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <script>
                Swal.fire({
                    title: '{{ $message }}',
                    // text: 'Do you want to continue',
                    icon: 'success',
                    confirmButtonText: 'Keluar'
                })
            </script>
        @endif
        <div class="table-responsive p-2 " id="wrapperartikel">
            <table id="tabelartikel" class="table table-bordered  " cellspacing="0" width="100%"
                   style="width: 100%; margin-left: auto; margin-right: auto;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Artikel</th>
                    <th>Artikel Slug</th>
                    {{--                    <th style="width: 20%;">Artikel Thumbnail</th>--}}
                    <th style="width: 10%;">Created</th>
                    <th style="width: 10%;">Updated</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($artikels as $artikel)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{!! \Illuminate\Support\Str::words( $artikel->judul_artikel, 3, '...') !!} </td>
                        <td>{!! \Illuminate\Support\Str::words( $artikel->artikel_slug, 3, '...') !!} </td>
                        {{--                        <td><img src="{{ asset('storage/images/artikel/'.$artikel->artikel_thumbnail) }}" alt=""--}}
                        {{--                                 style="max-width: 100%;"></td>--}}
                        <td>{{ Carbon\Carbon::parse($artikel->created_at)->isoFormat('D MMMM Y') }}</td>
                        <td>{{ Carbon\Carbon::parse($artikel->updated_at)->isoFormat('D MMMM Y') }}</td>
                        {{--                        <td></td>--}}
                        <td style="text-align: center; width: 20%;">
                            {{--                            <form action="{{ route('hapus_artikel',$artikel->artikel_id) }}">--}}
                            <a class="btn btn-primary btn-sm" href="{{ route('detail', $artikel->artikel_id) }}">
                                <i class="fas fa-pen"></i>&nbsp; Update </a>
                            @csrf

                            <button class="btn btn-danger btn-sm" id="btnHapusArtikel{{$artikel->artikel_id}}">Hapus&nbsp;&nbsp;<i class="fas fa-trash"></i>
                            </button>
                            <script type="text/javascript">
                                $("#btnHapusArtikel{{$artikel->artikel_id}}").click(function () {
                                    Swal.fire({
                                        title: 'Anda Yakin Menghapus Ini?',
                                        text: "Artikel Yang Dihapus Tidak Bisa Dikembalikan!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Lanjut'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $.ajax({
                                                type: 'get',
                                                url: "{{route('hapus_artikel')}}",
                                                data: {
                                                    id: "{{$artikel->artikel_id}}"
                                                },
                                                success: function (dataResult) {
                                                    // $("#cartWrapper").html(dataResult);
                                                    Swal.fire({
                                                        // title: '<i class="fa fa-check"></i>',
                                                        title: 'Artikel berhasil dihapus !',
                                                        // text: 'Artikel berhasil dihapus !',
                                                        icon: 'success',
                                                        showConfirmButton: false,
                                                        focusConfirm: true,
                                                        // timer: 2500,
                                                        // success:location.reload(),
                                                        success: setInterval(function () {
                                                            location.reload() // this will run after every 5 seconds
                                                        }, 950),
                                                        {{--success: window.location.href= "{{route('artikel')}}",--}}
                                                    });
                                                    //     .then((result) => {
                                                    //     /* Read more about isConfirmed, isDenied below */
                                                    //     if (result.isConfirmed) {
                                                    //         Swal.fire(  location.reload());
                                                    //     }
                                                    // });
                                                },
                                                error: function () {
                                                    Swal.fire({
                                                        title: 'Oops!',
                                                        text: 'Artikel gagal dihapus!',
                                                        icon: 'error',
                                                        confirmButtonText: 'OK'
                                                    });
                                                }

                                            });
                                        }
                                    });
                                });
                            </script>

                            {{--                            </form>--}}
                        </td>


                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>

        </div>
    </div>
    <script>
        $(document).ready(function () {
            var table = $('#tabelartikel').DataTable({
                "columnDefs": [{
                    // "orderable": false,
                    // "searchable": false,
                    lengthChange: false,
                    "targets": 2
                }],
                buttons: [{
                    extend: 'excelHtml5',
                    text: 'Excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },

                    {
                        extend: 'print',
                        text: 'PDF',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'copyHtml5',
                        text: 'Copy Text',
                    },
                    'colvis',
                ],
                "aLengthMenu": [
                    [5, 10, 25, -1],
                    [5, 10, 25, "All"]
                ],
                "iDisplayLength": 5
            });
            table.buttons().container()
                .appendTo('#tabelartikel_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
