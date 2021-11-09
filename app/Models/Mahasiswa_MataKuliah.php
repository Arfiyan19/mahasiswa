<?php

namespace App\Models;
use App\Models\Mahasiswa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa_MataKuliah extends Model
{
    use HasFactory;
    protected $table = 'NILAI';
    protected $fillable = [
        'mahasiswa_id',
        'matakuliah_id',
        'nilai',
    ];
    public function mahasiswa(){
        return $this->hasMany(Mahasiswa::class);
    }
    public function matakuliah(){
        return $this->hasMany(Matakuliah::class);
    }
    }
