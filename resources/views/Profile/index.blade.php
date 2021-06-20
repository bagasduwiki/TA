@extends((Auth::user()->as == 'admin') ? 'layouts.admin.main' : 'layouts.app')
@section('title', 'Profile')
@section('content')
    <div class="container py-4">
        <div class="card">
{{--            <div class="d-flex justify-content-end my-4">--}}
                <div class="card-body">
                    <h4>Edit Profil</h4>
                    <hr>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block" id="myWish">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    <form action="{{route('updateProfile')}}" id="formEditProfile" method="post">
                        <div class="row">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Pendek</label>
                                    <input type="name" class="form-control" name="nama_pendek"
                                           value="{{Auth::user()->nama_pendek}}"
                                           id="nameInput" aria-describedby="emailHelp" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Panjang</label>
                                    <input type="name" class="form-control" name="nama_panjang"
                                           value="{{Auth::user()->nama_panjang}}"
                                           id="nameInput" aria-describedby="emailHelp" required>
                                </div>
                                <div class="form-group">
                                    <label for="emailInput">Email</label>
                                    <input type="email" name="email" class="form-control" id="emailInput"
                                           value="{{Auth::user()->email}}" aria-describedby="emailHelp" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phoneInput">Nomor HP</label>
                                    <input type="text" name="no_hp" class="form-control" id="phoneInput"
                                           value="{{Auth::user()->no_hp}}" aria-describedby="emailHelp" required>
                                    @error('no_hp')
                                    <div class="alert-danger">Minimal 11 dan Maksimal 13 digit</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phoneInput">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" id="phoneInput"
                                           value="{{Auth::user()->alamat}}" aria-describedby="emailHelp" required>
                                </div>
                            </div>
                        </div>
                        <a id="btnSubmit" class="btn btn-primary float-right">Simpan Perubahan</a>
                    </form>
                </div>
            </div>
        </div>
{{--    </div>--}}
    <script>
        $("#btnSubmit").click(function () {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Apakah yakin ingin merubah data profil anda?',
                showCancelButton: true,
                confirmButtonText: `Ya`,
                cancelButtonText: `Batal`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $("#formEditProfile").submit()
                } else if (result.isDenied) {

                }
            })
        });
    </script>
    <script>
        $("#myWish").fadeTo(4000, 500).slideUp(500, function () {
            $("#myWish").slideUp(500);
        });
    </script>


@endsection
