@extends('layouts.admin.main')
@section('title', 'Admin - Pendaftar')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800" style="border-left: solid black 5px">&nbsp;Pendaftar</h1>
            </div>
        </div>
        <div class="row ">
            <div class=" col-xl-3 col-md-6 mb-4">
            </div>
            <div class=" col-xl-3 col-md-6 mb-4">
            </div>
            {{--            <section style="float:right;">--}}
            <div class=" col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
{{--                                    {{$mytime = Carbon\Carbon::now()}}--}}
                                    Pendaftar Lulus - {{$ldate = date('Y')}}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pendlulus->count()}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Pendaftar Gagal - {{$ldate = date('Y')}}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pendgagal->count()}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-times fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--            </section>--}}
        </div>
        @if ($message = Session::get('success'))
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ $message }}',
                    icon: 'success',
                    confirmButtonText: 'Keluar'
                })
            </script>
        @elseif($message = Session::get('error'))
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ $message }}',
                    icon: 'success',
                    confirmButtonText: 'Keluar'
                })
            </script>
        @endif
        <div class="table-responsive p-2">
            <table id="tabelpendaftar" class="table table-bordered  " cellspacing="0" width="100%"
                   style="width: 100%; margin-left: auto; margin-right: auto;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pendek</th>
                    <th>NIM</th>
                    <th>Kelas</th>
                    <th>Terdaftar Pada</th>
                    <th>Diverifikasi Pada</th>
                    <th>Tes Tulis</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($pendaftars as $pendaftar)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        {{--                        <td>{!! \Illuminate\Support\Str::words( $artikel->judul_artikel, 3, '...') !!} </td>--}}
                        <td style="width: 15%;">{{$pendaftar->User->nama_pendek}} </td>
                        <td>{{$pendaftar->User->nim}} </td>
                        <td style="width: 5%">{{$pendaftar->User->kelas}} </td>
                        <td style="width: 15%;">{{Carbon\Carbon::parse($pendaftar->created_at)->isoFormat('D MMMM Y, h:m') }}</td>
                        <td style="width: 15%;">{{Carbon\Carbon::parse($pendaftar->updated_at)->isoFormat('D MMMM Y, h:m') }}</td>
                        <td style="width: 10%;text-align: center;">
                            @if(\App\Models\jawaban::where('id_user',$pendaftar->id_user)->count() == 1)
                                @if(\App\Models\pendaftaran::where('id_user',$pendaftar->id_user)->where('status','LULUS')->first())
                                    <span class="badge badge-success">LULUS</span>
                                @elseif(\App\Models\pendaftaran::where('id_user',$pendaftar->id_user)->where('status','GAGAL')->first())
                                    <span class="badge badge-danger">GAGAL</span>
                                @else
                                    <a class="btn btn-success btn-sm"
                                       href="{{ route('verifikasipendaftar', $pendaftar->id_user) }}"><i class="fas fa-check"></i>&nbsp;Verifikasi</a>
                                @endif
                            @endif
                        </td>
                        <td style="width: 17%; text-align: center;">
                            <a style="color: white;" class="btn btn-primary btn-sm" data-toggle="modal"
                               data-nama_panjang="{{$pendaftar->User->nama_panjang}}"
                               data-motivasi="{{$pendaftar->motivasi}}"
                               data-pengalaman_org="{{$pendaftar->pengalaman_org}}"
                               data-foto_pendaftar="{{$pendaftar->foto_pendaftar}}"
                               data-target="#modaldetail"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;Detail </a>
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm"
                                    id="btnHapusPendaftar{{$pendaftar->id}}"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Hapus
                            </button>
                            <script type="text/javascript">
                                $("#btnHapusPendaftar{{$pendaftar->id}}").click(function () {
                                    Swal.fire({
                                        title: 'Anda Yakin',
                                        text: "Untuk Mengahapus Pendaftar dari Daftar?",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Lanjut'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $.ajax({
                                                type: 'get',
                                                url: "{{route('hapuspendaftar')}}",
                                                data: {
                                                    id: "{{$pendaftar->id}}"
                                                },
                                                success: function (dataResult) {
                                                    // $("#cartWrapper").html(dataResult);
                                                    Swal.fire({
                                                        title: 'Berhasil!',
                                                        title: 'Pendaftar dihapus !',
                                                        icon: 'success',
                                                        showConfirmButton: false,
                                                        focusConfirm: true,
                                                        success: setInterval(function () {
                                                            location.reload() // this will run after every 5 seconds
                                                        }, 950),
                                                    });
                                                },
                                                error: function () {
                                                    Swal.fire({
                                                        title: 'Oops!',
                                                        text: 'Pendaftar gagal dihapus!',
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

    {{--    modal detail--}}
    <div class="modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pendaftar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="show">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama_panjang">Nama Panjang</label>
                                <input type="text" name="nama_panjang" id="nama_panjang" class="form-control"
                                       autocomplete="off" readonly style="background-color:white;">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="motivasi">Motivasi</label>
                                <textarea type="text" name="motivasi" id="motivasi"
                                          class="form-control" autocomplete="off" readonly style="background-color:white;"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="pengalaman_org">Pengalaman Organisasi</label>
                                <textarea type="text" name="pengalaman_org" id="pengalaman_org" class="form-control"
                                          autocomplete="off" readonly style="background-color:white;"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="foto_pendaftar">FOTO</label>
                                <img id="foto_pendaftar" alt="" style="max-width: 100%; ">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    final sesi, dibawah ini script aja--}}
    <script type="text/javascript">
        $('#modaldetail').on('show.bs.modal', function (event) {
            console.log('modalopened');
            var button = $(event.relatedTarget);
            var nama_panjang = button.data('nama_panjang');
            var motivasi = button.data('motivasi');
            var pengalaman_org = button.data('pengalaman_org');
            var foto_pendaftar = button.data('foto_pendaftar');

            var modal = $(this);
            modal.find('.modal-body #nama_panjang').val(nama_panjang);
            modal.find('.modal-body #motivasi').val(motivasi);
            modal.find('.modal-body #pengalaman_org').val(pengalaman_org);
            $("#foto_pendaftar").attr("src", "{{asset('storage/images/pendaftaran/')}}" + '/' + foto_pendaftar)


        })
    </script>
    <script>
        $(document).ready(function () {
            var table = $('#tabelpendaftar').DataTable({
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
                .appendTo('#tabelpendaftar_wrapper .col-md-6:eq(0)');
        });
    </script>


@endsection
