<?php

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\AntrianSoreController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\TruncateController;
use App\Http\Controllers\PoliklinikController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DisplayController::class, 'index'])->name('display');

// Antrian Pagi
Route::get('antrian', [AntrianController::class, 'antrian'])->name('antrian');

Route::get('next1', [AntrianController::class, 'next1'])->name('next1');
Route::get('next2', [AntrianController::class, 'next2'])->name('next2');
Route::get('next3', [AntrianController::class, 'next3'])->name('next3');
Route::get('next4', [AntrianController::class, 'next4'])->name('next4');
Route::get('next5', [AntrianController::class, 'next5'])->name('next5');

Route::get('skip1', [AntrianController::class, 'skip1'])->name('skip1');
Route::get('skip2', [AntrianController::class, 'skip2'])->name('skip2');
Route::get('skip3', [AntrianController::class, 'skip3'])->name('skip3');
Route::get('skip4', [AntrianController::class, 'skip4'])->name('skip4');
Route::get('skip5', [AntrianController::class, 'skip5'])->name('skip5');

Route::get('p_lewati', [AntrianController::class, 'PLewati'])->name('p_lewati');
Route::post('p_selesai', [AntrianController::class, 'PSelesai'])->name('p_selesai');

Route::get('p_lewati_sore', [AntrianSoreController::class, 'PLewatiSore'])->name('p_lewati_sore');
Route::post('p_selesai_sore', [AntrianSoreController::class, 'PSelesai'])->name('p_selesai_sore');

Route::get('p_khusus', [AntrianController::class, 'pKhusus'])->name('p_khusus');
Route::get('p_khusus_sore', [AntrianSoreController::class, 'pKhusus'])->name('p_khusus_sore');

// Antrian Sore
Route::get('antriansore', [AntrianSoreController::class, 'antriansore'])->name('antriansore');

Route::get('nexts1', [AntrianSoreController::class, 'nexts1'])->name('nexts1');
Route::get('nexts2', [AntrianSoreController::class, 'nexts2'])->name('nexts2');
Route::get('nexts3', [AntrianSoreController::class, 'nexts3'])->name('nexts3');
Route::get('nexts4', [AntrianSoreController::class, 'nexts4'])->name('nexts4');
Route::get('nexts5', [AntrianSoreController::class, 'nexts5'])->name('nexts5');

Route::get('skips1', [AntrianSoreController::class, 'skips1'])->name('skips1');
Route::get('skips2', [AntrianSoreController::class, 'skips2'])->name('skips2');
Route::get('skips3', [AntrianSoreController::class, 'skips3'])->name('skips3');
Route::get('skips4', [AntrianSoreController::class, 'skips4'])->name('skips4');
Route::get('skips5', [AntrianSoreController::class, 'skips5'])->name('skips5');


Route::post('pp_khusus_sore', [AntrianSoreController::class, 'ppKhususSore'])->name('pp_khusus_sore');

Route::get('/truncate', [TruncateController::class, 'index'])->name('truncate');
Route::get('/pagi', [TruncateController::class, 'pagi'])->name('pagi');
Route::get('/sore', [TruncateController::class, 'sore'])->name('sore');


Route::get('/poli-anak', [PoliklinikController::class, 'poliAnak'])->name('poli-anak');
Route::get('/poli-gigi', [PoliklinikController::class, 'poliGigi'])->name('poli-gigi');
Route::get('/poli-pdalam', [PoliklinikController::class, 'poliPD'])->name('poli-pdalam');
Route::get('/poli-syaraf', [PoliklinikController::class, 'poliSyaraf'])->name('poli-syaraf');
Route::get('/poli-obsgyn', [PoliklinikController::class, 'poliObsgyn'])->name('poli-obsgyn');
