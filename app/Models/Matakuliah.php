<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\MahasiswaMataKuliah;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table="matakuliah";

    protected $fillable = [
        'nama_matkul',
        'sks',
        'jam',
        'semester',
    ];

    public function mahasiswa_matakuliah(){
        return $this->hasMany(Mahasiswa_MataKuliah::class);

    }
}
