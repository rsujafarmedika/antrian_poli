<?php

namespace App\Http\Controllers;

use App\Models\AntrianSore;
use App\Models\RegPeriksa;
use App\Models\Pasien;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AntrianSoreController extends Controller
{
    function antriansore() {
        $data0='';

        $c_bed1 = AntrianSore::where('bed','=','1')
            ->where('status','=','Belum')
            ->count();
        $c_bed2 = AntrianSore::where('bed','=','2')
            ->where('status','=','Belum')
            ->count();
        $c_bed3 = AntrianSore::where('bed','=','3')
            ->where('status','=','Belum')
            ->count();
        $c_bed4 = AntrianSore::where('bed','=','4')
            ->where('status','=','Belum')
            ->count();
        $c_bed5 = AntrianSore::where('bed','=','5')
            ->where('status','=','Belum')
            ->count();

        $bed1 = AntrianSore::where('bed','=','1')
            ->where('status','=','Belum')
            ->first();
        $bed2 = AntrianSore::where('bed','=','2')
            ->where('status','=','Belum')
            ->first();
        $bed3 = AntrianSore::where('bed','=','3')
            ->where('status','=','Belum')
            ->first();
        $bed4 = AntrianSore::where('bed','=','4')
            ->where('status','=','Belum')
            ->first();
        $bed5 = AntrianSore::where('bed','=','5')
            ->where('status','=','Belum')
            ->first();

        $get_skip = AntrianSore::where('status','=','Tunda')->get();

        $now = date('Y-m-d');
        $reg = RegPeriksa::select(
                'no_rawat',
                'reg_periksa.no_rkm_medis',
                'dokter.nm_dokter',
                'nm_pasien',
                'no_reg'
            )
            ->join('dokter','reg_periksa.kd_dokter','=','dokter.kd_dokter')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->where('reg_periksa.kd_dokter','=','20020111001')
            ->where('kd_poli','=','U0037')
            ->where('tgl_registrasi','=',$now)
            ->get();

        return view('antriansore.index', compact('c_bed1','bed1','c_bed2','bed2','c_bed3','bed3','c_bed4','bed4','c_bed5','bed5','data0','get_skip','reg'));
    }

// Next Sore
function nexts1() {
    $now = date('Y-m-d');
    $cek_antrian = AntrianSore::max('no_reg');
    $cek_reg = RegPeriksa::
        where('kd_dokter','=','20020111001')
        ->where('kd_poli','=','U0037')
        ->where('tgl_registrasi','=',$now)
        ->max('no_reg');

    if ($cek_reg==$cek_antrian) {
        return back()->with('habis', 'Semua Pasien Sudah Dilayani');
    } else {
        $c_belum = AntrianSore::where('bed','=',1)->where('status','=','Belum')->count();

        if ($c_belum!=0) {
            $antrian = AntrianSore::where('bed','=','1')
                ->where('status','=','Belum')
                ->update(['status' => 'Selesai']);

            $max_antrian = AntrianSore::max('no_reg');

            $nextId = $max_antrian + 1;
            $hasil = str_pad($nextId, 3, '0', STR_PAD_LEFT);

            $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                ->where('no_reg','=',$hasil)
                ->where('kd_dokter','=','20020111001')
                ->where('kd_poli','=','U0037')
                ->where('tgl_registrasi','=',$now)
                ->first();

            $antrian = new AntrianSore();
            $antrian->no_rawat = $reg['no_rawat'];
            $antrian->no_rkm_medis = $reg['no_rkm_medis'];
            $antrian->nm_pasien = $reg['nm_pasien'];
            $antrian->no_reg = $reg['no_reg'];
            $antrian->bed = 1;
            $antrian->status = "Belum";
            $antrian->save();

            return back();
        } else {
            $c_antrian = AntrianSore::get()->count();
            $max_antrian = AntrianSore::max('no_reg');
            $urutan = (int) substr($max_antrian, 2, 2);
            $urutan++;
            $hasil = sprintf("%03s", $urutan);

            if ($c_antrian==0) {
                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=','001')
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0037')
                    ->where('tgl_registrasi','=',$now)
                    ->first();
            } else {
                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0037')
                    ->where('tgl_registrasi','=',$now)
                    ->first();
            }

            $antrian = new AntrianSore();
            $antrian->no_rawat = $reg['no_rawat'];
            $antrian->no_rkm_medis = $reg['no_rkm_medis'];
            $antrian->nm_pasien = $reg['nm_pasien'];
            $antrian->no_reg = $reg['no_reg'];
            $antrian->bed = 1;
            $antrian->status = "Belum";
            $antrian->save();

            return back();
        }
    }
}

function nexts2() {
    $now = date('Y-m-d');

    $cek_antrian = AntrianSore::max('no_reg');
    $cek_reg = RegPeriksa::
        where('kd_dokter','=','20020111001')
        ->where('kd_poli','=','U0037')
        ->where('tgl_registrasi','=',$now)
        ->max('no_reg');

    if ($cek_reg==$cek_antrian) {
        return back()->with('habis', 'Semua Pasien Sudah Dilayani');
    } else {
        $c_belum = AntrianSore::where('bed','=',2)->where('status','=','Belum')->count();

        if ($c_belum!=null) {
            $antrian = AntrianSore::where('bed','=','2')
                ->where('status','=','Belum')
                ->update(['status' => 'Selesai']);

            $max_antrian = AntrianSore::max('no_reg');

            $nextId = $max_antrian + 1;
            $hasil = str_pad($nextId, 3, '0', STR_PAD_LEFT);

            $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                ->where('no_reg','=',$hasil)
                ->where('kd_dokter','=','20020111001')
                ->where('kd_poli','=','U0037')
                ->where('tgl_registrasi','=',$now)
                ->first();

            $antrian = new AntrianSore();
            $antrian->no_rawat = $reg['no_rawat'];
            $antrian->no_rkm_medis = $reg['no_rkm_medis'];
            $antrian->nm_pasien = $reg['nm_pasien'];
            $antrian->no_reg = $reg['no_reg'];
            $antrian->bed = 2;
            $antrian->status = "Belum";
            $antrian->save();

            return back();
        } else {
            $c_antrian = AntrianSore::get()->count();
            $max_antrian = AntrianSore::max('no_reg');
            $urutan = (int) substr($max_antrian, 2, 2);
            $urutan++;
            $hasil = sprintf("%03s", $urutan);

            if ($c_antrian==0) {
                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=','001')
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0037')
                    ->where('tgl_registrasi','=',$now)
                    ->first();
            } else {
                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0037')
                    ->where('tgl_registrasi','=',$now)
                    ->first();
            }

            $antrian = new AntrianSore();
            $antrian->no_rawat = $reg['no_rawat'];
            $antrian->no_rkm_medis = $reg['no_rkm_medis'];
            $antrian->nm_pasien = $reg['nm_pasien'];
            $antrian->no_reg = $reg['no_reg'];
            $antrian->bed = 2;
            $antrian->status = "Belum";
            $antrian->save();

            return back();
        }
    }
}

function nexts3() {
    $now = date('Y-m-d');

    $cek_antrian = AntrianSore::max('no_reg');
    $cek_reg = RegPeriksa::
        where('kd_dokter','=','20020111001')
        ->where('kd_poli','=','U0037')
        ->where('tgl_registrasi','=',$now)
        ->max('no_reg');

    if ($cek_reg==$cek_antrian) {
        return back()->with('habis', 'Semua Pasien Sudah Dilayani');
    } else {
        $c_belum = AntrianSore::where('bed','=',3)->where('status','=','Belum')->count();

        if ($c_belum!=null) {
            $antrian = AntrianSore::where('bed','=','3')
                ->where('status','=','Belum')
                ->update(['status' => 'Selesai']);

            $max_antrian = AntrianSore::max('no_reg');

            $nextId = $max_antrian + 1;
            $hasil = str_pad($nextId, 3, '0', STR_PAD_LEFT);

            $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                ->where('no_reg','=',$hasil)
                ->where('kd_dokter','=','20020111001')
                ->where('kd_poli','=','U0037')
                ->where('tgl_registrasi','=',$now)
                ->first();

            $antrian = new AntrianSore();
            $antrian->no_rawat = $reg['no_rawat'];
            $antrian->no_rkm_medis = $reg['no_rkm_medis'];
            $antrian->nm_pasien = $reg['nm_pasien'];
            $antrian->no_reg = $reg['no_reg'];
            $antrian->bed = 3;
            $antrian->status = "Belum";
            $antrian->save();

            return back();
        } else {
            $c_antrian = AntrianSore::get()->count();
            $max_antrian = AntrianSore::max('no_reg');
            $urutan = (int) substr($max_antrian, 2, 2);
            $urutan++;
            $hasil = sprintf("%03s", $urutan);

            if ($c_antrian==0) {
                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=','001')
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0037')
                    ->where('tgl_registrasi','=',$now)
                    ->first();
            } else {
                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0037')
                    ->where('tgl_registrasi','=',$now)
                    ->first();
            }

            $antrian = new AntrianSore();
            $antrian->no_rawat = $reg['no_rawat'];
            $antrian->no_rkm_medis = $reg['no_rkm_medis'];
            $antrian->nm_pasien = $reg['nm_pasien'];
            $antrian->no_reg = $reg['no_reg'];
            $antrian->bed = 3;
            $antrian->status = "Belum";
            $antrian->save();

            return back();
        }
    }
}

function nexts4() {
    $now = date('Y-m-d');

    $cek_antrian = AntrianSore::max('no_reg');
    $cek_reg = RegPeriksa::
        where('kd_dokter','=','20020111001')
        ->where('kd_poli','=','U0037')
        ->where('tgl_registrasi','=',$now)
        ->max('no_reg');

    if ($cek_reg==$cek_antrian) {
        return back()->with('habis', 'Semua Pasien Sudah Dilayani');
    } else {
        $c_belum = AntrianSore::where('bed','=',4)->where('status','=','Belum')->count();

        if ($c_belum!=null) {
            $antrian = AntrianSore::where('bed','=','4')
                ->where('status','=','Belum')
                ->update(['status' => 'Selesai']);

            $max_antrian = AntrianSore::max('no_reg');

            $nextId = $max_antrian + 1;
            $hasil = str_pad($nextId, 3, '0', STR_PAD_LEFT);

            $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                ->where('no_reg','=',$hasil)
                ->where('kd_dokter','=','20020111001')
                ->where('kd_poli','=','U0037')
                ->where('tgl_registrasi','=',$now)
                ->first();

            $antrian = new AntrianSore();
            $antrian->no_rawat = $reg['no_rawat'];
            $antrian->no_rkm_medis = $reg['no_rkm_medis'];
            $antrian->nm_pasien = $reg['nm_pasien'];
            $antrian->no_reg = $reg['no_reg'];
            $antrian->bed = 4;
            $antrian->status = "Belum";
            $antrian->save();

            return back();
        } else {
            $c_antrian = AntrianSore::get()->count();
            $max_antrian = AntrianSore::max('no_reg');
            $urutan = (int) substr($max_antrian, 2, 2);
            $urutan++;
            $hasil = sprintf("%03s", $urutan);

            if ($c_antrian==0) {
                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=','001')
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0037')
                    ->where('tgl_registrasi','=',$now)
                    ->first();
            } else {
                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0037')
                    ->where('tgl_registrasi','=',$now)
                    ->first();
            }

            $antrian = new AntrianSore();
            $antrian->no_rawat = $reg['no_rawat'];
            $antrian->no_rkm_medis = $reg['no_rkm_medis'];
            $antrian->nm_pasien = $reg['nm_pasien'];
            $antrian->no_reg = $reg['no_reg'];
            $antrian->bed = 4;
            $antrian->status = "Belum";
            $antrian->save();

            return back();
        }
    }
}

function nexts5() {
    $now = date('Y-m-d');

    $cek_antrian = AntrianSore::max('no_reg');
    $cek_reg = RegPeriksa::
        where('kd_dokter','=','20020111001')
        ->where('kd_poli','=','U0037')
        ->where('tgl_registrasi','=',$now)
        ->max('no_reg');

    if ($cek_reg==$cek_antrian) {
        return back()->with('habis', 'Semua Pasien Sudah Dilayani');
    } else {
        $c_belum = AntrianSore::where('bed','=',5)->where('status','=','Belum')->count();

        if ($c_belum!=null) {
            $antrian = AntrianSore::where('bed','=','5')
                ->where('status','=','Belum')
                ->update(['status' => 'Selesai']);

            $max_antrian = AntrianSore::max('no_reg');

            $nextId = $max_antrian + 1;
            $hasil = str_pad($nextId, 3, '0', STR_PAD_LEFT);

            $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                ->where('no_reg','=',$hasil)
                ->where('kd_dokter','=','20020111001')
                ->where('kd_poli','=','U0037')
                ->where('tgl_registrasi','=',$now)
                ->first();

            $antrian = new AntrianSore();
            $antrian->no_rawat = $reg['no_rawat'];
            $antrian->no_rkm_medis = $reg['no_rkm_medis'];
            $antrian->nm_pasien = $reg['nm_pasien'];
            $antrian->no_reg = $reg['no_reg'];
            $antrian->bed = 5;
            $antrian->status = "Belum";
            $antrian->save();

            return back();
        } else {
            $c_antrian = AntrianSore::get()->count();
            $max_antrian = AntrianSore::max('no_reg');
            $urutan = (int) substr($max_antrian, 2, 2);
            $urutan++;
            $hasil = sprintf("%03s", $urutan);

            if ($c_antrian==0) {
                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=','001')
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0037')
                    ->where('tgl_registrasi','=',$now)
                    ->first();
            } else {
                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0037')
                    ->where('tgl_registrasi','=',$now)
                    ->first();
            }

            $antrian = new AntrianSore();
            $antrian->no_rawat = $reg['no_rawat'];
            $antrian->no_rkm_medis = $reg['no_rkm_medis'];
            $antrian->nm_pasien = $reg['nm_pasien'];
            $antrian->no_reg = $reg['no_reg'];
            $antrian->bed = 5;
            $antrian->status = "Belum";
            $antrian->save();

            return back();
        }
    }
}


    // function call1(Request $request) {
    //     $bed1 = AntrianSore::where('bed','=','1')
    //         ->where('status','=','Belum')
    //         ->first();
            
    //     return redirect()->route('AntrianSore')->with( ['bed1' => $bed1] );
    // }

    // function call2(Request $request) {
    //     $bed2 = AntrianSore::where('bed','=','2')
    //         ->where('status','=','Belum')
    //         ->first();
            
    //     return redirect()->route('AntrianSore')->with( ['bed2' => $bed2] );
    // }

    function skips1() {
        $now = date('Y-m-d');
        $cek_antrian = AntrianSore::max('no_reg');
        $cek_reg = RegPeriksa::
            where('kd_dokter','=','20020111001')
            ->where('kd_poli','=','U0037')
            ->where('tgl_registrasi','=',$now)
            ->max('no_reg');
    
        if ($cek_reg==$cek_antrian) {
            return back()->with('habis', 'Semua Pasien Sudah Dilayani');
        } else {
            $c_AntrianSore = AntrianSore::where('bed','=','1')->count();

            if ($c_AntrianSore==0) {
                return back()->with('kosong', 'Maaf Belum ada Pasien di BED 1, Silahkan KLIK Tombol Selanjutnya !!');
            } else {
                $AntrianSore = AntrianSore::where('bed','=','1')
                    ->where('status','=','Belum')
                    ->update(['status' => 'Tunda']);

                $max_AntrianSore = AntrianSore::max('no_reg');
                $urutan = (int) substr($max_AntrianSore, 2, 2);
                $urutan++;
                $hasil = sprintf("%03s", $urutan);

                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0037')
                    // ->where('tgl_registrasi','=','2024-02-03')
                    ->where('tgl_registrasi','=',$now)
                    ->first();

                $AntrianSore = new AntrianSore();
                $AntrianSore->no_rawat = $reg['no_rawat'];
                $AntrianSore->no_rkm_medis = $reg['no_rkm_medis'];
                $AntrianSore->nm_pasien = $reg['nm_pasien'];
                $AntrianSore->no_reg = $reg['no_reg'];
                $AntrianSore->bed = 1;
                $AntrianSore->status = "Belum";
                $AntrianSore->save();

                return back();
            }
        }
    }

    function skips2() {
        $now = date('Y-m-d');
        $cek_antrian = AntrianSore::max('no_reg');
        $cek_reg = RegPeriksa::
            where('kd_dokter','=','20020111001')
            ->where('kd_poli','=','U0037')
            ->where('tgl_registrasi','=',$now)
            ->max('no_reg');
    
        if ($cek_reg==$cek_antrian) {
            return back()->with('habis', 'Semua Pasien Sudah Dilayani');
        } else {
            $c_AntrianSore = AntrianSore::where('bed','=','2')->count();

            if ($c_AntrianSore==0) {
                return back()->with('kosong', 'Maaf Belum ada Pasien di BED 2, Silahkan KLIK Tombol Selanjutnya !!');
            } else {
                $AntrianSore = AntrianSore::where('bed','=','2')
                    ->where('status','=','Belum')
                    ->update(['status' => 'Tunda']);

                $max_AntrianSore = AntrianSore::max('no_reg');
                $urutan = (int) substr($max_AntrianSore, 2, 2);
                $urutan++;
                $hasil = sprintf("%03s", $urutan);

                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0037')
                    // ->where('tgl_registrasi','=','2024-02-03')
                    ->where('tgl_registrasi','=',$now)
                    ->first();

                $AntrianSore = new AntrianSore();
                $AntrianSore->no_rawat = $reg['no_rawat'];
                $AntrianSore->no_rkm_medis = $reg['no_rkm_medis'];
                $AntrianSore->nm_pasien = $reg['nm_pasien'];
                $AntrianSore->no_reg = $reg['no_reg'];
                $AntrianSore->bed = 2;
                $AntrianSore->status = "Belum";
                $AntrianSore->save();

                return back();
            }
        }
    }

    function skips3() {
        $now = date('Y-m-d');
        $cek_antrian = AntrianSore::max('no_reg');
        $cek_reg = RegPeriksa::
            where('kd_dokter','=','20020111001')
            ->where('kd_poli','=','U0037')
            ->where('tgl_registrasi','=',$now)
            ->max('no_reg');
    
        if ($cek_reg==$cek_antrian) {
            return back()->with('habis', 'Semua Pasien Sudah Dilayani');
        } else {
            $c_AntrianSore = AntrianSore::where('bed','=','3')->count();

            if ($c_AntrianSore==0) {
                return back()->with('kosong', 'Maaf Belum ada Pasien di BED 3, Silahkan KLIK Tombol Selanjutnya !!');
            } else {
                $AntrianSore = AntrianSore::where('bed','=','3')
                    ->where('status','=','Belum')
                    ->update(['status' => 'Tunda']);

                $max_AntrianSore = AntrianSore::max('no_reg');
                $urutan = (int) substr($max_AntrianSore, 2, 2);
                $urutan++;
                $hasil = sprintf("%03s", $urutan);

                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0037')
                    // ->where('tgl_registrasi','=','2024-02-03')
                    ->where('tgl_registrasi','=',$now)
                    ->first();

                $AntrianSore = new AntrianSore();
                $AntrianSore->no_rawat = $reg['no_rawat'];
                $AntrianSore->no_rkm_medis = $reg['no_rkm_medis'];
                $AntrianSore->nm_pasien = $reg['nm_pasien'];
                $AntrianSore->no_reg = $reg['no_reg'];
                $AntrianSore->bed = 3;
                $AntrianSore->status = "Belum";
                $AntrianSore->save();

                return back();
            }
        }
    }

    function skips4() {
        $now = date('Y-m-d');
        $cek_antrian = AntrianSore::max('no_reg');
        $cek_reg = RegPeriksa::
            where('kd_dokter','=','20020111001')
            ->where('kd_poli','=','U0037')
            ->where('tgl_registrasi','=',$now)
            ->max('no_reg');
    
        if ($cek_reg==$cek_antrian) {
            return back()->with('habis', 'Semua Pasien Sudah Dilayani');
        } else {
            $c_AntrianSore = AntrianSore::where('bed','=','4')->count();

            if ($c_AntrianSore==0) {
                return back()->with('kosong', 'Maaf Belum ada Pasien di BED 4, Silahkan KLIK Tombol Selanjutnya !!');
            } else {
                $AntrianSore = AntrianSore::where('bed','=','4')
                    ->where('status','=','Belum')
                    ->update(['status' => 'Tunda']);

                $max_AntrianSore = AntrianSore::max('no_reg');
                $urutan = (int) substr($max_AntrianSore, 2, 2);
                $urutan++;
                $hasil = sprintf("%03s", $urutan);

                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0037')
                    // ->where('tgl_registrasi','=','2024-02-03')
                    ->where('tgl_registrasi','=',$now)
                    ->first();

                $AntrianSore = new AntrianSore();
                $AntrianSore->no_rawat = $reg['no_rawat'];
                $AntrianSore->no_rkm_medis = $reg['no_rkm_medis'];
                $AntrianSore->nm_pasien = $reg['nm_pasien'];
                $AntrianSore->no_reg = $reg['no_reg'];
                $AntrianSore->bed = 4;
                $AntrianSore->status = "Belum";
                $AntrianSore->save();

                return back();
            }
        }
    }

    function skips5() {
        $now = date('Y-m-d');
        $cek_antrian = AntrianSore::max('no_reg');
        $cek_reg = RegPeriksa::
            where('kd_dokter','=','20020111001')
            ->where('kd_poli','=','U0037')
            ->where('tgl_registrasi','=',$now)
            ->max('no_reg');
    
        if ($cek_reg==$cek_antrian) {
            return back()->with('habis', 'Semua Pasien Sudah Dilayani');
        } else {
            $c_AntrianSore = AntrianSore::where('bed','=','5')->count();

            if ($c_AntrianSore==0) {
                return back()->with('kosong', 'Maaf Belum ada Pasien di BED 5, Silahkan KLIK Tombol Selanjutnya !!');
            } else {
                $AntrianSore = AntrianSore::where('bed','=','5')
                    ->where('status','=','Belum')
                    ->update(['status' => 'Tunda']);

                $max_AntrianSore = AntrianSore::max('no_reg');
                $urutan = (int) substr($max_AntrianSore, 2, 2);
                $urutan++;
                $hasil = sprintf("%03s", $urutan);

                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0037')
                    // ->where('tgl_registrasi','=','2024-02-03')
                    ->where('tgl_registrasi','=',$now)
                    ->first();

                $AntrianSore = new AntrianSore();
                $AntrianSore->no_rawat = $reg['no_rawat'];
                $AntrianSore->no_rkm_medis = $reg['no_rkm_medis'];
                $AntrianSore->nm_pasien = $reg['nm_pasien'];
                $AntrianSore->no_reg = $reg['no_reg'];
                $AntrianSore->bed = 5;
                $AntrianSore->status = "Belum";
                $AntrianSore->save();

                return back();
            }
        }
    }

    function pKhusus(Request $request) {
        $now = date('Y-m-d');
        $get_khusus = RegPeriksa::
            join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            // join('antrian_akupuntur.antrian as ant', 'reg_periksa.no_rawat', '=', 'ant.no_rawat')
            ->where('kd_dokter','=','20020111001')
            ->where('kd_poli','=','U0037')
            ->where('tgl_registrasi','=',$now)
            ->get();
        // $khusus = Antrian::where('status','!=','Sudah');

        return view('antriansore.khusus', compact('get_khusus'));
    }

    function PLewatiSore() {
        $data0='';

        $c_bed1 = AntrianSore::where('bed','=','1')
            ->where('status','=','Belum')
            ->count();
        $c_bed2 = AntrianSore::where('bed','=','2')
            ->where('status','=','Belum')
            ->count();
        $c_bed3 = AntrianSore::where('bed','=','3')
            ->where('status','=','Belum')
            ->count();
        $c_bed4 = AntrianSore::where('bed','=','4')
            ->where('status','=','Belum')
            ->count();
        $c_bed5 = AntrianSore::where('bed','=','5')
            ->where('status','=','Belum')
            ->count();

        $bed1 = AntrianSore::where('bed','=','1')
            ->where('status','=','Belum')
            ->first();
        $bed2 = AntrianSore::where('bed','=','2')
            ->where('status','=','Belum')
            ->first();
        $bed3 = AntrianSore::where('bed','=','3')
            ->where('status','=','Belum')
            ->first();
        $bed4 = AntrianSore::where('bed','=','4')
            ->where('status','=','Belum')
            ->first();
        $bed5 = AntrianSore::where('bed','=','5')
            ->where('status','=','Belum')
            ->first();

        $get_skip = AntrianSore::where('status','=','Tunda')->get();

        $now = date('Y-m-d');
        $reg = RegPeriksa::select(
                'no_rawat',
                'reg_periksa.no_rkm_medis',
                'dokter.nm_dokter',
                'nm_pasien',
                'no_reg'
             )
            ->join('dokter','reg_periksa.kd_dokter','=','dokter.kd_dokter')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->where('reg_periksa.kd_dokter','=','20020111001')
            ->where('tgl_registrasi','=',$now)
            ->get();

        return view('antriansore.skip2', compact('c_bed1','bed1','c_bed2','bed2','c_bed3','bed3','c_bed4','bed4','c_bed5','bed5','data0','get_skip','reg'));
    }
    
    function PSelesai(Request $request) {
        $get_no_rawat = $request['no_rawat'];
        $selesai = AntrianSore::where('no_rawat','=',$get_no_rawat)
                ->where('status','=','Tunda')
                ->update(['status' => 'Selesai']);

        return back();
    }

}
