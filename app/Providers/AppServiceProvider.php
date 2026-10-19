<?php

namespace App\Providers;

use App\Models\Suratpengadu;
use App\Models\Suratpengantar;
use App\Models\Suratket;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot()
    {
        if (app()->environment('local') && request()->getHost() !== '127.0.0.1' && request()->getHost() !== 'localhost') {
        URL::forceScheme('https');
        }

        View::composer('components.navbar-admin', function ($view) {
            // Ambil data status Diproses
            $suratpengantar = Suratpengantar::where('status', 'Diproses')->get();
            $suratket       = Suratket::where('status', 'Diproses')->get();
            $suratpengadu   = Suratpengadu::where('status', 'Diproses')->get();

            // Hitung total notifikasi
            $totalNotifikasi = $suratpengantar->count()
                             + $suratket->count()
                             + $suratpengadu->count();

            // Tambahkan properti extra langsung ke model (biar bisa akses pakai ->)
            $suratpengantarList = $suratpengantar->map(function ($item) {
                $item->keterangan = $item->jen_surat;
                $item->route = route('suratpengantar.show', $item->id);
                return $item;
            });

            $suratketList = $suratket->map(function ($item) {
                $item->keterangan = $item->jen_surat;
                $item->route = route('suratket.show', $item->id);
                return $item;
            });

            $suratpengaduList = $suratpengadu->map(function ($item) {
                $item->keterangan = $item->perihal;
                $item->route = route('suratpengadu.show', $item->id);
                return $item;
            });

            // Gabungkan semua list
            $notifikasiList = $suratpengantarList
                ->merge($suratketList)
                ->merge($suratpengaduList);

            // Share ke view
            $view->with([
                'totalNotifikasi' => $totalNotifikasi,
                'notifikasiList'  => $notifikasiList,
            ]);
        });
    }
}