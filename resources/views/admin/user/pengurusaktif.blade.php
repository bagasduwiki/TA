@extends('layouts.admin.main')
@section('title', 'Admin - Pengurus')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content mb-4">
                <h1 class="h3 mb-0 text-gray-800" style="border-left: solid black 5px">&nbsp;Pengurus</h1>
            </div>
            <a href="{{route('tambahpengurusaktif')}}"
               class="btn btn-sm btn-primary shadow-sm"
               style="width: 11%;  position: absolute; right: 5%; margin-right: 2%"><i
                    class="fas fa-user-plus fa-sm text-white-50"></i>&nbsp; Tambah Pengurus</a>
            <button type="button" class=" btn btn-sm btn-primary shadow-sm"
                    data-toggle="modal" data-target="#importExcel" style="width: 4%; position: absolute; right: 2%;">
                <i class="fas fa-upload fa-sm text-white-50"></i>&nbsp;
            </button>
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
            <table id="tabelpengurus" class="table table-bordered" cellspacing="0" width="100%"
                   style="width: 100%; margin-left: auto; margin-right: auto;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Kelas</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($pengurus as $data)
                    <tr>
                        <td style="width: 5%;">{{ $loop->iteration }}</td>
                        <td style="width: 5%">{{$data->nim}} </td>
                        <td style="width: 15%;">{{$data->nama_pendek}} </td>
                        <td style="width: 15%;">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input switch" id="switch{{$data->nim}}"
                                       @if($data->as === "admin") checked @else @endif>
                                <label class="custom-control-label" for="switch{{$data->nim}}"
                                       id="labelswitch{{$data->nim}}">{{$data->as}}</label>
                            </div>
                            <script>
                                $('#switch{{$data->nim}}').change(function () {
                                    if (this.checked) {
                                        $('#labelswitch{{$data->nim}}').html('admin')
                                        $.ajax({
                                            url: "{{route('changestatus')}}",
                                            type: 'POST',
                                            data: {
                                                nim: '{{$data->nim}}',
                                                as: 'pengurus',
                                                _token: '{{csrf_token()}}'
                                            },
                                            success: function (dataResult) {
                                                // $("#cartWrapper").html(dataResult);
                                                Swal.fire({
                                                    title: 'Sukses !',
                                                    text: 'Merubah Status Berhasil!',
                                                    icon: 'success',
                                                    confirmButtonText: 'Keluar',
                                                    showConfirmButton: true,
                                                    focusConfirm: true
                                                });
                                            },
                                            error: function () {
                                                Swal.fire({
                                                    title: 'Oops!',
                                                    text: 'Gagal Merubah',
                                                    icon: 'error',
                                                    confirmButtonText: 'OK'
                                                });
                                            }
                                        })
                                    } else {
                                        $('#labelswitch{{$data->nim}}').html('pengurus')
                                        $.ajax({
                                            url: "{{route('changestatus')}}",
                                            type: 'POST',
                                            data: {
                                                nim: '{{$data->nim}}',
                                                as: 'admin',
                                                _token: '{{csrf_token()}}'
                                            },
                                            success: function (dataResult) {
                                                // $("#cartWrapper").html(dataResult);
                                                Swal.fire({
                                                    title: 'Sukses !',
                                                    text: 'Merubah Status Berhasil!',
                                                    icon: 'success',
                                                    confirmButtonText: 'Keluar',
                                                    showConfirmButton: true,
                                                    focusConfirm: true
                                                });
                                            }
                                        })
                                    }
                                })
                            </script>
                        </td>
                        <td>{{$data->kelas}} </td>
                        <td style="width: 25%">{{$data->email}}</td>
                        <td style="width: 26%; text-align: center; ">

                            <a style="color: white;" class="btn btn-primary btn-sm" data-toggle="modal"
                               data-nama_panjang="{{$data->nama_panjang}}"
                               data-alamat="{{$data->alamat}}"
                               data-no_hp="{{$data->no_hp}}"
                               data-target="#modaldetail">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                &nbsp;Detail </a>
                            <a class="btn btn-primary btn-sm" href="{{ route('idxuppengurusaktif', $data->id) }}">
                                <i class="fa fa-pen" aria-hidden="true"></i>
                                 &nbsp; Edit </a>
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" id="btnHapusPengurus{{$data->id}}">
                                <i class="fa fa-trash" aria-hidden="true"></i> &nbsp;
                                Hapus
                            </button>
                            <script type="text/javascript">
                                $("#btnHapusPengurus{{$data->id}}").click(function () {
                                    Swal.fire({
                                        title: 'Anda Yakin',
                                        text: "Untuk Mengahapus Pengurus dari Daftar?",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Lanjut'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $.ajax({
                                                type: 'get',
                                                url: "{{route('hapuspengurusaktif')}}",
                                                data: {
                                                    id: "{{$data->id}}"
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

    <!-- Import Excel -->
    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('import_excel')}}" enctype="multipart/form-data">
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
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pengurus</h5>
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

    {{--    final sesi, dibawah ini script aja--}}
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
    {{-- script data table--}}
    <script>
        $(document).ready(function () {
            var table = $('#tabelpengurus').DataTable({
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
                .appendTo('#tabelpengurus_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
