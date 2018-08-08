<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Model\tipe_kegiatan;
use App\Model\peneliti_psb;
use App\Model\peserta_kegiatan;
use App\Model\peserta_publikasi_jurnal;
use App\Model\peserta_publikasi_buku;
use App\User;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        Schema::defaultStringLength(191);
        View::composer('peneliti.menu',function($view){
            $tipekegiatans = tipe_kegiatan::all();
            $view->with('tipekegiatans',$tipekegiatans);
        });

        View::composer('peneliti.menu',function($view){
            $id_pegawai = auth::user()->id_pegawai;
            $peneliti = peneliti_psb::where('id_pegawai',$id_pegawai)->first();
            $id_peneliti = $peneliti->id_peneliti;
            $pesertas = peserta_kegiatan::where([['id_peneliti', $id_peneliti],['status_konfirm','setuju']])->get();
            $today = strtotime(now());
            foreach ($pesertas as $key => $peserta) {
                $tanggal[] = strtotime($peserta->kegiatan->tanggal_akhir);
                if($tanggal[$key] >= $today){
                    $kegiatans[] = $peserta->kegiatan;
                }
            }
            if(!isset($kegiatans)){
                $kegiatans=null;
            }

            $view->with('kegiatans',$kegiatans);
        });

        View::composer('peneliti.navbar',function($view){
            $id_pegawais = auth::user()->id_pegawai;
            $peneliti_psb = peneliti_psb::where('id_pegawai',$id_pegawais)->first();
            $id_penelitis = $peneliti_psb->id_peneliti;
            $peserta_kegiatans = peserta_kegiatan::where([['status_konfirm', 'menunggu'],['id_peneliti',$id_penelitis]])->get();
            $peserta_pubjurnals = peserta_publikasi_jurnal::where([['status_konfirm', 'menunggu'],['id_peneliti',$id_penelitis]])->get();
            $peserta_pubbukus = peserta_publikasi_buku::where([['status_konfirm', 'menunggu'],['id_peneliti',$id_penelitis]])->get();
            $countpeserta_kegiatan = $peserta_kegiatans->count();
            $countpeserta_pubjurnal = $peserta_pubjurnals->count();
            $countpeserta_pubbuku = $peserta_pubbukus->count();

            if($countpeserta_kegiatan==0){
                $kegiatans = 0;
            }
            else {
                foreach ($peserta_kegiatans as $peserta_kegiatan) {
                    $kegiatans[] = $peserta_kegiatan->kegiatan;
                }  
            }

            if($countpeserta_pubbuku==0){
                $bukus = 0;
            }
            else {
                foreach ($peserta_pubbukus as $peserta_pubbuku) {
                    $bukus[] = $peserta_pubbuku->publikasi_buku;
                }  
            }

            if($countpeserta_pubjurnal==0){
                $jurnals = 0;
            }
            else {
                foreach ($peserta_pubjurnals as $peserta_pubjurnal) {
                    $jurnals[] = $peserta_pubjurnal->publikasi_jurnal;
                }  
            }

            

            $notif = $countpeserta_kegiatan + $countpeserta_pubjurnal + $countpeserta_pubbuku;

            $view->with(['kegiatans'=>$kegiatans, 'jurnals'=>$jurnals, 'bukus'=>$bukus, 'notif'=>$notif]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
