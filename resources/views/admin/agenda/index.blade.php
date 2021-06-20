@extends('layouts.admin.main')
@section('title', 'Admin - Agenda')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800" style="border-left: solid black 5px">&nbsp;Agenda</h1>
                <a href="{{route('tambah_agenda')}}"
                   class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-calendar fa-sm text-white-50"></i>&nbsp; Tambah Agenda</a>
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

        <div class="table-responsive p-2">
            <table id="tabelagenda" class="table table-bordered" cellspacing="0" width="100%"
                   style="width: 100%; margin-left: auto; margin-right: auto;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Agenda</th>
                    {{--                    <th style="width: 20%">Artikel Thumbnail</th>--}}
                    <th>Diagendakan Tanggal</th>
                    <th>Diubah Tanggal</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($agendas as $agenda)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{!! \Illuminate\Support\Str::words( $agenda->nama_agenda, 3, '...') !!} </td>
                        {{--                        <td><img src="{{ asset('storage/images/agenda/'.$agenda->foto_agenda) }}" alt=""--}}
                        {{--                                 style="max-width: 100%;"></td>--}}
                        <td>{{Carbon\Carbon::parse($agenda->created_at)->isoFormat('dddd, D MMMM Y') }}</td>
                        <td>{{Carbon\Carbon::parse($agenda->updated_at)->isoFormat('dddd, D MMMM Y') }}</td>
                        {{--                        <td></td>--}}
                        <td style="width: 20%; text-align: center;">
                            <a class="btn btn-primary btn-sm" href="{{ route('detailagenda', $agenda->id) }}">
                                <i class="fas fa-pen"></i>&nbsp;  Update </a>
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" id="btnHapusAgenda{{$agenda->id}}">
                                Hapus&nbsp;&nbsp;<i class="fas fa-trash"></i>
                            </button>
                            <script type="text/javascript">
                                $("#btnHapusAgenda{{$agenda->id}}").click(function () {
                                    Swal.fire({
                                        title: 'Anda Yakin Menghapus Ini?',
                                        text: "Agenda Yang Dihapus Tidak Bisa Dikembalikan!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Lanjut'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $.ajax({
                                                type: 'get',
                                                url: "{{route('hapus_agenda')}}",
                                                data: {
                                                    id: "{{$agenda->id}}"
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
                                                        text: 'Agenda gagal dihapus!',
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
    <script>
        $(document).ready(function () {
            var table = $('#tabelagenda').DataTable({
                responsive: true,
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
                .appendTo('#tabelagenda_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
