<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

class Kelas extends Model
{
    protected $table="kelas"; // Eloquent akan membuat model mahasiswa menyimpan record di tabel mahasiswas
    public function mahasiswa(){
        return $this->hasMany(Mahasiswa::class);

    }
}
