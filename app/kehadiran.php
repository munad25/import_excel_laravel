<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kehadiran extends Model
{
    protected $table = "kehadiran";
    protected $fillable = ['nim', 'ket_id', 'smt_id', 'kelas_it', 'tanggal', 'waktu'];
}
