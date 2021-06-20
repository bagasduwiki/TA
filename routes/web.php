<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;


//guest
Route::get('/', [App\Http\Controllers\HomeController::class, 'main'])->name('main');
Route::get('/artikel/', [App\Http\Controllers\HomeController::class, 'allArtikel'])->name('allArtikel');
Route::get('/artikel/{artikel_slug}', [App\Http\Controllers\HomeController::class, 'detailArtikel'])->name('detailArtikel');
Route::post('/artikel/komentar', [App\Http\Controllers\HomeController::class, 'storekomentar'])->name('storekomentar');

Route::get('/aspirasi/', [App\Http\Controllers\Web\AspirasiController::class,'list_aspirasi'])->name('list_aspirasi');

//auth
Auth::routes();

//middleware
Route::post('login', [LoginController::class, 'authenticate']);
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\Web\profileController::class, 'showProfile'])->name('showProfile');
    Route::post('/profile/update', [App\Http\Controllers\Web\profileController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/ubah-sandi', [App\Http\Controllers\Web\profileController::class, 'indexSandi'])->name('indexSandi');
    Route::post('/ubah-sandi/confirm', [App\Http\Controllers\Web\profileController::class, 'ubahSandi'])->name('ubahSandi');
});

//Route Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Web\DashboardController::class, 'adminindex'])->name('dashboard');
    Route::get('/admin/mobile', [App\Http\Controllers\Web\DashboardController::class, 'indexmobile'])->name('mobile');

//    Agenda
    Route::get('/agenda', [App\Http\Controllers\Web\AgendaController::class, 'adminindex'])->name('agenda');
    Route::get('/agenda/add', [App\Http\Controllers\Web\AgendaController::class, 'tambah_agenda'])->name('tambah_agenda');
    Route::post('/agenda/add/store', [App\Http\Controllers\Web\AgendaController::class, 'store_agenda'])->name('store_agenda');
    Route::get('/agenda/detail/{id}', [App\Http\Controllers\Web\AgendaController::class, 'detailagenda'])->name('detailagenda');
    Route::PATCH('/agenda/update/{id}', [App\Http\Controllers\Web\AgendaController::class, 'update_agenda'])->name('update_agenda');
    Route::any('/agenda/hapus', [App\Http\Controllers\Web\AgendaController::class, 'hapus_agenda'])->name('hapus_agenda');

//    Artikel
    Route::get('/artikel', [App\Http\Controllers\Web\ArtikelController::class, 'listArtikel'])->name('artikel');
    Route::get('/artikel/add', [App\Http\Controllers\Web\ArtikelController::class, 'tambah_artikel'])->name('tambah_artikel');
    Route::post('/artikel/add/store', [App\Http\Controllers\Web\ArtikelController::class, 'store_artikel'])->name('store_artikel');
    Route::get('/artikel/detail/{artikel_id}', [App\Http\Controllers\Web\ArtikelController::class, 'detail'])->name('detail');
    Route::PATCH('/artikel/update/{artikel_id}', [App\Http\Controllers\Web\ArtikelController::class, 'update_artikel'])->name('update_artikel');
    Route::any('/artikel/hapus', [App\Http\Controllers\Web\ArtikelController::class, 'hapus_artikel'])->name('hapus_artikel');

//    Tes Tulis
    Route::get('/testulis', [App\Http\Controllers\Web\Tes_tulisController::class, 'adminindex'])->name('testulis');
    Route::post('/testulis/add/', [App\Http\Controllers\Web\Tes_tulisController::class, 'store_testulis'])->name('store_testulis');
    Route::PATCH('/testulis/up/{id}', [App\Http\Controllers\Web\Tes_tulisController::class, 'update_testulis'])->name('update_testulis');
    Route::any('/testulis/hapus', [App\Http\Controllers\Web\Tes_tulisController::class, 'hapus_testulis'])->name('hapus_testulis');

//    user - mahasiswa
    Route::get('/mahasiswa', [App\Http\Controllers\Web\UserController::class, 'mahasiswa'])->name('mahasiswa');
    Route::get('/mahasiswa/add/', [App\Http\Controllers\Web\UserController::class, 'tambahmahasiswa'])->name('tambahmahasiswa');
    Route::post('/mahasiswa/store', [App\Http\Controllers\Web\UserController::class, 'storemahasiswa'])->name('storemahasiswa');
    Route::get('/mahasiswa/update/{id}', [App\Http\Controllers\Web\UserController::class, 'idxupmahasiswa'])->name('idxupmahasiswa');
    Route::PATCH('/mahasiswa/up/{id}', [App\Http\Controllers\Web\UserController::class, 'updatemahasiswa'])->name('updatemahasiswa');
    Route::any('/mahasiswa/hapus', [App\Http\Controllers\Web\UserController::class, 'hapusmahasiswa'])->name('hapusmahasiswa');
    Route::post('/mahasiswa/excel', [App\Http\Controllers\Web\UserController::class, 'mahasiswaexcel'])->name('mahasiswaexcel');


//    user - pendaftar
    Route::get('/pendaftar', [App\Http\Controllers\Web\UserController::class, 'pendaftar'])->name('pendaftar');
    Route::get('/pendaftar/hapus', [App\Http\Controllers\Web\UserController::class, 'hapuspendaftar'])->name('hapuspendaftar');
    Route::get('/pendaftar/verifikasi/{id_user}', [App\Http\Controllers\Web\UserController::class, 'verifikasipendaftar'])->name('verifikasipendaftar');
    Route::PATCH('/pendaftar/update-status/{id_user}', [App\Http\Controllers\Web\UserController::class, 'updatestatus'])->name('updatestatus');

//    user - pengurus
    Route::get('/pengurus-aktif', [App\Http\Controllers\Web\UserController::class, 'pengurusaktif'])->name('pengurusaktif');
    Route::get('/pengurus-aktif/add/', [App\Http\Controllers\Web\UserController::class, 'tambahpengurusaktif'])->name('tambahpengurusaktif');
    Route::post('/pengurus/import_excel', [App\Http\Controllers\Web\UserController::class, 'import_excel'])->name('import_excel');
    Route::post('/pengurus-aktif/store', [App\Http\Controllers\Web\UserController::class, 'storepengurusaktif'])->name('storepengurusaktif');
    Route::get('/pengurus-aktif/update/{id}', [App\Http\Controllers\Web\UserController::class, 'idxuppengurusaktif'])->name('idxuppengurusaktif');
    Route::PATCH('/pengurus-aktif/up/{id}', [App\Http\Controllers\Web\UserController::class, 'updatepengurusaktif'])->name('updatepengurusaktif');
    Route::any('/pengurus-aktif/hapus', [App\Http\Controllers\Web\UserController::class, 'hapuspengurusaktif'])->name('hapuspengurusaktif');
    Route::post('/pengurus-aktif/status', [App\Http\Controllers\Web\UserController::class, 'changestatus'])->name('changestatus');

//mobile - admin
//    Cakahim
    Route::get('/cakahim', [App\Http\Controllers\Web\cakahimController::class, 'adminindex'])->name('cakahim');
    Route::get('/cakahim/detail/{id}', [App\Http\Controllers\Web\cakahimController::class, 'detailcakahim'])->name('detailcakahim');
    Route::PATCH('/cakahim/update/{id}', [App\Http\Controllers\Web\cakahimController::class, 'update_cakahim'])->name('update_cakahim');
    Route::any('/cakahim/hapus', [App\Http\Controllers\Web\cakahimController::class, 'hapus_cakahim'])->name('hapus_cakahim');

//    Pemilihan
    Route::get('/pemilihan', [App\Http\Controllers\Web\PemilihanController::class, 'adminindex'])->name('pemilihan');
    Route::get('/pemilihan/detail/{id}', [App\Http\Controllers\Web\PemilihanController::class, 'detailpemilihan'])->name('detailpemilihan');
    Route::any('/pemilihan/hapus', [App\Http\Controllers\Web\PemilihanController::class, 'hapus_daftarcakahim'])->name('hapus_daftarcakahim');
    Route::any('/pemilihan/hapuspem/{id}', [App\Http\Controllers\Web\PemilihanController::class, 'hapus_pemilihan'])->name('hapus_pemilihan');

//  Aspirasi
    Route::get('/aspirasi', [App\Http\Controllers\Web\AspirasiController::class, 'adminindex'])->name('aspirasi');
    Route::any('/aspirasi/hapus', [App\Http\Controllers\Web\AspirasiController::class, 'hapus_aspirasi'])->name('hapus_aspirasi');
    Route::get('/aspirasi/detail/{id}', [App\Http\Controllers\Web\AspirasiController::class, 'detailaspirasi'])->name('detailaspirasi');
    Route::PATCH('/aspirasi/update/{id}', [App\Http\Controllers\Web\AspirasiController::class, 'update_aspirasi'])->name('update_aspirasi');
});


//Route Mahasiswa
Route::middleware(['auth', 'mahasiswa'])->prefix('mahasiswa')->group(function () {
//    mahasiswa - daftar himatika
    Route::get('/daftar', [App\Http\Controllers\Web\DaftarController::class, 'daftarindex'])->name('daftarindex');
    Route::post('/daftar/store', [App\Http\Controllers\Web\DaftarController::class, 'store_daftar'])->name('store_daftar');

//    mahasiswa - tes tulis
    Route::get('/tes-tulis/', [App\Http\Controllers\Web\Tes_tulisController::class, 'tespendaftar'])->name('tespendaftar');
    Route::post('/tes-tulis/kirim/', [App\Http\Controllers\Web\Tes_tulisController::class, 'kirimtes'])->name('kirimtes');
});


//Route Pengurus
Route::middleware(['auth', 'pengurusadmin'])->prefix('pengurus')->group(function () {
    Route::get('/agenda', [App\Http\Controllers\Web\AgendaController::class, 'index_agenda'])->name('index_agenda');
    Route::get('/agenda/{id}/', [App\Http\Controllers\Web\AgendaController::class, 'showAgenda'])->name('showAgenda');
    Route::get('/aspirasis/', [App\Http\Controllers\Web\AspirasiController::class, 'pengurusaspirasi'])->name('pengurusaspirasi');

});
