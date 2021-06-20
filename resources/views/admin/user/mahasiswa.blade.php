@extends('layouts.admin.main')
@section('title', 'Admin - Mahasiswa')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800" style="border-left: solid black 5px">&nbsp;Mahasiswa</h1>
                <a href="{{route('tambahmahasiswa')}}"
                   class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-user-plus fa-sm text-white-50"></i>&nbsp; Tambah Mahasiswa</a>
                <button type="button" class=" btn btn-sm btn-primary shadow-sm"
                        data-toggle="modal" data-target="#importExcel" style="width: 70px; position: absolute; right: 200px;">
                    <i class="fas fa-upload fa-sm text-white-50"></i>&nbsp;
                </button>
            </div>
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
        @endif
        <div class="table-responsive p-2 ">
            <table id="tabelmahasiswa" class="table table-bordered" cellspacing="0" width="100%"
                   style="width: 100%; margin-left: auto; margin-right: auto;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
{{--                    <th>Nama Panjang</th>--}}
                    <th>NIM</th>
                    <th>Kelas</th>
{{--                    <th>Alamat</th>--}}
{{--                    <th>No.Hp</th>--}}
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($mahasiswas as $mahasiswa)
                    <tr>
                        <td style="width: 5%;">{{ $loop->iteration }}</td>
                        <td style="width: 10%;">{{$mahasiswa->nama_pendek}} </td>
{{--                        <td style="width: 20%;">{{$mahasiswa->nama_panjang}} </td>--}}
                        <td style="width: 5%">{{$mahasiswa->nim}} </td>
                        <td style="width: 5%">{{$mahasiswa->kelas}} </td>
{{--                        <td style="width: 20%">{{$mahasiswa->alamat}} </td>--}}
{{--                        <td style="width: 5%">{{$mahasiswa->no_hp}} </td>--}}
                        <td style="width: 20%">{{$mahasiswa->email}}</td>
                        <td style="width: 20%; text-align: center; ">

                            <a style="color: white;" class="btn btn-primary btn-sm" data-toggle="modal"
                               data-nama_panjang="{{$mahasiswa->nama_panjang}}"
                               data-alamat="{{$mahasiswa->alamat}}"
                               data-no_hp="{{$mahasiswa->no_hp}}"
                               data-target="#modaldetail">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                &nbsp;Detail </a>
                            <a class="btn btn-primary btn-sm" href="{{ route('idxupmahasiswa', $mahasiswa->id) }}">
                                <i class="fa fa-pen" aria-hidden="true"></i>&nbsp; Update</a>
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm"
                                    id="btnHapusMahasiswa{{$mahasiswa->id}}"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Hapus
                            </button>
                            <script type="text/javascript">
                                $("#btnHapusMahasiswa{{$mahasiswa->id}}").click(function () {
                                    Swal.fire({
                                        title: 'Anda Yakin',
                                        text: "Untuk Mengahapus Mahasiswa dari Daftar?",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Lanjut'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $.ajax({
                                                type: 'get',
                                                url: "{{route('hapusmahasiswa')}}",
                                                data: {
                                                    id: "{{$mahasiswa->id}}"
                                                },
                                                success: function (dataResult) {
                                                    // $("#cartWrapper").html(dataResult);
                                                    Swal.fire({
                                                        // title: '<i class="fa fa-check"></i>',
                                                        title: 'Mahasiswa berhasil dihapus !',
                                                        // text: 'Artikel berhasil dihapus !',
                                                        icon: 'success',
                                                        showConfirmButton: false,
                                                        focusConfirm: true,
                                                        // timer: 2500,
                                                        // success:location.reload(),
                                                        success: setInterval(function () {
                                                            location.reload() // this will run after every 5 seconds
                                                        }, 950),
                                                    });
                                                },
                                                error: function () {
                                                    Swal.fire({
                                                        title: 'Oops!',
                                                        text: 'Mahasiswa gagal dihapus!',
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

    <!-- Import Excel -->
    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('mahasiswaexcel')}}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel</label>
                        <div class="form-group-file">
                            <input type="file" name="file" required="required">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{--    modal detail--}}
    <div class="modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Mahasiswa</h5>
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
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input readonly type="text" name="alamat" id="alamat"
                                       class="form-control" autocomplete="off" style="background-color:white;">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="no_hp">No Telepon</label>
                                <input type="text" name="no_hp" id="no_hp" class="form-control"
                                       autocomplete="off" readonly style="background-color:white;">
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
    <script type="text/javascript">
        $('#modaldetail').on('show.bs.modal', function (event) {
            console.log('modalopened');
            var button = $(event.relatedTarget);
            var nama_panjang = button.data('nama_panjang');
            var alamat = button.data('alamat');
            var no_hp = button.data('no_hp');

            var modal = $(this);
            modal.find('.modal-body #nama_panjang').val(nama_panjang);
            modal.find('.modal-body #alamat').val(alamat);
            modal.find('.modal-body #no_hp').val(no_hp);
        })
    </script>

    <script>
        $(document).ready(function () {
            var table = $('#tabelmahasiswa').DataTable({
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
                .appendTo('#tabelmahasiswa_wrapper .col-md-6:eq(0)');
        });
    </script>


@endsection
