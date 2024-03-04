<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\AntrianSore;
use App\Models\RegPeriksa;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    function index() {
        $currentHour = date('H');
        
        if ($currentHour > 15) {
            $now = date('Y-m-d');
            $reg = RegPeriksa::select(
                    'reg_periksa.no_rkm_medis',
                    'dokter.nm_dokter',
                    'nm_pasien',
                    'no_reg'
                )
                ->join('dokter','reg_periksa.kd_dokter','=','dokter.kd_dokter')
                ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                ->where('reg_periksa.kd_dokter','=','20020111001')
                ->where('reg_periksa.kd_poli','=','U0037')
                // ->where('tgl_registrasi','=','2024-01-30')
                ->where('tgl_registrasi','=',$now)
                ->get();

            $bed1 = AntrianSore::where('bed','=','1')
                ->where('status','=','belum')->first();
            $bed2 = AntrianSore::where('bed','=','2')
                ->where('status','=','belum')->first();
            $bed3 = AntrianSore::where('bed','=','3')
                ->where('status','=','belum')->first();
            $bed4 = AntrianSore::where('bed','=','4')
                ->where('status','=','belum')->first();
            $bed5 = AntrianSore::where('bed','=','5')
                ->where('status','=','belum')->first();

            $c_bed1 = AntrianSore::where('bed','=','1')
                ->where('status','=','belum')->count();
            $c_bed2 = AntrianSore::where('bed','=','2')
                ->where('status','=','belum')->count();
            $c_bed3 = AntrianSore::where('bed','=','3')
                ->where('status','=','belum')->count();
            $c_bed4 = AntrianSore::where('bed','=','4')
                ->where('status','=','belum')->count();
            $c_bed5 = AntrianSore::where('bed','=','5')
                ->where('status','=','belum')->count();

            return view('display.index', compact('reg','bed1','bed2','bed3','bed4','bed5'));
        } else {
            $now = date('Y-m-d');
            $reg = RegPeriksa::select(
                    'reg_periksa.no_rkm_medis',
                    'dokter.nm_dokter',
                    'nm_pasien',
                    'no_reg'
                 )
                ->join('dokter','reg_periksa.kd_dokter','=','dokter.kd_dokter')
                ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
                ->where('reg_periksa.kd_dokter','=','20020111001')
                ->where('reg_periksa.kd_poli','=','U0027')
                // ->where('tgl_registrasi','=','2024-01-30')
                ->where('tgl_registrasi','=',$now)
                ->get();
    
            $bed1 = Antrian::where('bed','=','1')
                ->where('status','=','belum')->first();
            $bed2 = Antrian::where('bed','=','2')
                ->where('status','=','belum')->first();
            $bed3 = Antrian::where('bed','=','3')
                ->where('status','=','belum')->first();
            $bed4 = Antrian::where('bed','=','4')
                ->where('status','=','belum')->first();
            $bed5 = Antrian::where('bed','=','5')
                ->where('status','=','belum')->first();
    
            $c_bed1 = Antrian::where('bed','=','1')
                ->where('status','=','belum')->count();
            $c_bed2 = Antrian::where('bed','=','2')
                ->where('status','=','belum')->count();
            $c_bed3 = Antrian::where('bed','=','3')
                ->where('status','=','belum')->count();
            $c_bed4 = Antrian::where('bed','=','4')
                ->where('status','=','belum')->count();
            $c_bed5 = Antrian::where('bed','=','5')
                ->where('status','=','belum')->count();
    
            return view('display.index', compact('reg','bed1','bed2','bed3','bed4','bed5','currentHour'));
        }

        
    }
}
