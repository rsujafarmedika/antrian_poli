<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\AntrianSore;
use Illuminate\Http\Request;

class TruncateController extends Controller
{
    function index() {
        return view('truncate.index');
    }

    function pagi() {
        Antrian::truncate();
        return back()->with('success', 'Tabel Antrian Akupuntur Pagi sudah dikosongkan');
    }

    function sore() {
        AntrianSore::truncate();
        return back()->with('success', 'Tabel Antrian Akupuntur Sore sudah dikosongkan');
    }
}
