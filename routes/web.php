<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\UsiaController;
use App\Http\Controllers\PrktDesaController;
use App\Http\Controllers\PotensiController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\SuratketController;
use App\Http\Controllers\SuratpengantarController;
use App\Http\Controllers\SuratpengaduController;
use App\Http\Controllers\KritsarController;
use App\Http\Controllers\PeternakanController;
use App\Http\Controllers\PertanianController;
use App\Http\Controllers\PerkebunanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// //Halaman Home
// Route::get('/', function () {
//     return view('pages.home');
// });

//Halaman Home
Route::get('/', [HomeController::class, 'index'])->name('home');

//Halaman Profil Desa
Route::get('/profil', [ProfilController::class, 'index']); //(Sejarah-Batas Wilayah)
Route::get('/struktur', [ProfilController::class, 'struktur']); //Halaman Struktur Organisasi
Route::get('/penduduk', [ProfilController::class, 'penduduk']); //Halaman Data Penduduk Desa

//Halaman Berita dan Kegiatan
Route::get('/artikel', [ArtikelController::class, 'artikel']); //Halaman Artikel Desa
Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show'); //Halaman Detail Artikel
Route::get('/agenda', [HomeController::class, 'agenda']); //Halaman Agenda Kegiatan Desa
Route::get('/pengumuman', [PengumumanController::class, 'pengumuman']); //Halaman Pengumuman Desa
Route::get('/pengumuman/{id}', [PengumumanController::class, 'show'])->name('pengumuman.show'); //Halaman Detail Pengumuman

//Halaman Layanan Desa
Route::get('/kesehatan', [PosyanduController::class, 'kesehatan']); //layanan kesehatan
Route::get('/masyarakat', [MasyarakatController::class, 'index']); //layanan masyarakat
Route::get('/cari-surat', [MasyarakatController::class, 'cariSurat']); //fungsi cari surat
Route::get('/surat/{tipe}/{id}/download', [MasyarakatController::class, 'download'])->name('surat.download');
    //Form Surat Keterangan
    Route::get('/fsuratket', [MasyarakatController::class, 'fsuratket']); //form surat keterangan
    Route::post('save-suratket',[SuratketController::class,'store'])->name('suratket.store'); //fungsi save suratket
    Route::get('/suratket/konfirmasi/{id}', [SuratketController::class, 'konfirmasi'])->name('suratket.konfirm_ket'); //halaman konfirmasi surarket
    //Form surat pengantar
    Route::get('/fsuratpengantar', [MasyarakatController::class, 'fsuratpengantar']); //form surat pengantar
    Route::post('save-suratpengantar',[SuratpengantarController::class,'store'])->name('suratpengantar.store'); //fungsi save suratket
    Route::get('/suratpengantar/konfirmasi/{id}', [SuratpengantarController::class, 'konfirmasi'])->name('suratpengantar.konfirm_peng'); //halaman konfirmasi surarket
    //Form surat kritik & saran
    Route::get('/fsuratkritsar', [MasyarakatController::class, 'fsuratkritsar'])->name('fkritsar'); //form surat Kritik dan Saran
    Route::post('save-kritsar',[KritsarController::class,'store'])->name('kritsar.store'); //fungsi save surat kritsar
    //Form surat pengaduan
    Route::get('/fsuratpengadu', [MasyarakatController::class, 'fsuratpengadu']); //form surat pengaduan
    Route::post('save-suratpengadu',[SuratpengaduController::class,'store'])->name('suratpengadu.store'); //fungsi save suratket
    Route::get('/suratpengadu/konfirmasi/{id}', [SuratpengaduController::class, 'konfirmasi'])->name('suratpengadu.konfirm_pengadu'); //halaman konfirmasi surarket

//Halaman Potensi Desa
Route::get('/potensi', [PotensiController::class, 'potensi']);

//Halaman Galeri
Route::get('/galeri', [GaleriController::class, 'galeri']);
Route::get('/program', [HomeController::class, 'prog']);

//Login & Logout
Route::get('/login', [LoginController::class, 'login'])->name('login');; //form login
Route::post('/proses', [LoginController::class, 'proses'])->name('login.proses'); //Proses Login
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); //Proses Logout
//Halaman Admin (butuh akses login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard'); //dashboard admin

    //Halaman kelola Artikel - admin
    Route::get('/admin-artikel', [ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('/tbh-artikel',[ArtikelController::class,'create'])->name('artikel.tambah'); //tambah artikel
    Route::post('save-artikel',[ArtikelController::class,'store'])->name('artikel.store'); //simpan artikel
    Route::get('edit-artikel/{id}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit'); //edit artikel
    Route::put('update-artikel/{id}', [ArtikelController::class, 'update'])->name('artikel.update'); //update artikel
    Route::delete('artikel/{id}', [ArtikelController::class, 'destroy'])->name('artikel.destroy'); //hapus artikel
    //Halaman kelola Agenda - admin
    Route::get('/admin-agenda', [AgendaController::class, 'index'])->name('agenda.index');
    Route::get('/tbh-agenda',[AgendaController::class,'create'])->name('agenda.tambah'); //tambah agenda
    Route::post('save-agenda',[AgendaController::class,'store'])->name('agenda.store'); //simpan agenda
    Route::get('edit-agenda/{id}/edit', [AgendaController::class, 'edit'])->name('agenda.edit'); //edit agenda
    Route::put('update-agenda/{id}', [AgendaController::class, 'update'])->name('agenda.update'); //update agenda
    Route::delete('agenda/{id}', [AgendaController::class, 'destroy'])->name('agenda.destroy'); //hapus agenda
    //Halaman kelola pengumuman - admin
    Route::get('/admin-pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::get('/tbh-pengumuman',[PengumumanController::class,'create'])->name('pengumuman.tambah'); //tambah pengumuman
    Route::post('save-pengumuman',[PengumumanController::class,'store'])->name('pengumuman.store'); //simpan pengumuman
    Route::get('edit-pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit'); //edit pengumuman
    Route::put('update-pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update'); //update pengumuman
    Route::delete('pengumuman/{id}', [pengumumanController::class, 'destroy'])->name('pengumuman.destroy'); //hapus pengumuman

    //Halaman kelola user - admin
    Route::get('/admin-user', [UsersController::class, 'index'])->name('user.index');
    Route::get('/tbh-user',[UsersController::class,'create'])->name('user.tambah'); //tambah user
    Route::post('save-user',[UsersController::class,'store'])->name('user.store'); //simpan user
    Route::get('edit-user/{id}/edit', [UsersController::class, 'edit'])->name('user.edit'); //edit user
    Route::put('update-user/{id}', [UsersController::class, 'update'])->name('user.update'); //update user
    Route::delete('user/{id}', [UsersController::class, 'destroy'])->name('user.destroy'); //hapus user
    Route::resource('users', UsersController::class)->middleware('auth'); // pastikan hanya admin yg bisa
    //Halaman kelola penduduk - admin
    Route::get('/admin-penduduk', [PendudukController::class, 'index'])->name('penduduk.index');
    Route::get('/tbh-penduduk',[PendudukController::class,'create'])->name('penduduk.tambah'); //tambah penduduk
    Route::post('save-penduduk',[PendudukController::class,'store'])->name('penduduk.store'); //simpan penduduk
    Route::get('edit-penduduk/{id}/edit', [PendudukController::class, 'edit'])->name('penduduk.edit'); //edit penduduk
    Route::put('update-penduduk/{id}', [PendudukController::class, 'update'])->name('penduduk.update'); //update penduduk
    Route::delete('penduduk/{id}', [pendudukController::class, 'destroy'])->name('penduduk.destroy'); //hapus penduduk
    //Halaman kelola pekerjaan - admin
    Route::get('/admin-pekerjaan', [PekerjaanController::class, 'index'])->name('pekerjaan.index');
    Route::get('/tbh-pekerjaan',[PekerjaanController::class,'create'])->name('pekerjaan.tambah'); //tambah pekerjaan
    Route::post('save-pekerjaan',[PekerjaanController::class,'store'])->name('pekerjaan.store'); //simpan pekerjaan
    Route::get('edit-pekerjaan/{id}/edit', [PekerjaanController::class, 'edit'])->name('pekerjaan.edit'); //edit pekerjaan
    Route::put('update-pekerjaan/{id}', [PekerjaanController::class, 'update'])->name('pekerjaan.update'); //update pekerjaan
    Route::delete('pekerjaan/{id}', [pekerjaanController::class, 'destroy'])->name('pekerjaan.destroy'); //hapus pekerjaan
    //Halaman kelola usia - admin
    Route::get('/admin-usia', [UsiaController::class, 'index'])->name('usia.index');
    Route::get('/tbh-usia',[UsiaController::class,'create'])->name('usia.tambah'); //tambah usia
    Route::post('save-usia',[UsiaController::class,'store'])->name('usia.store'); //simpan usia
    Route::get('edit-usia/{id}/edit', [UsiaController::class, 'edit'])->name('usia.edit'); //edit usia
    Route::put('update-usia/{id}', [UsiaController::class, 'update'])->name('usia.update'); //update usia
    Route::delete('usia/{id}', [UsiaController::class, 'destroy'])->name('usia.destroy'); //hapus usia
    //Halaman kelola galeri - admin
    Route::get('/admin-galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::get('/tbh-galeri',[GaleriController::class,'create'])->name('galeri.tambah'); //tambah galeri
    Route::post('save-galeri',[GaleriController::class,'store'])->name('galeri.store'); //simpan galeri
    Route::get('edit-galeri/{id}/edit', [GaleriController::class, 'edit'])->name('galeri.edit'); //edit galeri
    Route::put('update-galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update'); //update galeri
    Route::delete('galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy'); //hapus galeri
    //Halaman kelola prktdesa - admin
    Route::get('/admin-prktdesa', [PrktDesaController::class, 'index'])->name('prktdesa.index');
    Route::get('/tbh-prktdesa',[PrktDesaController::class,'create'])->name('prktdesa.tambah'); //tambah prktdesa
    Route::post('save-prktdesa',[PrktDesaController::class,'store'])->name('prktdesa.store'); //simpan prktdesa
    Route::get('edit-prktdesa/{id}/edit', [PrktDesaController::class, 'edit'])->name('prktdesa.edit'); //edit prktdesa
    Route::put('update-prktdesa/{id}', [PrktDesaController::class, 'update'])->name('prktdesa.update'); //update prktdesa
    Route::delete('prktdesa/{id}', [PrktDesaController::class, 'destroy'])->name('prktdesa.destroy'); //hapus prktdesa

    //Halaman kelola Layanan Kesehatan Posyandu - admin
    Route::get('/admin-posyandu', [PosyanduController::class, 'index'])->name('posyandu.index');
    Route::get('/tbh-posyandu',[PosyanduController::class,'create'])->name('posyandu.tambah'); //tambah posyandu
    Route::post('save-posyandu',[PosyanduController::class,'store'])->name('posyandu.store'); //simpan posyandu
    Route::get('edit-posyandu/{id}/edit', [PosyanduController::class, 'edit'])->name('posyandu.edit'); //edit posyandu
    Route::put('update-posyandu/{id}', [PosyanduController::class, 'update'])->name('posyandu.update'); //update posyandu
    Route::delete('posyandu/{id}', [PosyanduController::class, 'destroy'])->name('posyandu.destroy'); //hapus posyandu
    //Halaman kelola surat keterangan - admin
    Route::get('/suratket', [SuratketController::class, 'index'])->name('suratket.index');
    Route::patch('/suratket/{id}/check', [SuratketController::class, 'check'])->name('suratket.check'); //fungsi tombol cek
    Route::get('/suratket/{id}', [SuratketController::class, 'show'])->name('suratket.show'); //detail suratket
    Route::delete('suratket/{id}', [SuratketController::class, 'destroy'])->name('suratket.destroy'); //hapus suratket
    Route::patch('/suratket/{id}/arsipkan', [SuratketController::class, 'arsipkan'])->name('suratket.arsipkan'); //fungsi tombol arsip
    Route::get('/arsip-ket', [SuratketController::class, 'arsip'])->name('suratket.arsip'); //halaman arsip suratket
    Route::patch('/suratket/{id}/keluarkan', [SuratKetController::class, 'keluarkanArsip'])->name('suratket.keluarkan'); //fungsi tombol keluar arsip
    Route::get('/suratketunduh', [SuratketController::class, 'downloadPage'])->name('suratket.downloadPage'); //halaman download
    Route::post('/suratketunduhpdf', [SuratketController::class, 'downloadPDF'])->name('suratket.downloadPDF'); //fungsi download pdf
    //Halaman kelola surat pengantar - admin
    Route::get('/suratpengantar', [SuratpengantarController::class, 'index'])->name('suratpengantar.index');
    Route::patch('/suratpengantar/{id}/check', [SuratpengantarController::class, 'check'])->name('suratpengantar.check'); //fungsi tombol cek
    Route::get('/suratpengantar/{id}', [SuratpengantarController::class, 'show'])->name('suratpengantar.show'); //detail suratket
    Route::delete('suratpengantar/{id}', [SuratpengantarController::class, 'destroy'])->name('suratpengantar.destroy'); //hapus suratpengantar
    Route::patch('/suratpengantar/{id}/arsipkan', [SuratpengantarController::class, 'arsipkan'])->name('suratpengantar.arsipkan'); //fungsi tombol arsip
    Route::get('/arsip-peng', [SuratpengantarController::class, 'arsip'])->name('suratpengantar.arsip'); //halaman arsip suratket
    Route::patch('/suratpengantar/{id}/keluarkan', [SuratpengantarController::class, 'keluarkanArsip'])->name('suratpengantar.keluarkan'); //fungsi tombol keluar arsip
    Route::get('/suratpengantarunduh', [SuratpengantarController::class, 'downloadPage'])->name('suratpengantar.downloadPage'); //halaman download
    Route::post('/suratpengantarunduhpdf', [SuratpengantarController::class, 'downloadPDF'])->name('suratpengantar.downloadPDF'); //fungsi download pdf
    //Halaman kelola surat pengaduan - admin
    Route::get('/suratpengadu', [SuratpengaduController::class, 'index'])->name('suratpengadu.index');
    Route::patch('/suratpengadu/{id}/check', [SuratpengaduController::class, 'check'])->name('suratpengadu.check'); //fungsi tombol cek
    Route::get('/suratpengadu/{id}', [SuratpengaduController::class, 'show'])->name('suratpengadu.show'); //detail suratpengadu
    Route::delete('suratpengadu/{id}', [SuratpengaduController::class, 'destroy'])->name('suratpengadu.destroy'); //hapus suratpengadu
    Route::patch('/suratpengadu/{id}/arsipkan', [SuratpengaduController::class, 'arsipkan'])->name('suratpengadu.arsipkan'); //fungsi tombol arsip
    Route::get('/arsip-pengadu', [SuratpengaduController::class, 'arsip'])->name('suratpengadu.arsip'); //halaman arsip suratpengadu
    Route::patch('/suratpengadu/{id}/keluarkan', [SuratpengaduController::class, 'keluarkanArsip'])->name('suratpengadu.keluarkan'); //fungsi tombol keluar arsip
    Route::get('/suratpengaduunduh', [SuratpengaduController::class, 'downloadPage'])->name('suratpengadu.downloadPage'); //halaman download
    Route::post('/suratpengaduunduhpdf', [SuratpengaduController::class, 'downloadPDF'])->name('suratpengadu.downloadPDF'); //fungsi download pdf
    //Halaman kelola kritik&saran - admin
    Route::get('/kritsar', [KritsarController::class, 'index'])->name('kritsar.index');
    Route::get('/kritsar/{id}', [KritsarController::class, 'show'])->name('kritsar.show'); //detail kritsar
    Route::delete('kritsar/{id}', [KritsarController::class, 'destroy'])->name('kritsar.destroy'); //hapus kritsar

    //Halaman kelola Peternakan - admin
    Route::get('/peternakan', [PeternakanController::class, 'index'])->name('peternakan.index');
    Route::get('/tbh-peternakan',[PeternakanController::class,'create'])->name('peternakan.tambah'); //tambah peternakan
    Route::post('save-peternakan',[PeternakanController::class,'store'])->name('peternakan.store'); //simpan peternakan
    Route::get('edit-peternakan/{id}/edit', [PeternakanController::class, 'edit'])->name('peternakan.edit'); //edit peternakan
    Route::put('update-peternakan/{id}', [PeternakanController::class, 'update'])->name('peternakan.update'); //update peternakan
    Route::delete('peternakan/{id}', [PeternakanController::class, 'destroy'])->name('peternakan.destroy'); //hapus peternakan
    //Halaman kelola Perkebunan - admin
    Route::get('/perkebunan', [PerkebunanController::class, 'index'])->name('perkebunan.index');
    Route::get('/tbh-perkebunan',[PerkebunanController::class,'create'])->name('perkebunan.tambah'); //tambah perkebunan
    Route::post('save-perkebunan',[PerkebunanController::class,'store'])->name('perkebunan.store'); //simpan perkebunan
    Route::get('edit-perkebunan/{id}/edit', [PerkebunanController::class, 'edit'])->name('perkebunan.edit'); //edit perkebunan
    Route::put('update-perkebunan/{id}', [PerkebunanController::class, 'update'])->name('perkebunan.update'); //update perkebunan
    Route::delete('perkebunan/{id}', [PerkebunanController::class, 'destroy'])->name('perkebunan.destroy'); //hapus perkebunan

});