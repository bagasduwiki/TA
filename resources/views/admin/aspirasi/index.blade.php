@extends('layouts.admin.main')
@section('title', 'Admin - Aspirasi')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800" style="border-left: solid black 5px">&nbsp;Aspirasi</h1>
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
            <table id="tabelaspirasi" class="table table-bordered text-center" cellspacing="0" width="100%"
                   style="width: 100%; margin-left: auto; margin-right: auto;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Aspirasi</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @forelse ($aspirasis as $aspirasi)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $aspirasi->User->nama_pendek }} </td>
                          <td>{{ $aspirasi->deskripsi }}</td>
                          {{--                        <td></td>--}}
                          <td style="width: 15%; text-align: center;">
                                <button type="submit" class="btn btn-danger btn-sm" id="btnHapusAspirasi{{$aspirasi->id}}">Hapus</button>
                              <script type="text/javascript">
                                  $("#btnHapusAspirasi{{$aspirasi->id}}").click(function () {
                                      Swal.fire({
                                          title: 'Anda Yakin Menghapus Ini?',
                                          text: "Aspirasi Yang Dihapus Tidak Bisa Dikembalikan!",
                                          icon: 'warning',
                                          showCancelButton: true,
                                          confirmButtonColor: '#3085d6',
                                          cancelButtonColor: '#d33',
                                          confirmButtonText: 'Lanjut'
                                      }).then((result) => {
                                          if (result.isConfirmed) {
                                              $.ajax({
                                                  type: 'get',
                                                  url: "{{route('hapus_aspirasi')}}",
                                                  data: {
                                                      id: "{{$aspirasi->id}}"
                                                  },
                                                  success: function () {
                                                      Swal.fire({
                                                          title: 'Aspirasi berhasil dihapus !',
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
                                                          text: 'Aspirasi gagal dihapus!',
                                                          icon: 'error',
                                                          confirmButtonText: 'OK'
                                                      });
                                                  }

                                              });
                                          }
                                      });
                                  });
                              </script>
                              <a class="btn btn-info btn-sm" href="{{ route('detailaspirasi', $aspirasi->id) }}">
                                  Komen </a>
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
            var table = $('#tabelaspirasi').DataTable({
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
                .appendTo('#tabelaspirasi_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
