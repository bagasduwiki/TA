@extends('layouts.admin.main')
@section('title', 'Admin - Cakahim')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800" style="border-left: solid black 5px">&nbsp;Cakahim</h1>
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
            <table id="tabelcakahim" class="table table-bordered text-center" cellspacing="0" width="100%"
                   style="width: 100%; margin-left: auto; margin-right: auto;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Cakahim</th>
                    <th>IPK</th>
                    <th>Visi</th>
                    <th>Misi</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($cakahims as $cakahim)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $cakahim->User->nama_pendek }} </td>
                        <td>{{ $cakahim->ipk }}</td>
                        <td>{{ $cakahim->visi }}</td>
                        <td>{{ $cakahim->misi }}</td>
                        <td>{{ $cakahim->status }}</td>
                        {{--                        <td></td>--}}
                        <td style="width: 15%; text-align: center;">
                            <a class="btn btn-success btn-sm" href="{{ route('detailcakahim', $cakahim->id) }}">
                                Verif </a>
                            <button type="submit" class="btn btn-danger btn-sm" id="btnHapusCakahim{{$cakahim->id}}">
                                Hapus
                            </button>
                            <script type="text/javascript">
                                $("#btnHapusCakahim{{$cakahim->id}}").click(function () {
                                    Swal.fire({
                                        title: 'Anda Yakin Menghapus Ini?',
                                        text: "Cakahim Yang Dihapus Tidak Bisa Dikembalikan!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Lanjut'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $.ajax({
                                                type: 'get',
                                                url: "{{route('hapus_cakahim')}}",
                                                data: {
                                                    id: "{{$cakahim->id}}"
                                                },
                                                success: function () {
                                                    Swal.fire({
                                                        title: 'Cakahim berhasil dihapus !',
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
                                                        text: 'Cakahim gagal dihapus!',
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
@endsection
