<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
  protected $table = "mahasiswa";
  public $timestamps = false;
  protected $primaryKey= "id";
  protected $fillable = ['nim', 'nama', 'kelas'];
}
