@extends('layouts.admin.main')
@section('title', 'Admin - Pemilihan')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800" style="border-left: solid black 5px">&nbsp;Pemilihan</h1>
            </div>
        </div>
        @if (session()->has('message'))
            <script>
                Swal.fire(
                    'Berhasil',
                    '{!! session('
            message ') !!}',
                    'success'
                )
            </script>
        @endif
        <div class="row" style="margin-left: 1%;margin-right: 1%;">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Pemilihan
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totpemilihan}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            @foreach($hasil as $i)
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        {{$i->Cakahim->user->nama_pendek}}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$i->hasil}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-poll-h fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach


        </div>
        <div class="table-responsive p-2">
            <table id="tabelcakahim" class="table table-bordered text-center" cellspacing="0" width="100%"
                   style="width: 100%; margin-left: auto; margin-right: auto;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>Kelas</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($daftarkahims as $daftarkahim)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $daftarkahim->User->nama_pendek }} </td>
                        <td>{{ $daftarkahim->User->nim }}</td>
                        <td>{{ $daftarkahim->User->kelas }}</td>
                        {{--                        <td></td>--}}
                        <td style="width: 15%; text-align: center;">
                            <a class="btn btn-success btn-sm" href="{{ route('detailpemilihan', $daftarkahim->id) }}">
                                Detail </a>
                            <script type="text/javascript">
                                $("#btnHapusDaftarCakahim{{$daftarkahim->id}}").click(function () {
                                    Swal.fire({
                                        title: 'Anda Yakin Menghapus Ini?',
                                        text: "Daftar Yang Dihapus Tidak Bisa Dikembalikan!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Lanjut'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $.ajax({
                                                type: 'get',
                                                url: "{{route('hapus_daftarcakahim')}}",
                                                data: {
                                                    id: "{{$daftarkahim->id}}"
                                                },
                                                success: function () {
                                                    Swal.fire({
                                                        title: 'Pemilihan berhasil dihapus !',
                                                        icon: 'success',
                                                        showConfirmButton: false,
                                                        focusConfirm: true,
                                                        success: setInterval(function () {
                                                            location.reload()
                                                        }, 950),
                                                    });
                                                },
                                                error: function () {
                                                    Swal.fire({
                                                        title: 'Oops!',
                                                        text: 'Pemilihan gagal dihapus!',
                                                        icon: 'error',
                                                        confirmButtonText: 'OK'
                                                    });
                                                }

                                            });
                                        }
                                    });
                                });
                            </script>
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800" style="border-left: solid black 5px">&nbsp;Hasil Pemilihan</h1>
            </div>
        </div>
        @if (session()->has('message'))
            <script>
                Swal.fire(
                    'Berhasil',
                    '{!! session('
            message ') !!}',
                    'success'
                )
            </script>
        @endif

        <div class="table-responsive p-2">
            <table id="tabelpemilihan" class="table table-bordered text-center" cellspacing="0" width="100%"
                   style="width: 100%; margin-left: auto; margin-right: auto;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Pilihan</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($pemilihans as $pemilihan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        @foreach ($namacakahim as $x)
                        <td>{{ $pemilihan->User->nama_pendek }} </td>
                        <td>{{ $x->nama_pendek }}</td>
                        {{--                        <td></td>--}}
                        <td style="width: 15%; text-align: center;">
                            <form action="{{ route('hapus_pemilihan',$pemilihan->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Dihapus Bos?');"> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            var table = $('#tabelcakahim').DataTable({
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
                .appendTo('#tabelcakahim_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        $(document).ready(function () {
            var table = $('#tabelpemilihan').DataTable({
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
                .appendTo('#tabelpemilihan_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
