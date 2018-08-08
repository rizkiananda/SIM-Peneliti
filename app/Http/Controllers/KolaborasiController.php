<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\kegiatan;
use App\Model\publikasi_jurnal;
use App\Model\publikasi_buku;
use App\Model\peneliti_psb;
use App\Model\peserta_kegiatan;
use App\Model\peserta_publikasi_jurnal;
use App\Model\peserta_publikasi_buku;
use App\Model\berkas;
use App\User;
use Auth;

class KolaborasiController extends Controller
{
     public function getKolaborasi($id){
    	// $kolaborasi = kegiatan::find($id);
    	$kegiatan = kegiatan::join('tipe_kegiatan', 'kegiatan.id_tipe_kegiatan', '=', 'tipe_kegiatan.id')
   					->where('kegiatan.id', $id)
   					->first();
        $berkas = berkas::where('id_kegiatan', $id)->first();
        $pubjurnal = publikasi_jurnal::where('id', $id)->first();
        $pubbuku = publikasi_buku::where('id', $id)->first();
    	return ['kegiatan'=>$kegiatan, 'berkas'=>$berkas, 'pubjurnal'=>$pubjurnal, 'pubbuku'=>$pubbuku];

    }

     public function setujukegiatan(Request $request){
    	$id_kegiatan = $request['kegiatan_id'];
    	$id_pegawai = auth::user()->id_pegawai;
        $peneliti_psb = peneliti_psb::where('id_pegawai',$id_pegawai)->first();
        $id_peneliti = $peneliti_psb->peneliti->id;
    	peserta_kegiatan::where([['id_kegiatan',$id_kegiatan],['id_peneliti',$id_peneliti]])->update([
    		'status_konfirm'=>'setuju'
    	]);
    	$notification = array('title'=> 'Berhasil!','msg'=>'Anda telah menyetujui kolaborasi!','alert-type'=>'success');
		return redirect('/')->with($notification);
    }

    public function menolakkegiatan(Request $request){
    	$id_kegiatan = $request['id_kegiatan'];
    	$id_pegawai = auth::user()->id_pegawai;
        $peneliti_psb = peneliti_psb::where('id_pegawai',$id_pegawai)->first();
        $id_peneliti = $peneliti_psb->peneliti->id;
    	peserta_kegiatan::where([['id_kegiatan',$id_kegiatan],['id_peneliti',$id_peneliti]])->update([
    		'status_konfirm'=>'menolak'
    	]);
    	$notification = array('title'=> 'Berhasil!','msg'=>'Anda telah menolak kolaborasi!','alert-type'=>'success');
		return redirect('/')->with($notification);
    }

    public function setujupubjurnal(Request $request){
        $id_pubjurnal = $request['pubjurnal_id'];
        $id_pegawai = auth::user()->id_pegawai;
        $peneliti_psb = peneliti_psb::where('id_pegawai',$id_pegawai)->first();
        $id_peneliti = $peneliti_psb->peneliti->id;
        peserta_publikasi_jurnal::where([['id_publikasi_jurnal',$id_pubjurnal],['id_peneliti',$id_peneliti]])->update([
            'status_konfirm'=>'setuju'
        ]);
        $notification = array('title'=> 'Berhasil!','msg'=>'Anda telah menyetujui kolaborasi!','alert-type'=>'success');
        return redirect('/')->with($notification);
    }

    public function menolakpubjurnal(Request $request){
        $id_pubjurnal = $request['id_pubjurnal'];
        $id_pegawai = auth::user()->id_pegawai;
        $peneliti_psb = peneliti_psb::where('id_pegawai',$id_pegawai)->first();
        $id_peneliti = $peneliti_psb->peneliti->id;
        peserta_publikasi_jurnal::where([['id_publikasi_jurnal',$id_pubjurnal],['id_peneliti',$id_peneliti]])->update([
            'status_konfirm'=>'menolak'
        ]);
        $notification = array('title'=> 'Berhasil!','msg'=>'Anda telah menolak kolaborasi!','alert-type'=>'success');
        return redirect('/')->with($notification);
    }

    public function setujupubbuku(Request $request){
        $id_pubbuku = $request['pubbuku_id'];
        $id_pegawai = auth::user()->id_pegawai;
        $peneliti_psb = peneliti_psb::where('id_pegawai',$id_pegawai)->first();
        $id_peneliti = $peneliti_psb->peneliti->id;
        peserta_publikasi_buku::where([['id_publikasi_buku',$id_pubbuku],['id_peneliti',$id_peneliti]])->update([
            'status_konfirm'=>'setuju'
        ]);
        $notification = array('title'=> 'Berhasil!','msg'=>'Anda telah menyetujui kolaborasi!','alert-type'=>'success');
        return redirect('/')->with($notification);
    }

    public function menolakpubbuku(Request $request){
        $id_pubbuku = $request['id_pubbuku'];
        $id_pegawai = auth::user()->id_pegawai;
        $peneliti_psb = peneliti_psb::where('id_pegawai',$id_pegawai)->first();
        $id_peneliti = $peneliti_psb->peneliti->id;
        peserta_publikasi_buku::where([['id_publikasi_buku',$id_pubbuku],['id_peneliti',$id_peneliti]])->update([
            'status_konfirm'=>'menolak'
        ]);
        $notification = array('title'=> 'Berhasil!','msg'=>'Anda telah menolak kolaborasi!','alert-type'=>'success');
        return redirect('/')->with($notification);
    }
}
