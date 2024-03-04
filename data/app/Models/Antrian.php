<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $connection = 'second_database';
    protected $table = 'antrian';
    protected $primaryKey = 'id';
    protected $fillable = ['*'];
}
