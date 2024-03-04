<?php

namespace App\Http\Controllers;

use App\Models\RegPeriksa;
use Illuminate\Http\Request;

class PoliklinikController extends Controller
{
    function poliAnak() {
        $now = date('Y-m-d');
        $anak = RegPeriksa::select(
                'no_rawat',
                'reg_periksa.no_rkm_medis',
                'dokter.nm_dokter',
                'nm_pasien',
                'no_reg',
                'stts'
            )
            ->join('dokter','reg_periksa.kd_dokter','=','dokter.kd_dokter')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->where('reg_periksa.kd_dokter','=','35951')
            ->where('kd_poli','=','ANAK')
            ->where('tgl_registrasi','=',$now)
            ->get();

            return view('poliklinik.poli_anak', compact('anak'));
    }

    function poliGigi() {
        $now = date('Y-m-d');
        $gigi = RegPeriksa::select(
                'no_rawat',
                'reg_periksa.no_rkm_medis',
                'dokter.nm_dokter',
                'nm_pasien',
                'no_reg',
                'stts'
            )
            ->join('dokter','reg_periksa.kd_dokter','=','dokter.kd_dokter')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->where('reg_periksa.kd_dokter','=','20140511007')
            ->where('kd_poli','=','U0010')
            ->where('tgl_registrasi','=',$now)
            ->get();

            return view('poliklinik.poli_gigi', compact('gigi'));
    }

    function poliPD() {
        $now = date('Y-m-d');
        $pdalam = RegPeriksa::select(
                'no_rawat',
                'reg_periksa.no_rkm_medis',
                'dokter.nm_dokter',
                'nm_pasien',
                'no_reg',
                'stts'
            )
            ->join('dokter','reg_periksa.kd_dokter','=','dokter.kd_dokter')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->where('reg_periksa.kd_dokter','=','20160612002')
            ->where('kd_poli','=','INT')
            ->where('tgl_registrasi','=',$now)
            ->get();

            return view('poliklinik.poli_pdalam', compact('pdalam'));
    }

    function poliSyaraf() {
        $now = date('Y-m-d');
        $syaraf = RegPeriksa::select(
                'no_rawat',
                'reg_periksa.no_rkm_medis',
                'dokter.nm_dokter',
                'nm_pasien',
                'no_reg',
                'stts'
            )
            ->join('dokter','reg_periksa.kd_dokter','=','dokter.kd_dokter')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->where('reg_periksa.kd_dokter','=','dr.Shofariyah')
            ->where('kd_poli','=','SAR')
            ->where('tgl_registrasi','=',$now)
            ->get();

            return view('poliklinik.poli_syaraf', compact('syaraf'));
    }

    function poliObsgyn() {
        $now = date('Y-m-d');
        $obsgyn = RegPeriksa::select(
                'no_rawat',
                'reg_periksa.no_rkm_medis',
                'dokter.nm_dokter',
                'nm_pasien',
                'no_reg',
                'stts'
            )
            ->join('dokter','reg_periksa.kd_dokter','=','dokter.kd_dokter')
            ->join('pasien','reg_periksa.no_rkm_medis','=','pasien.no_rkm_medis')
            ->where('reg_periksa.kd_dokter','=','288069')
            ->where('kd_poli','=','OBG')
            ->where('tgl_registrasi','=',$now)
            ->get();

            return view('poliklinik.poli_obsgyn', compact('obsgyn'));
    }
}
