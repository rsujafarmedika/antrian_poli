<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\AntrianSore;
use App\Models\RegPeriksa;
use App\Models\Pasien;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    function antrian() {
        $data0='';

        $c_bed1 = Antrian::where('bed','=','1')
            ->where('status','=','Belum')
            ->count();
        $c_bed2 = Antrian::where('bed','=','2')
            ->where('status','=','Belum')
            ->count();
        $c_bed3 = Antrian::where('bed','=','3')
            ->where('status','=','Belum')
            ->count();
        $c_bed4 = Antrian::where('bed','=','4')
            ->where('status','=','Belum')
            ->count();
        $c_bed5 = Antrian::where('bed','=','5')
            ->where('status','=','Belum')
            ->count();

        $bed1 = Antrian::where('bed','=','1')
            ->where('status','=','Belum')
            ->first();
        $bed2 = Antrian::where('bed','=','2')
            ->where('status','=','Belum')
            ->first();
        $bed3 = Antrian::where('bed','=','3')
            ->where('status','=','Belum')
            ->first();
        $bed4 = Antrian::where('bed','=','4')
            ->where('status','=','Belum')
            ->first();
        $bed5 = Antrian::where('bed','=','5')
            ->where('status','=','Belum')
            ->first();

        $get_skip = Antrian::where('status','=','Tunda')->get();

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
            ->where('reg_periksa.kd_poli','=','U0027')
            ->where('tgl_registrasi','=',$now)
            ->get();

        return view('antrian.index', compact('c_bed1','bed1','c_bed2','bed2','c_bed3','bed3','c_bed4','bed4','c_bed5','bed5','data0','get_skip','reg'));
    }

    // Next Pagi
    function next1() {
        $now = date('Y-m-d');
        $cek_antrian = Antrian::max('no_reg');
        $cek_reg = RegPeriksa::
            where('kd_dokter','=','20020111001')
            // ->where('tgl_registrasi','=','2024-02-03')
            ->where('tgl_registrasi','=',$now)
            ->max('no_reg');

        if ($cek_reg==$cek_antrian) {
            return back()->with('habis', 'Semua Pasien Sudah Dilayani');
        } else {
            $c_belum = Antrian::where('bed','=',1)->where('status','=','Belum')->count();

            if ($c_belum!=0) {
                $antrian = Antrian::where('bed','=','1')
                    ->where('status','=','Belum')
                    ->update(['status' => 'Selesai']);

                $max_antrian = Antrian::max('no_reg');

                $nextId = $max_antrian + 1;
                $hasil = str_pad($nextId, 3, '0', STR_PAD_LEFT);

                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0027')
                    // ->where('tgl_registrasi','=','2024-02-03')
                    ->where('tgl_registrasi','=',$now)
                    ->first();

                $antrian = new Antrian();
                $antrian->no_rawat = $reg['no_rawat'];
                $antrian->no_rkm_medis = $reg['no_rkm_medis'];
                $antrian->nm_pasien = $reg['nm_pasien'];
                $antrian->no_reg = $reg['no_reg'];
                $antrian->bed = 1;
                $antrian->status = "Belum";
                $antrian->save();

                return back();
            } else {
                $c_antrian = Antrian::get()->count();
                $max_antrian = Antrian::max('no_reg');
                $urutan = (int) substr($max_antrian, 2, 2);
                $urutan++;
                $hasil = sprintf("%03s", $urutan);

                if ($c_antrian==0) {
                    $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                        ->where('no_reg','=','001')
                        ->where('kd_dokter','=','20020111001')
                        ->where('kd_poli','=','U0027')
                        // ->where('tgl_registrasi','=','2024-02-03')
                        ->where('tgl_registrasi','=',$now)
                        ->first();
                } else {
                    $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                        ->where('no_reg','=',$hasil)
                        ->where('kd_dokter','=','20020111001')
                        ->where('kd_poli','=','U0027')
                        // ->where('tgl_registrasi','=','2024-02-03')
                        ->where('tgl_registrasi','=',$now)
                        ->first();
                }

                $antrian = new Antrian();
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

    function next2() {
        $now = date('Y-m-d');

        $cek_antrian = Antrian::max('no_reg');
        $cek_reg = RegPeriksa::
            where('kd_dokter','=','20020111001')
            ->where('kd_poli','=','U0027')
            // ->where('tgl_registrasi','=','2024-02-03')
            ->where('tgl_registrasi','=',$now)
            ->max('no_reg');

        if ($cek_reg==$cek_antrian) {
            return back()->with('habis', 'Semua Pasien Sudah Dilayani');
        } else {
            $c_belum = Antrian::where('bed','=',2)->where('status','=','Belum')->count();

            if ($c_belum!=null) {
                $antrian = Antrian::where('bed','=','2')
                    ->where('status','=','Belum')
                    ->update(['status' => 'Selesai']);

                $max_antrian = Antrian::max('no_reg');

                $nextId = $max_antrian + 1;
                $hasil = str_pad($nextId, 3, '0', STR_PAD_LEFT);

                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0027')
                    // ->where('tgl_registrasi','=','2024-02-03')
                    ->where('tgl_registrasi','=',$now)
                    ->first();

                $antrian = new Antrian();
                $antrian->no_rawat = $reg['no_rawat'];
                $antrian->no_rkm_medis = $reg['no_rkm_medis'];
                $antrian->nm_pasien = $reg['nm_pasien'];
                $antrian->no_reg = $reg['no_reg'];
                $antrian->bed = 2;
                $antrian->status = "Belum";
                $antrian->save();

                return back();
            } else {
                $c_antrian = Antrian::get()->count();
                $max_antrian = Antrian::max('no_reg');
                $urutan = (int) substr($max_antrian, 2, 2);
                $urutan++;
                $hasil = sprintf("%03s", $urutan);

                if ($c_antrian==0) {
                    $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                        ->where('no_reg','=','001')
                        ->where('kd_dokter','=','20020111001')
                        ->where('kd_poli','=','U0027')
                        // ->where('tgl_registrasi','=','2024-02-03')
                        ->where('tgl_registrasi','=',$now)
                        ->first();
                } else {
                    $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                        ->where('no_reg','=',$hasil)
                        ->where('kd_dokter','=','20020111001')
                        ->where('kd_poli','=','U0027')
                        // ->where('tgl_registrasi','=','2024-02-03')
                        ->where('tgl_registrasi','=',$now)
                        ->first();
                }

                $antrian = new Antrian();
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

    function next3() {
        $now = date('Y-m-d');

        $cek_antrian = Antrian::max('no_reg');
        $cek_reg = RegPeriksa::
            where('kd_dokter','=','20020111001')
            // ->where('tgl_registrasi','=','2024-02-03')
            ->where('tgl_registrasi','=',$now)
            ->max('no_reg');

        if ($cek_reg==$cek_antrian) {
            return back()->with('habis', 'Semua Pasien Sudah Dilayani');
        } else {
            $c_belum = Antrian::where('bed','=',3)->where('status','=','Belum')->count();

            if ($c_belum!=null) {
                $antrian = Antrian::where('bed','=','3')
                    ->where('status','=','Belum')
                    ->update(['status' => 'Selesai']);

                $max_antrian = Antrian::max('no_reg');

                $nextId = $max_antrian + 1;
                $hasil = str_pad($nextId, 3, '0', STR_PAD_LEFT);

                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0027')
                    // ->where('tgl_registrasi','=','2024-02-03')
                    ->where('tgl_registrasi','=',$now)
                    ->first();

                $antrian = new Antrian();
                $antrian->no_rawat = $reg['no_rawat'];
                $antrian->no_rkm_medis = $reg['no_rkm_medis'];
                $antrian->nm_pasien = $reg['nm_pasien'];
                $antrian->no_reg = $reg['no_reg'];
                $antrian->bed = 3;
                $antrian->status = "Belum";
                $antrian->save();

                return back();
            } else {
                $c_antrian = Antrian::get()->count();
                $max_antrian = Antrian::max('no_reg');
                $urutan = (int) substr($max_antrian, 2, 2);
                $urutan++;
                $hasil = sprintf("%03s", $urutan);

                if ($c_antrian==0) {
                    $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                        ->where('no_reg','=','001')
                        ->where('kd_dokter','=','20020111001')
                        ->where('kd_poli','=','U0027')
                        // ->where('tgl_registrasi','=','2024-02-03')
                        ->where('tgl_registrasi','=',$now)
                        ->first();
                } else {
                    $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                        ->where('no_reg','=',$hasil)
                        ->where('kd_dokter','=','20020111001')
                        ->where('kd_poli','=','U0027')
                        // ->where('tgl_registrasi','=','2024-02-03')
                        ->where('tgl_registrasi','=',$now)
                        ->first();
                }

                $antrian = new Antrian();
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

    function next4() {
        $now = date('Y-m-d');

        $cek_antrian = Antrian::max('no_reg');
        $cek_reg = RegPeriksa::
            where('kd_dokter','=','20020111001')
            // ->where('tgl_registrasi','=','2024-02-03')
            ->where('tgl_registrasi','=',$now)
            ->max('no_reg');

        if ($cek_reg==$cek_antrian) {
            return back()->with('habis', 'Semua Pasien Sudah Dilayani');
        } else {
            $c_belum = Antrian::where('bed','=',4)->where('status','=','Belum')->count();

            if ($c_belum!=null) {
                $antrian = Antrian::where('bed','=','4')
                    ->where('status','=','Belum')
                    ->update(['status' => 'Selesai']);

                $max_antrian = Antrian::max('no_reg');

                $nextId = $max_antrian + 1;
                $hasil = str_pad($nextId, 3, '0', STR_PAD_LEFT);

                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0027')
                    // ->where('tgl_registrasi','=','2024-02-03')
                    ->where('tgl_registrasi','=',$now)
                    ->first();

                $antrian = new Antrian();
                $antrian->no_rawat = $reg['no_rawat'];
                $antrian->no_rkm_medis = $reg['no_rkm_medis'];
                $antrian->nm_pasien = $reg['nm_pasien'];
                $antrian->no_reg = $reg['no_reg'];
                $antrian->bed = 4;
                $antrian->status = "Belum";
                $antrian->save();

                return back();
            } else {
                $c_antrian = Antrian::get()->count();
                $max_antrian = Antrian::max('no_reg');
                $urutan = (int) substr($max_antrian, 2, 2);
                $urutan++;
                $hasil = sprintf("%03s", $urutan);

                if ($c_antrian==0) {
                    $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                        ->where('no_reg','=','001')
                        ->where('kd_dokter','=','20020111001')
                        ->where('kd_poli','=','U0027')
                        // ->where('tgl_registrasi','=','2024-02-03')
                        ->where('tgl_registrasi','=',$now)
                        ->first();
                } else {
                    $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                        ->where('no_reg','=',$hasil)
                        ->where('kd_dokter','=','20020111001')
                        ->where('kd_poli','=','U0027')
                        // ->where('tgl_registrasi','=','2024-02-03')
                        ->where('tgl_registrasi','=',$now)
                        ->first();
                }

                $antrian = new Antrian();
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

    function next5() {
        $now = date('Y-m-d');

        $cek_antrian = Antrian::max('no_reg');
        $cek_reg = RegPeriksa::
            where('kd_dokter','=','20020111001')
            // ->where('tgl_registrasi','=','2024-02-03')
            ->where('tgl_registrasi','=',$now)
            ->max('no_reg');

        if ($cek_reg==$cek_antrian) {
            return back()->with('habis', 'Semua Pasien Sudah Dilayani');
        } else {
            $c_belum = Antrian::where('bed','=',5)->where('status','=','Belum')->count();

            if ($c_belum!=null) {
                $antrian = Antrian::where('bed','=','5')
                    ->where('status','=','Belum')
                    ->update(['status' => 'Selesai']);

                $max_antrian = Antrian::max('no_reg');

                $nextId = $max_antrian + 1;
                $hasil = str_pad($nextId, 3, '0', STR_PAD_LEFT);

                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0027')
                    // ->where('tgl_registrasi','=','2024-02-03')
                    ->where('tgl_registrasi','=',$now)
                    ->first();

                $antrian = new Antrian();
                $antrian->no_rawat = $reg['no_rawat'];
                $antrian->no_rkm_medis = $reg['no_rkm_medis'];
                $antrian->nm_pasien = $reg['nm_pasien'];
                $antrian->no_reg = $reg['no_reg'];
                $antrian->bed = 5;
                $antrian->status = "Belum";
                $antrian->save();

                return back();
            } else {
                $c_antrian = Antrian::get()->count();
                $max_antrian = Antrian::max('no_reg');
                $urutan = (int) substr($max_antrian, 2, 2);
                $urutan++;
                $hasil = sprintf("%03s", $urutan);

                if ($c_antrian==0) {
                    $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                        ->where('no_reg','=','001')
                        ->where('kd_dokter','=','20020111001')
                        ->where('kd_poli','=','U0027')
                        // ->where('tgl_registrasi','=','2024-02-03')
                        ->where('tgl_registrasi','=',$now)
                        ->first();
                } else {
                    $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                        ->where('no_reg','=',$hasil)
                        ->where('kd_dokter','=','20020111001')
                        ->where('kd_poli','=','U0027')
                        // ->where('tgl_registrasi','=','2024-02-03')
                        ->where('tgl_registrasi','=',$now)
                        ->first();
                }

                $antrian = new Antrian();
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


    function skip1() {
        $now = date('Y-m-d');
        $cek_antrian = Antrian::max('no_reg');
        $cek_reg = RegPeriksa::
            where('kd_dokter','=','20020111001')
            ->where('kd_poli','=','U0027')
            ->where('tgl_registrasi','=',$now)
            ->max('no_reg');
    
        if ($cek_reg==$cek_antrian) {
            return back()->with('habis', 'Semua Pasien Sudah Dilayani');
        } else {
            $c_antrian = Antrian::where('bed','=','1')->count();

            if ($c_antrian==0) {
                return back()->with('kosong', 'Maaf Belum ada Pasien di BED 1, Silahkan KLIK Tombol Selanjutnya !!');
            } else {
                $antrian = Antrian::where('bed','=','1')
                    ->where('status','=','Belum')
                    ->update(['status' => 'Tunda']);

                $max_antrian = Antrian::max('no_reg');
                $urutan = (int) substr($max_antrian, 2, 2);
                $urutan++;
                $hasil = sprintf("%03s", $urutan);

                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0027')
                    // ->where('tgl_registrasi','=','2024-02-03')
                    ->where('tgl_registrasi','=',$now)
                    ->first();

                $antrian = new Antrian();
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

    function skip2() {
        $now = date('Y-m-d');
        $cek_antrian = Antrian::max('no_reg');
        $cek_reg = RegPeriksa::
            where('kd_dokter','=','20020111001')
            ->where('kd_poli','=','U0027')
            ->where('tgl_registrasi','=',$now)
            ->max('no_reg');
    
        if ($cek_reg==$cek_antrian) {
            return back()->with('habis', 'Semua Pasien Sudah Dilayani');
        } else {
            $c_antrian = Antrian::where('bed','=','2')->count();

            if ($c_antrian==0) {
                return back()->with('kosong', 'Maaf Belum ada Pasien di BED 2, Silahkan KLIK Tombol Selanjutnya !!');
            } else {
                $antrian = Antrian::where('bed','=','2')
                    ->where('status','=','Belum')
                    ->update(['status' => 'Tunda']);

                $max_antrian = Antrian::max('no_reg');
                $urutan = (int) substr($max_antrian, 2, 2);
                $urutan++;
                $hasil = sprintf("%03s", $urutan);

                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0027')
                    // ->where('tgl_registrasi','=','2024-02-03')
                    ->where('tgl_registrasi','=',$now)
                    ->first();

                $antrian = new Antrian();
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

    function skip3() {
        $now = date('Y-m-d');
        $cek_antrian = Antrian::max('no_reg');
        $cek_reg = RegPeriksa::
            where('kd_dokter','=','20020111001')
            ->where('kd_poli','=','U0027')
            ->where('tgl_registrasi','=',$now)
            ->max('no_reg');
    
        if ($cek_reg==$cek_antrian) {
            return back()->with('habis', 'Semua Pasien Sudah Dilayani');
        } else {
            $c_antrian = Antrian::where('bed','=','3')->count();

            if ($c_antrian==0) {
                return back()->with('kosong', 'Maaf Belum ada Pasien di BED 3, Silahkan KLIK Tombol Selanjutnya !!');
            } else {
                $antrian = Antrian::where('bed','=','3')
                    ->where('status','=','Belum')
                    ->update(['status' => 'Tunda']);

                $max_antrian = Antrian::max('no_reg');
                $urutan = (int) substr($max_antrian, 2, 2);
                $urutan++;
                $hasil = sprintf("%03s", $urutan);

                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0027')
                    // ->where('tgl_registrasi','=','2024-02-03')
                    ->where('tgl_registrasi','=',$now)
                    ->first();

                $antrian = new Antrian();
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

    function skip4() {
        $now = date('Y-m-d');
        $cek_antrian = Antrian::max('no_reg');
        $cek_reg = RegPeriksa::
            where('kd_dokter','=','20020111001')
            ->where('kd_poli','=','U0027')
            ->where('tgl_registrasi','=',$now)
            ->max('no_reg');
    
        if ($cek_reg==$cek_antrian) {
            return back()->with('habis', 'Semua Pasien Sudah Dilayani');
        } else {
            $c_antrian = Antrian::where('bed','=','4')->count();

            if ($c_antrian==0) {
                return back()->with('kosong', 'Maaf Belum ada Pasien di BED 4, Silahkan KLIK Tombol Selanjutnya !!');
            } else {
                $antrian = Antrian::where('bed','=','4')
                    ->where('status','=','Belum')
                    ->update(['status' => 'Tunda']);

                $max_antrian = Antrian::max('no_reg');
                $urutan = (int) substr($max_antrian, 2, 2);
                $urutan++;
                $hasil = sprintf("%03s", $urutan);

                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0027')
                    // ->where('tgl_registrasi','=','2024-02-03')
                    ->where('tgl_registrasi','=',$now)
                    ->first();

                $antrian = new Antrian();
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

    function skip5() {
        $now = date('Y-m-d');
        $cek_antrian = Antrian::max('no_reg');
        $cek_reg = RegPeriksa::
            where('kd_dokter','=','20020111001')
            ->where('kd_poli','=','U0027')
            ->where('tgl_registrasi','=',$now)
            ->max('no_reg');
    
        if ($cek_reg==$cek_antrian) {
            return back()->with('habis', 'Semua Pasien Sudah Dilayani');
        } else {
            $c_antrian = Antrian::where('bed','=','5')->count();

            if ($c_antrian==0) {
                return back()->with('kosong', 'Maaf Belum ada Pasien di BED 5, Silahkan KLIK Tombol Selanjutnya !!');
            } else {
                $antrian = Antrian::where('bed','=','5')
                    ->where('status','=','Belum')
                    ->update(['status' => 'Tunda']);

                $max_antrian = Antrian::max('no_reg');
                $urutan = (int) substr($max_antrian, 2, 2);
                $urutan++;
                $hasil = sprintf("%03s", $urutan);

                $reg = RegPeriksa::join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                    ->where('no_reg','=',$hasil)
                    ->where('kd_dokter','=','20020111001')
                    ->where('kd_poli','=','U0027')
                    // ->where('tgl_registrasi','=','2024-02-03')
                    ->where('tgl_registrasi','=',$now)
                    ->first();

                $antrian = new Antrian();
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

    
    // function PLewati() {
    //     $data0='';

    //     $c_bed1 = Antrian::where('bed','=','1')
    //         ->where('status','=','Belum')
    //         ->count();
    //     $c_bed2 = Antrian::where('bed','=','2')
    //         ->where('status','=','Belum')
    //         ->count();
    //     $c_bed3 = Antrian::where('bed','=','3')
    //         ->where('status','=','Belum')
    //         ->count();
    //     $c_bed4 = Antrian::where('bed','=','4')
    //         ->where('status','=','Belum')
    //         ->count();
    //     $c_bed5 = Antrian::where('bed','=','5')
    //         ->where('status','=','Belum')
    //         ->count();

    //     $bed1 = Antrian::where('bed','=','1')
    //         ->where('status','=','Belum')
    //         ->first();
    //     $bed2 = Antrian::where('bed','=','2')
    //         ->where('status','=','Belum')
    //         ->first();
    //     $bed3 = Antrian::where('bed','=','3')
    //         ->where('status','=','Belum')
    //         ->first();
    //     $bed4 = Antrian::where('bed','=','4')
    //         ->where('status','=','Belum')
    //         ->first();
    //     $bed5 = Antrian::where('bed','=','5')
    //         ->where('status','=','Belum')
    //         ->first();

    //     $get_skip = Antrian::where('status','=','Tunda')->get();

    //     $now = date('Y-m-d');
    //     $reg = RegPeriksa::select(
    //             'no_rawat',
    //             'reg_periksa.no_rkm_medis',
    //             'dokter.nm_dokter',
    //             'nm_pasien',
    //             'no_reg'
    //          )
    //         ->join('dokter','reg_periksa.kd_dokter','=','dokter.kd_dokter')
    //         ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
    //         ->where('reg_periksa.kd_dokter','=','20020111001')
    //         ->where('tgl_registrasi','=',$now)
    //         ->get();

    //     return view('antrian.skip2', compact('c_bed1','bed1','c_bed2','bed2','c_bed3','bed3','c_bed4','bed4','c_bed5','bed5','data0','get_skip','reg'));
    // }

    function PLewati() {
        $data0='';

        $c_bed1 = Antrian::where('bed','=','1')
            ->where('status','=','Belum')
            ->count();
        $c_bed2 = Antrian::where('bed','=','2')
            ->where('status','=','Belum')
            ->count();
        $c_bed3 = Antrian::where('bed','=','3')
            ->where('status','=','Belum')
            ->count();
        $c_bed4 = Antrian::where('bed','=','4')
            ->where('status','=','Belum')
            ->count();
        $c_bed5 = Antrian::where('bed','=','5')
            ->where('status','=','Belum')
            ->count();

        $bed1 = Antrian::where('bed','=','1')
            ->where('status','=','Belum')
            ->first();
        $bed2 = Antrian::where('bed','=','2')
            ->where('status','=','Belum')
            ->first();
        $bed3 = Antrian::where('bed','=','3')
            ->where('status','=','Belum')
            ->first();
        $bed4 = Antrian::where('bed','=','4')
            ->where('status','=','Belum')
            ->first();
        $bed5 = Antrian::where('bed','=','5')
            ->where('status','=','Belum')
            ->first();

        $get_skip = Antrian::where('status','=','Tunda')->get();

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
            ->where('reg_periksa.kd_poli','=','U0027')
            ->where('tgl_registrasi','=',$now)
            ->get();

        return view('antrian.skip2', compact('c_bed1','bed1','c_bed2','bed2','c_bed3','bed3','c_bed4','bed4','c_bed5','bed5','data0','get_skip','reg'));
    }

    function PSelesai(Request $request) {
        $get_no_rawat = $request['no_rawat'];
        $selesai = Antrian::where('no_rawat','=',$get_no_rawat)
                ->where('status','=','Tunda')
                ->update(['status' => 'Selesai']);

        return back();
    }


    function pKhusus(Request $request) {
        $now = date('Y-m-d');
        $get_khusus = RegPeriksa::
            join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            // join('antrian_akupuntur.antrian as ant', 'reg_periksa.no_rawat', '=', 'ant.no_rawat')
            ->where('kd_dokter','=','20020111001')
            ->where('kd_poli','=','U0027')
            ->where('tgl_registrasi','=',$now)
            ->get();
        // $khusus = Antrian::where('status','!=','Sudah');

        return view('antrian.khusus', compact('get_khusus'));
    }
}
