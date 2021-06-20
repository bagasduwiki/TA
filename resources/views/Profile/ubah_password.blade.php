@extends((Auth::user()->as == 'admin') ? 'layouts.admin.main' : 'layouts.app')
@section('title', 'Ubah Password')
@section('content')
    <div class="container py-4">
        <div class="card">
            {{--            <div class="col-md-8">--}}
            <div class="card-body">
                <h4>Ubah Kata Sandi</h4>
                <hr>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block" id="myWish">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('ubahSandi') }}" id="submit_password">
                        @csrf
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <p class="text-danger">{{ $error }}</p>--}}
{{--                        @endforeach--}}
                        <div class="form-group">
                            <label for="password">Masukkan Sandi Lama</label>
                            <input id="password" type="password" class="form-control" name="current_password"
                                   autocomplete="current-password" placeholder="Masukkan Sandi Lama">
                            @error('current_password')
                            <div class="alert-danger">Kata Sandi Salah</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="new_password">Sandi Baru</label>
                            <input id="new_password" type="password" class="form-control" name="new_password"
                                   autocomplete="current-password" placeholder="Masukkan Sandi Baru">
                        </div>

                        <div class="form-group">
                            <label for="new_confirm_password">Ulangi Sandi Baru</label>
                            <input id="new_confirm_password" type="password" class="form-control"
                                   name="new_confirm_password" autocomplete="current-password"
                                   placeholder="Masukkan Kembali Sandi Baru">
                            @error('new_confirm_password')
                            <div class="alert-danger">Kata Sandi Tidak Sama</div>
                            @enderror
                        </div>
                        <a id="btnSubmit" class="btn btn-primary float-right">
                            Update Password
                        </a>

                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end my-4">
        </div>
    </div>
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
                    $("#submit_password").submit()
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
