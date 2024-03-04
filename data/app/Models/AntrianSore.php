<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntrianSore extends Model
{
    use HasFactory;
    
    protected $connection = 'second_database';
    protected $table = 'antrian_sore';
    protected $primaryKey = 'id';
    protected $fillable = ['*'];
}
