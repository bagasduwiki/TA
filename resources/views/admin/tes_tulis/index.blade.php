@extends('layouts.admin.main')
@section('title', 'Admin - Tes Tulis')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800" style="border-left: solid black 5px">&nbsp;Tes Tulis</h1>
                <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                        data-target="#modaladd"><i
                        class="fas fa-tasks fa-sm text-white-50"></i>&nbsp; + Tes Tulis
                </button>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{$message}}',
                    icon: 'success',
                    confirmButtonText: 'Keluar'
                })
            </script>
        @elseif($message = Session::get('error'))
            <script>
                Swal.fire({
                    title: 'Oops!',
                    text: '{{$message}}',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
        <div class="alert alert-primary alert-block" id="myWish">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $cukup }}</strong>
        </div>
        <div class="table-responsive p-2">
            <table id="tabletestulis" class="table table-bordered" cellspacing="0" width="100%"
                   style="width: 100%; margin-left: auto; margin-right: auto;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Soal</th>
                    <th>Dibuat Tanggal</th>
                    <th>Diubah Tanggal</th>
                    <th> Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($testulis as $soal)
                    <tr>
                        <td style="width: 5%;">{{$loop->iteration}}</td>
                        <td>{{ $soal->soal }}</td>
                        <td style="width: 18%;">{{Carbon\Carbon::parse($soal->created_at)->isoFormat('dddd, D MMMM Y') }}</td>
                        <td style="width: 18%;">{{Carbon\Carbon::parse($soal->created_at)->isoFormat('dddd, D MMMM Y') }}</td>
                        <td style="width: 18%; text-align: center;">
                            <a style="color: white;" class="btn btn-primary btn-sm" data-toggle="modal"
                               data-id="{{$soal->id}}"
                               data-soal="{{$soal->soal}}"
                               data-target="#modaledit">
                                <i class="fas fa-pen"></i> &nbsp; Update </a>
                            <button
                                type="submit" class="btn btn-danger btn-sm" id="btnHapusTesTulis{{$soal->id}}">Hapus
                                &nbsp;<i class="fas fa-trash"></i>
                            </button>
                            <script type="text/javascript">
                                $("#btnHapusTesTulis{{$soal->id}}").click(function () {
                                    Swal.fire({
                                        title: 'Anda Yakin Menghapus Ini?',
                                        text: "Soal Yang Dihapus Tidak Bisa Dikembalikan!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Lanjut'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $.ajax({
                                                type: 'get',
                                                url: "{{route('hapus_testulis')}}",
                                                data: {
                                                    id: "{{$soal->id}}"
                                                },
                                                success: function () {
                                                    Swal.fire({
                                                        title: 'Agenda berhasil dihapus !',
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
                                                        text: 'Soal gagal dihapus!',
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

    {{--    modal--}}

    <div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan Soal!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="show">
                    <form method="post" action="{{route('store_testulis')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_name">Isi Soal</label>
                                    <input type="text" name="soal" id="soal" class="form-control"
                                           autocomplete="off" required placeholder="Contoh : Apa tujuan anda ikut..?">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save
                                        changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- update slurr -->
    <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="show">
                    <form method="post" id="formEdit" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_name">MasukkanSoal</label>
                                    <input type="text" name="soal" id="soal" class="form-control"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#modaledit').on('show.bs.modal', function (event) {
            console.log('modalopened');
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var soal = button.data('soal');

            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #soal').val(soal);
            $("#formEdit").attr("action", "/admin/testulis/up/" + id)

        })
    </script>
    {{--datatable--}}
    <script>
        $(document).ready(function () {
            var table = $('#tabletestulis').DataTable({
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
                .appendTo('#tabletestulis_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        $("#myWish").fadeTo(4000, 500).slideUp(500, function () {
            $("#myWish").slideUp(500);
        });
    </script>

@endsection
